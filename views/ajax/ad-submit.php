<?php
header('Content-type: application/json');



    if(isset($_POST['lastad'])){
        $Message = array(
            "success" => false, // "suck this" hehe
            "message" => "Something went wrong I guess"
        );
        if(isset($_SESSION['steamid'])){
            if(!isBlocked($_SESSION['steamid'])){
                if(isVerified($_SESSION['steamid'])){
                $adexist = SQLWrapper()->prepare("SELECT user,adname,overide,content,adcount,UNIX_TIMESTAMP(stamp) AS stamp  FROM ads WHERE user = :id");
                $adexist->execute([':id' => $_SESSION['steamid']]);
                $adrow = $adexist->fetch();
                $adcount = $adrow["adcount"];
                SQLWrapper()->prepare("UPDATE ads SET overide = :overide,adcount =:adcount WHERE user = :curuser")->execute([':curuser' => $_SESSION['steamid'],':adcount' => $adcount+1,':overide' => 0]);    
                                                    
                $request = json_encode([
                    "content" => "",
                    "embeds" => [
                        [
                            "author" => [
                                "name" => "Ad sent from ".$steamprofile['personaname'] . " (" . $steamprofile['steamid'] . ")",
                                "url" => $steamprofile['profileurl'],
                                "icon_url" => $steamprofile['avatarmedium']
                            ],
                            "title" => str_replace("@"," ",$adrow['adname']),
                            "type" => "rich",
                            "description" =>  str_replace("@"," ",$adrow['content']),
                            "timestamp" => date("c"),
                        ]
                    ]
                ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

                $ch = curl_init("https://discordapp.com/api/webhooks/655554251702927390/-dICp0ReXpC63SW3DNpJqc1zE5hzhJD_HmyBrt5f0Xoh8y-YiErccuXLiRWQj5jrCG3U");

                curl_setopt_array($ch, [
                    CURLOPT_POST => 1,
                    CURLOPT_FOLLOWLOCATION => 1,
                    CURLOPT_HTTPHEADER => array("Content-type: application/json"),
                    CURLOPT_POSTFIELDS => $request,
                    CURLOPT_RETURNTRANSFER => 1
                ]);


                curl_exec($ch);
                $Message['message'] = "Thank you for advertising! You should see your ad appear in the server shortly.";
                $Message['success'] = true;
                }else{
                    $Message['message'] = "You need to be verified in my discord server to do this!";
                }
            }else{
                $Message["message"] = "It appears you've been banned!";
            }
        }else{
            $Message["message"] = "Not logged in";
        }
    }






if (isset($_POST['submit'])) {
    $Message = array(
        "success" => false, // "suck this" hehe
        "basics" => false,
        "errorNAME" => false,
        "errorNAMETXT" => null,
        "errorCON" => false,
        "errorCONTXT" => null,
        "message" => "Something went wrong I guess"
    );
    if(isset($_SESSION['steamid'])){
        if(!isBlocked($_SESSION['steamid'])){
            if(isVerified($_SESSION['steamid'])){
                $Message["message"] = null;
                $Message["basics"] = true;
                $aduser = $_SESSION['steamid'];
                $adname = $_POST['adname'];
                
                $adcontent = $_POST['adcontent']; 
                if(IsEmpty($adname)){
                    $Message["errorNAME"] = true;
                    $Message["errorNAMETXT"] = "Please specify an ad name";  
                     
                }else if(strlen($adname) > 25){
                    $Message["errorNAME"] = true;
                    $Message["errorNAMETXT"] = "Your ad name is too long";  
                }else if(strlen($adname) < 25 && !IsEmpty($adname)){
                    $Message["errorNAME"] = false; 
                }
                if(IsEmpty($adcontent)){
                    $Message["errorCON"] = true;
                    $Message["errorCONTXT"] = "Please ad some detail to your ad";  
                     
                }else if(strlen($adcontent) > 1500){
                    $Message["errorCON"] = true;
                    $Message["errorCONTXT"] = "Your ad is too long! Try cutting it down a bit (below 1500 characters)";  
                }else if(strlen($adcontent) < 1500 && !IsEmpty($adcontent)){
                    $Message["errorCON"] = false; 
                }
            if(!$Message["errorNAME"] && !$Message["errorCON"] && $Message["basics"]){
                $adexist = SQLWrapper()->prepare("SELECT user,adname,overide,content,adcount,UNIX_TIMESTAMP(stamp) AS stamp  FROM ads WHERE user = :id");
                $adexist->execute([':id' => $aduser]);
                $adrow = $adexist->fetch();
                $adcount = $adrow['adcount'];
            $request = json_encode([
                "content" => "",
                "embeds" => [
                    [
                        "author" => [
                            "name" => "Ad sent from ".$steamprofile['personaname'] . " (" . $steamprofile['steamid'] . ")",
                            "url" => $steamprofile['profileurl'],
                            "icon_url" => $steamprofile['avatarmedium']
                        ],
                        "title" => str_replace("@"," ",$_POST['adname']),
                        "type" => "rich",
                        "description" =>  str_replace("@"," ",$_POST['adcontent']),
                        "timestamp" => date("c"),
                    ]
                ]
            ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

            $ch = curl_init("https://discordapp.com/api/webhooks/655554251702927390/-dICp0ReXpC63SW3DNpJqc1zE5hzhJD_HmyBrt5f0Xoh8y-YiErccuXLiRWQj5jrCG3U");

            curl_setopt_array($ch, [
                CURLOPT_POST => 1,
                CURLOPT_FOLLOWLOCATION => 1,
                CURLOPT_HTTPHEADER => array("Content-type: application/json"),
                CURLOPT_POSTFIELDS => $request,
                CURLOPT_RETURNTRANSFER => 1
            ]);


            curl_exec($ch);                   
                
                
                
                    if (!empty($adrow)) {                          
                        SQLWrapper()->prepare("UPDATE ads SET user= :id, adname = :adname, content = :content, overide = :overide, adcount = :adcount WHERE user = :curuser")->execute([':id' => $aduser, ':adname' => $adname,':content' => $adcontent,':curuser' => $aduser,':adcount' => $adcount+1, ':overide' => 0]);                          
                        
                    } else {
                        SQLWrapper()->prepare("INSERT INTO ads (user, adname, content)
                        VALUES (?,?,?)")->execute([$aduser,  $adname, $adcontent]);
                                          
                    }
                    $Message["success"] = true;
                    $Message["message"] = "Thank you for advertising! You should see your ad appear in the server shortly.";
               }
                }else{
                    $Message["message"] = "You need to be verified in my discord server to do this!";
                }
            }else{
                $Message["message"] = "It appears you've been banned!";
            }
            }else{
                $Message["message"] = "You need to be logged to advertise!";

            }      
    

}
die(json_encode($Message));