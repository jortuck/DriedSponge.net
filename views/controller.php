<?php

include("views/includes/SteamID.php");

$APIKEY = "0EBBACAEBC6039B06DF1066807D55D4C";
$WHO = $id;


//$url = $_SERVER["SCRIPT_NAME"];
//$break = Explode('/', $url);
//$file = $WHO;
//$str = str_replace(":","+",$WHO);
//$str2 = str_replace("/","-",$str);
//$cachefile = 'cache/cached-'.substr_replace($str2 ,"",-4).'.htm';
//$cachetime = 300;

// Serve from the cache if it is younger than $cachetime
//if (file_exists($cachefile) && time() - $cachetime < filemtime($cachefile)) {
 //   echo "<!-- Cached copy, generated ".date('H:i', filemtime($cachefile))." -->\n";
 //   readfile($cachefile);
 //   exit;
//}else{
//ob_start(); // Start the output buffer

    $s = SteamID::SetFromURL( $WHO, function( $URL, $Type ) use ( $APIKEY )
    {
        $Parameters =
        [
            'format' => 'json',
            'key' => $APIKEY,
            'vanityurl' => $URL,
            'url_type' => $Type
        ];
        
        $c = curl_init( );
        
        curl_setopt_array( $c, [
            CURLOPT_USERAGENT      => 'Steam Vanity URL Lookup',
            CURLOPT_ENCODING       => 'gzip',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL            => 'https://api.steampowered.com/ISteamUser/ResolveVanityURL/v1/?' . http_build_query( $Parameters ),
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_TIMEOUT        => 5
        ] );
        
        $Response = curl_exec( $c );
        
        curl_close( $c );
        
        $Response = json_decode( $Response, true );
        
        if( isset( $Response[ 'response' ][ 'success' ] ) )
        {
            switch( (int)$Response[ 'response' ][ 'success' ] )
            {
                case 1: return $Response[ 'response' ][ 'steamid' ];
                case 42: header("Location: /steam/error");
                
            }
        }
        
        throw new Exception( 'Failed to perform API request' );
        
    } );
 

$id3 = $s->RenderSteam3() . PHP_EOL;
$idn = $s->RenderSteam2() . PHP_EOL;
$id64 = $s->ConvertToUInt64() . PHP_EOL;

$json = file_get_contents("http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=".$APIKEY."&steamids=$id64");
$apidata = json_decode($json);
$name = $apidata->response->players[0]->personaname;
$img = $apidata->response->players[0]->avatarfull;
if (isset($apidata->response->players[0]->realname) == false ){
    $realname = "N/A";
} else{
    $realname = $apidata->response->players[0]->realname;
}

if (isset($apidata->response->players[0]->loccountrycode) == false ){
    $country = "N/A";
} else{
    $country = $apidata->response->players[0]->loccountrycode;
}

$url = $apidata->response->players[0]->profileurl;
if ($name == null || $img == null ){
    header("Location: /steam/error");
}
// Cache the contents to a cache file

?>

<!DOCTYPE html>
<html>
    <head>
