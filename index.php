<?php
require('steamauth/steamauth.php');  
include("databases/connect.php");


                                    
?>
<!DOCTYPE html>


<html>
    <head>
<!--         Site created: 9/19/19
        Author: DriedSponge(Jordan Tucker) -->

        <meta name="description" content="DriedSponge's Portfolio - Find out info about me and the stuff I make. It's epic guys.">
        <meta name="keywords" content="Portfolio">
        <meta name="author" content="Jordan Tucker">
        <meta property="og:site_name" content="DriedSponge.net | Home" />
       
        <?php 
            include("meta.php"); 
            ?>
        
        <title>DriedSponge.net</title>
        <script src="https://kit.fontawesome.com/0add82e87e.js" crossorigin="anonymous"></script>
        
        
        
       
        </head>

 <body>
<?php
include("navbar.php");
$motdq = SQLWrapper()->prepare("SELECT content, UNIX_TIMESTAMP(stamp) AS stamp, created FROM content WHERE thing = :thing");
$motdq->execute([':thing' => "motd"]);
$content = $motdq->fetch();
$mlastupdated = date("m/d/Y g:i a", $content["stamp"]);
$mcreatedby = $content["created"];
$mcreatedbyurl = "https://steamcommunity.com/profiles/".$mcreatedby."/";
?>

    <div class="app">
    <div class="container-fluid-lg" style="padding-top: 80px;">

        
            <div class="container">
                <hgroup>
                        <!-- <img src="https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/18/18be38c2f230fea0fa667c8165e4da5cb1a787c0_full.jpg" alt="DriedSponge's Profile Picture"> -->
                    <h1 class="display-2"><strong>Welcome to my website!</strong></h1>
                    
                    <br>
                    <br>
                </hgroup>
                
                <br>
                <h4 class="subheading">About Me</h5>
                    <p class="paragraph" style="text-align: center;" >I am a developer that primarily focuses on full stack web development. I also develop discord bots and Garry's Mod addons.</p>
                    <br>
                    
                    

                        <h4 class="subheading" style="text-align: center;">What I do...</h4>
                        <br>
                            <div class="row justify-content-center">
                                <div  class="card card-border"  data-aos="fade-up" style="width: 20%; text-align:center;">
                                <div class="card-body">
                                <img  src="img/html.png" alt="html5logo" height="100px" style="padding: none; margin: none;"/>
                                <br>
                                </div>
                                </div>
                                
                                <div data-aos="fade-up" class="card card-border" style="width: 20%; text-align:center;">
                                        <div class="card-body">
                                        <img  src="img/lua.png" alt="lualogo" height="100px" style="padding: none; margin: none;"/>
                                            
                                        </div>
                                        </div>
                                 <div data-aos="fade-up" class="card card-border" style="width: 20%; text-align:center;">
                                                <div class="card-body">
                                                <img  src="img/php.png" alt="phplogo" height="100px" style="padding: none; margin: none;"/>
                                                    
                                                </div>       
                                                </div>
                                  <div  data-aos="fade-up" class="card card-border" style="width: 20%; text-align:center;">
                                                    
                                            <div class="card-body">
                                            <img   src="img/css.png" alt="csslogo" height="100px" style="padding: none; margin: none;"/>
                                                 
                                            </div>
                                        </div>              
                                  <div data-aos="fade-up" class="card card-border" style="width: 20%; text-align:center;">
                                                    <div class="card-body">
                                                <img  src="img/js.png" alt="jslogo" height="100px" style="padding: none; margin: none;"/>
                                                                    
                                                </div>
                                            </div>                      
                            </div>
                            <br>
                            <br>
                            <div class="card">
                                    <div class="card-header">
                                        <h3>Message of the day!</h3>
                                    </div>
                                        <div class="card-body">
                                            <?=htmlspecialchars_decode($content["content"])?>
                                        </div>
                                        <div class="card-footer text-muted">
                                            Last updated: <?=htmlspecialchars($mlastupdated)?> | Updated by: <a href="<?=htmlspecialchars($mcreatedbyurl)?>" target="_blank"><?=htmlspecialchars($mcreatedby)?></a>
                                        </div>
                                </div>
                    
                            
                        </div>
                    <br>

                



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
                <script>
                    navitem = document.getElementById('homelink').classList.add('active')
                    
                </script>
     <script>
            AOS.init();
        </script>
 </body>






</html>