<?php
require('steamauth/steamauth.php');  
include("databases/connect.php");
?>
<!DOCTYPE html>


<html>
    <head>
<!--         Site created: 9/19/19
        Author: DriedSponge(Jordan Tucker) -->

        <meta name="description" content="DriedSponge.net's Privacy Policy">
        <meta name="keywords" content="privacy policy, driedsponge.net privacy, driedsponge.net privacy policy">
        <meta name="author" content="Jordan Tucker">
        <meta property="og:site_name" content="DriedSponge.net | Privacy Policy" />
       
        <?php 
            include("meta.php"); 
            ?>
        
        <title>Privacy Policy</title>
        <script src="https://kit.fontawesome.com/0add82e87e.js" crossorigin="anonymous"></script>
    </head>
 <body>
<?php
include("navbar.php");
$privacypolicyquery = SQLWrapper()->prepare("SELECT content,UNIX_TIMESTAMP(stamp) AS stamp FROM content WHERE thing = :thing");
$privacypolicyquery->execute([':thing' => "privacy"]);
$content = $privacypolicyquery->fetch();
$plastupdated = date("m/d/Y g:i a", $content["stamp"]);
?>

    <div class="app">
    <div class="container-fluid-lg" style="padding-top: 80px;">
            <div class="container">
                <hgroup>
                        <!-- <img src="https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/18/18be38c2f230fea0fa667c8165e4da5cb1a787c0_full.jpg" alt="DriedSponge's Profile Picture"> -->
                        <h1 class="display-2"><strong>Privacy Policy & Terms</strong></h1>   
                </hgroup>
                <br>
                   <?=htmlspecialchars_decode($content['content']);?>
                    <br>
                    <p class="paragraph"><cite>Last Updated: <?=htmlspecialchars_decode($plastupdated);?></cite></p>
                    </div>
                </div>

            </div>
            <!-- end of app -->
            <?php 
            include("footer.php"); // we include footer.php here. you can use .html extension, too.
            ?>
                
                <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
                <script src="https://unpkg.com/popper.js@1"></script>
                <script src="https://unpkg.com/tippy.js@4"></script>
                <script src="main.js"></script>
              
 </body>






</html>