<!--         Site created: 9/19/19
        Author: DriedSponge(Jordan Tucker) -->
           
        <?php 
            include("views/includes/meta.php"); 
            ?>
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="description"  content="Name: <?=htmlspecialchars($name);?>,SteamID64: <?=htmlspecialchars($id64);?>, SteamID: <?=htmlspecialchars($idn);?>, SteamID3: <?=htmlspecialchars($id3);?>, URL: <?=htmlspecialchars($url);?>" />
        <meta name="keywords" content="<?=htmlspecialchars($name);?>, <?=htmlspecialchars($id64);?>, <?=htmlspecialchars($idn);?>, <?=htmlspecialchars($id3);?>" />
        <meta property="og:site_name" content="DriedSponge.net | SteamID Finder" /> <!-- Replace with your name or whatever you want-->
        <meta property="og:title" content="Info on <?=htmlspecialchars($name);?>" />
        <meta property="og:image" content="<?=htmlspecialchars($img);?>" />
        <meta property="og:image:type" content="image/png" />
        <meta name="author" content="Jordan Tucker">
        <meta property="og:description"  content="SteamID64: <?=htmlspecialchars($id64);?> SteamID: <?=htmlspecialchars($idn);?> SteamID3: <?=htmlspecialchars($id3);?> URL: <?=htmlspecialchars($url);?>" />
        <meta property="og:site_name" content="<?=htmlspecialchars($name);?> - driedsponge.net" />
        <title><?=htmlspecialchars($name);?> - driedsponge.net</title>

        <script src="https://kit.fontawesome.com/0add82e87e.js" crossorigin="anonymous"></script>

        <link rel="stylesheet" href = "//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" type="text/css" >
       

    </head>
    
 <body>

     <div class="app">
        <?php
        include("views/includes/navbar.php")
        ?>
    <div class="container-fluid-lg" style="padding-top: 80px;">
        

        
            <div class="container">
               
                    <hgroup>
                        <h2><strong>Steam ID Tool</strong></h2>
                        <br>
                        
                     <?php
                        include("views/includes/search.php");
                     ?>
                    
                    <br>
                    </hgroup>
                    <div data-aos="fade-up">
                    <div class="jumbotron" style="text-align: center;">
                    <h2><img src="<?=htmlspecialchars($img);?>"/></h2>
                    <h1>Results for: <?=htmlspecialchars($name);?></h1>
                    
                    <p class="jumbotronparagraph"><strong>Username: </strong><?=htmlspecialchars($name);?> <button  value="<?=htmlspecialchars($name);?>" onclick="copything(this.value)" class="btn btn-success"><i class="far fa-copy"></i></button></p>
                    <p class="jumbotronparagraph"><strong>SteamID64:</strong> <?=htmlspecialchars($id64);?> <button  value="<?=htmlspecialchars($id64);?>" onclick="copything(this.value)" class="btn btn-success"><i class="far fa-copy"></i></button></p>
                    <p class="jumbotronparagraph"><strong>SteamID:</strong> <?=htmlspecialchars($idn);?> <button  value="<?=htmlspecialchars($idn);?>" onclick="copything(this.value)" class="btn btn-success"><i class="far fa-copy"></i></button></p>
                    <p class="jumbotronparagraph"><strong>SteamID3:</strong> <?=htmlspecialchars($id3);?> <button value="<?=htmlspecialchars($id3);?>" onclick="copything(this.value)" class="btn btn-success"><i class="far fa-copy"></i></button></p>
                    <p class="jumbotronparagraph"><strong>Profile URL:</strong> <a class="jumbaurl" target="_blank" href="<?=htmlspecialchars($url);?>"><?=htmlspecialchars($url);?></a> <button value="<?=htmlspecialchars($url);?>" onclick="copything(this.value)" class="btn btn-success"><i class="far fa-copy"></i></button></p>
                    <h4 class="jumboh4">Personal Info (This may not be accurate)</h4><br>
                    <p class="jumbotronparagraph"><strong>Real Name:</strong> <?=htmlspecialchars($realname);?> <button value="<?=htmlspecialchars($realname);?>" onclick="copything(this.value)" class="btn btn-success"><i class="far fa-copy"></i></button></p>
                    <p  class="jumbotronparagraph"><strong>Country</strong>: <?=htmlspecialchars($country);?> <button value="<?=htmlspecialchars($country);?>" onclick="copything(this.value)" class="btn btn-success"><i class="far fa-copy"></i></button> </p>
                    </div>
                    </div>
                    
                       
            



                    

                        </div>
</div>
</div> 
<!-- End of "app" -->

<?php 
include("views/includes/hex.php");
    include("views/includes/footer.php"); // we include footer.php here. you can use .html extension, too.
    ?>




    
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> 
        <script src="https://unpkg.com/popper.js@1"></script>
        <script src="https://unpkg.com/tippy.js@4"></script>
        <script src="main.js"></script>
        <script>
            AOS.init();
        </script>

        <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script>
        document.getElementById("id64").value = "<?php echo $WHO;?>";

        </script>
        <script>
          function  copything(value){
            

            navigator.clipboard.writeText(value)
            
           toastr["success"](value + " was successfully copied to clipboard", "Congradulations!")

           toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": true,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
                }
          }


        </script>
        <script>
          navitem = document.getElementById('steam').classList.add('active')          
        </script>
 </body>






</html>
<?php

// $cached = fopen($cachefile, 'w');
// fwrite($cached, ob_get_contents());
// fclose($cached);
// ob_end_flush();
// }
?>