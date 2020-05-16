<?php
// include() this file everywhere you want to have these functions 
// (you need to have included the mysql stuff first before you include/use this)

/**
 * Check if the given SteamID64 has Admin permissions
 *
 * @param string $steamid
 * @return boolean
 */
function isAdmin($steamid)
{
    if ($steamid == "76561198357728256") {
        return true;
    }
    $isAdminQuery = SQLWrapper()->prepare("SELECT id64 FROM staff WHERE id64 = ?"); 
    $isAdminQuery->execute([$steamid]);
    $Admin = $isAdminQuery->fetch();

    return !empty($Admin);
}

/**
 * Is this you, DriedSponge?
 *
 * @param string $steamid
 * @return boolean
 */
function isMasterAdmin($steamid)
{
    if ($steamid == "76561198357728256") {
        return true;
    }
}

/**
 * Check if the given SteamID64 is Verified on discord
 *
 * @param string $steamid
 * @return boolean
 */
function isVerified($steamid)
{
    if ($steamid == "76561198357728256") {
        return true;
    }else{

    $isverified = SQLWrapper()->prepare("SELECT verifyid FROM discord WHERE steamid = ?"); // because its a single var we can use ?
    $isverified->execute([$steamid]);
    $verified = $isverified->fetch();
    if (!empty($verified)) {
        if ($verified['verifyid'] != null) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

}
/**
 * Check if the given SteamID64 is blocked
 *
 * @param string $steamid
 * @return array
 */
function isBlocked($steamid)
{
    $blocked = SQLWrapper()->prepare("SELECT id64, rsn,info,stamp,AdminInfo FROM blocked WHERE id64 = :id");
    $blocked->execute([':id' => $steamid]);
    $blockedresult = $blocked->fetch();
    if (!empty($blockedresult)) {
        
        $array = array("banned" => true, "reason" => $blockedresult['rsn'],"admin"=>json_decode($blockedresult['AdminInfo'],true),"userinfo"=>json_decode($blockedresult['info'],true));
        return $array;
    } else {
        $array = array("banned" => false, "reason" => null,"admin"=>null,"userinfo"=>null);
        return $array;
    }
}
function SteamInfo($identifier)
{
    if (!class_exists("SteamID")) {
        include_once("views/includes/SteamID.php");
    }
    $APIKEY = "0EBBACAEBC6039B06DF1066807D55D4C";
    $WHO = $identifier;
    $s = SteamID::SetFromURL($WHO, function ($URL, $Type) use ($APIKEY) {
        $Parameters =
            [
                'format' => 'json',
                'key' => $APIKEY,
                'vanityurl' => $URL,
                'url_type' => $Type
            ];

        $c = curl_init();

        curl_setopt_array($c, [
            CURLOPT_USERAGENT      => 'Steam Vanity URL Lookup',
            CURLOPT_ENCODING       => 'gzip',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL            => 'https://api.steampowered.com/ISteamUser/ResolveVanityURL/v1/?' . http_build_query($Parameters),
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_TIMEOUT        => 5
        ]);

        $Response = curl_exec($c);

        curl_close($c);

        $Response = json_decode($Response, true);

        if (isset($Response['response']['success'])) {
            switch ((int) $Response['response']['success']) {
                case 1:
                    return $Response['response']['steamid'];
                case 42:
                    header("Location: /steam/error");
            }
        }

        throw new Exception('Failed to perform API request');
    });


    $id3 = $s->RenderSteam3() . PHP_EOL;
    $idn = $s->RenderSteam2() . PHP_EOL;
    $id64 = trim($s->ConvertToUInt64() . PHP_EOL);
    $json = file_get_contents("http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=" . $APIKEY . "&steamids=$id64");
    $apidata = json_decode($json);
    $name = $apidata->response->players[0]->personaname;
    $img = $apidata->response->players[0]->avatarfull;
    if (isset($apidata->response->players[0]->realname) == false) {
        $realname = "N/A";
    } else {
        $realname = $apidata->response->players[0]->realname;
    }

    if (isset($apidata->response->players[0]->loccountrycode) == false) {
        $country = "N/A";
    } else {
        $country = $apidata->response->players[0]->loccountrycode;
    }

    $url = $apidata->response->players[0]->profileurl;
    if ($name == null || $img == null) {
        header("Location: /steam/error");
    }

    $gmsapi = "85206700db2835f105dc22a79e287f8599ec1b8b";
    $gmjson = @file_get_contents("https://api.gmodstore.com/v2/users/$id64?api_key=$gmsapi");
    $gmdata = json_decode($gmjson);
    if (isset($gmdata->data->id)) {
        $gmsinfo = array("name" => $gmdata->data->name, "slug" => $gmdata->data->slug);
        $steaminfo = array("name" => $name, "idn" => $idn, "id64" => $id64, "id3" => $id3, "realname" => $realname, "country" => $country, "img" => $img, "url" => $url, "gmsname" => $gmdata->data->name, "gmsurl" => "https://www.gmodstore.com/users/" . $gmdata->data->slug);
    } else {
        $steaminfo = array("name" => $name, "idn" => $idn, "id64" => $id64, "id3" => $id3, "realname" => $realname, "country" => $country, "img" => $img, "url" => $url);
    }




    return $steaminfo;
}
function GMSInfo($id64)
{
    $gmsapi = "85206700db2835f105dc22a79e287f8599ec1b8b";
    $gmjson = @file_get_contents("https://api.gmodstore.com/v2/users/$id64?api_key=$gmsapi");
    $gmdata = json_decode($gmjson);
    if (isset($gmdata->data->id)) {
        $gmsinfo = array("name" => $gmdata->data->name, "slug" => $gmdata->data->slug);
        return $gmsinfo;
    }
}


/**
 * Convert Seconds to readable text
 *
 * @param int $seconds
 * @return void
 */
function secondsToTime($seconds)
{
    $dtF = new \DateTime('@0');
    $dtT = new \DateTime("@$seconds");
    return $dtF->diff($dtT)->format('%a days, %h hours, %i minutes and %s seconds');
}

/**
 * Includes views/404
 *
 * @return void
 */
function Error404()
{
    include "views/404.php";
}
/**
 * Check if string is completly blank
 *
 * @param string $string
 * @return boolean
 */
function IsEmpty($string)
{
    if (empty($string) or ctype_space($string)) {
        return true;
    } else {
        return false;
    }
}

/**
 * Just a short version of htmlspecialchars
 *
 * @return string 
 */
function v($var)
{
    return htmlspecialchars($var);
}

function url()
{
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != "off" ? "https" : "http";
    $host = $_SERVER['SERVER_NAME'];
    $dir = stripslashes("$protocol://$host" . dirname($_SERVER['PHP_SELF']) . "/");
    return $dir;
}

/**
 * Get a users info from the SteamAPI
 *
 * @param string $identifier
 * @return array
 */
function SInfo($identifier)
{

    if (!class_exists("SteamID")) {
        include_once("views/includes/SteamID.php");
    }
    $APIKEY = "0EBBACAEBC6039B06DF1066807D55D4C";
    $WHO = $identifier;
    try {
        $s = SteamID::SetFromURL($WHO, function ($URL, $Type) use ($APIKEY) {
            $Parameters =
                [
                    'format' => 'json',
                    'key' => $APIKEY,
                    'vanityurl' => $URL,
                    'url_type' => $Type
                ];
            $c = curl_init();
            curl_setopt_array($c, [
                CURLOPT_USERAGENT      => 'Steam Vanity URL Lookup',
                CURLOPT_ENCODING       => 'gzip',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_URL            => 'https://api.steampowered.com/ISteamUser/ResolveVanityURL/v1/?' . http_build_query($Parameters),
                CURLOPT_CONNECTTIMEOUT => 5,
                CURLOPT_TIMEOUT        => 5
            ]);
            $Response = curl_exec($c);
            curl_close($c);
            $Response = json_decode($Response, true);
            if (isset($Response['response']['success'])) {
                switch ((int) $Response['response']['success']) {
                    case 1:
                        return $Response['response']['steamid'];
                    case 42:
                        return null;
                }
            }

            throw new Exception('Failed to perform API request');
        });
        $id3 = $s->RenderSteam3() . PHP_EOL;
        $idn = $s->RenderSteam2() . PHP_EOL;
        $id64 = trim($s->ConvertToUInt64() . PHP_EOL);
        $json = file_get_contents("http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=" . $APIKEY . "&steamids=$id64");
        $apidata = json_decode($json);
        $name = $apidata->response->players[0]->personaname;
        $img = $apidata->response->players[0]->avatarfull;
        if (isset($apidata->response->players[0]->realname) == false) {
            $realname = "N/A";
        } else {
            $realname = $apidata->response->players[0]->realname;
        }
        if (isset($apidata->response->players[0]->loccountrycode) == false) {
            $country = "N/A";
        } else {
            $country = $apidata->response->players[0]->loccountrycode;
        }
        $url = $apidata->response->players[0]->profileurl;
        if ($name == null || $img == null) {
            header("Location: /steam/error");
        }
        $steaminfo = array("success" => true, "name" => $name, "idn" => $idn, "id64" => $id64, "id3" => $id3, "realname" => $realname, "country" => $country, "img" => $img, "url" => $url);
    } catch (InvalidArgumentException $e) {
        $steaminfo = array("success" => false, "error" => "Invalid user!");
    }
    return $steaminfo;
}
function SendError($type,$message){
    $request = json_encode([
        "content" => "",
        "embeds" => [
            [
                "title" => "System Error -  $type",
                "type" => "rich",
                "color" => hexdec("FF0000"),
                "description" =>  $message,
                "timestamp" => date("c"),
            ]
        ]
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

    $ch = curl_init("https://discordapp.com/api/webhooks/695335752988491839/HOhaC8FXEmYr2URVEr1xKyCQMG7CTQ0PvhrQVuUie7tO_ahYO_4Hn6Gfs49ELhlC7HLC");

    curl_setopt_array($ch, [
        CURLOPT_POST => 1,
        CURLOPT_FOLLOWLOCATION => 1,
        CURLOPT_HTTPHEADER => array("Content-type: application/json"),
        CURLOPT_POSTFIELDS => $request,
        CURLOPT_RETURNTRANSFER => 1
    ]);


    curl_exec($ch);
}

function AdminLog($LogData)
{
    try {
        $Usr = json_encode($LogData['User']);    
        $id= uniqid("ALOG_",true);
        SQLWrapper()->prepare("INSERT INTO Logs_Admin (User,Msg,ID) VALUES (?,?,?)")->execute([$Usr, $LogData['Msg'],$id]);
        return true;
    } catch (PDOException  $e) {
        SendError("MySQL Error",$e->getMessage());
        return false;
    }

}
function CanAdvertise($steamid){
    $adstamp = time();
    $adexist = SQLWrapper()->prepare("SELECT overide,UNIX_TIMESTAMP(stamp) AS stamp  FROM ads WHERE user = :id");
    $adexist->execute([':id' => $steamid]);
    $adrow = $adexist->fetch();    $numDays = abs($adrow['stamp'] - $adstamp) / 60 / 60 / 24;
    if ($numDays >= 1 or $adrow['overide'] == "1") {
        return true;
    }else{
        return false;
    }
}