<?php


// Cache the contents to a cache file
$url = $_SERVER["SCRIPT_NAME"];
$break = Explode('/', $url);
$file = $id;
$str = str_replace(":","+",$id);
$str2 = str_replace("/","-",$str);
$cachefile = 'cache/cached-'.$str2.'.htm';
$cachetime = 300;


//Serve from the cache if it is younger than $cachetime
if (file_exists($cachefile) && time() - $cachetime < filemtime($cachefile)) {
    echo "<!-- Served From Cache -->";
   readfile($cachefile);
   exit;
}else{
   $steaminfo = SteamInfo($id);
ob_start(); 

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
        <meta name="description"  content="Name: <?=htmlspecialchars($steaminfo['name']);?>,SteamID64:<?=htmlspecialchars($steaminfo['id64']);?>, SteamID: <?=htmlspecialchars($steaminfo['idn']);?>, SteamID3: <?=htmlspecialchars($steaminfo['id3']);?>, URL:<?=htmlspecialchars($steaminfo['url']);?>" />
        <meta name="keywords" content="<?=htmlspecialchars($steaminfo['name']);?>, <?=htmlspecialchars($steaminfo['id64']);?>, <?=htmlspecialchars($steaminfo['idn']);?>, <?=htmlspecialchars($steaminfo['id3']);?>" />
        <meta property="og:site_name" content="DriedSponge.net | SteamID Finder" /> <!-- Replace with your name or whatever you want-->
        <meta property="og:title" content="Info on <?=htmlspecialchars($steaminfo['name']);?>" />
        <meta property="og:image" content="<?=htmlspecialchars($steaminfo['img']);?>" />
        <meta property="og:image:type" content="image/png" />
        <meta name="author" content="Jordan Tucker">
        <meta property="og:description"  content="SteamID64: <?=htmlspecialchars($steaminfo['id64']);?> SteamID: <?=htmlspecialchars($steaminfo['idn']);?> SteamID3: <?=htmlspecialchars($steaminfo['id3']);?> URL: <?=htmlspecialchars($steaminfo['url']);?>" />
        <meta property="og:site_name" content="<?=htmlspecialchars($steaminfo['name']);?> - driedsponge.net" />
        <title><?=htmlspecialchars($steaminfo['name']);?> - driedsponge.net</title>

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
                    <h2><img src="<?=htmlspecialchars($steaminfo['img']);?>"/></h2>
                    <h1>Info on <?=htmlspecialchars($steaminfo['name']);?></h1>
                    
                    <p class="jumbotronparagraph"><strong>Username:</strong> <?=htmlspecialchars($steaminfo['name']);?> <button  value="<?=htmlspecialchars($steaminfo['name']);?>" onclick="copything(this.value)" class="btn btn-success"><i class="far fa-copy"></i></button></p>
                    <p class="jumbotronparagraph"><strong>SteamID64:</strong> <?=htmlspecialchars($steaminfo['id64']);?> <button  value="<?=htmlspecialchars($steaminfo['id64']);?>" onclick="copything(this.value)" class="btn btn-success"><i class="far fa-copy"></i></button></p>
                    <p class="jumbotronparagraph"><strong>SteamID:</strong> <?=htmlspecialchars($steaminfo['idn']);?> <button  value="<?=htmlspecialchars($steaminfo['idn']);?>" onclick="copything(this.value)" class="btn btn-success"><i class="far fa-copy"></i></button></p>
                    <p class="jumbotronparagraph"><strong>SteamID3:</strong> <?=htmlspecialchars($steaminfo['id3']);?> <button value="<?=htmlspecialchars($steaminfo['id3']);?>" onclick="copything(this.value)" class="btn btn-success"><i class="far fa-copy"></i></button></p>
                    <p class="jumbotronparagraph"><strong>Profile URL:</strong> <a class="jumbaurl" target="_blank" href="<?=htmlspecialchars($steaminfo['url']);?>"><?=htmlspecialchars($steaminfo['url']);?></a> <button value="<?=htmlspecialchars($steaminfo['url']);?>" onclick="copything(this.value)" class="btn btn-success"><i class="far fa-copy"></i></button></p>
                    <h4 class="jumboh4">Personal Info (This may not be accurate)</h4><br>
                    <p class="jumbotronparagraph"><strong>Real Name:</strong> <?=htmlspecialchars($steaminfo['realname']);?> <button value="<?=htmlspecialchars($steaminfo['realname']);?>" onclick="copything(this.value)" class="btn btn-success"><i class="far fa-copy"></i></button></p>
                    <p  class="jumbotronparagraph"><strong>Country</strong>: <?=htmlspecialchars($steaminfo['country']);?> <button value="<?=htmlspecialchars($steaminfo['country']);?>" onclick="copything(this.value)" class="btn btn-success"><i class="far fa-copy"></i></button> </p>
                    <?php if(isset($steaminfo['gmsname'])){?>
                    <h4 class="jumboh4">GmodStore Info</h4><br>
                    <p class="jumbotronparagraph"><strong>GmodStore Name:</strong> <?=htmlspecialchars($steaminfo['gmsname']);?> <button value="<?=htmlspecialchars($steaminfo['gmsname']);?>" onclick="copything(this.value)" class="btn btn-success"><i class="far fa-copy"></i></button></p>
                    <p class="jumbotronparagraph"><strong>GmodStore URL:</strong> <a class="jumbaurl" target="_blank" href="<?=htmlspecialchars($steaminfo['gmsurl']);?>"><?=htmlspecialchars($steaminfo['gmsurl']);?></a> <button value="<?=htmlspecialchars($steaminfo['gmsurl']);?>" onclick="copything(this.value)" class="btn btn-success"><i class="far fa-copy"></i></button></p>
                    </div>
                        <?php
                        }
                        ?>
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

$cached = fopen($cachefile, 'w');
fwrite($cached, ob_get_contents());
fclose($cached);
ob_end_flush(); // Send the output to the browser
}
?>
