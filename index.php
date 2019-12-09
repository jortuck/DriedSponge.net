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
include("navbar.php")
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
                <h4 class="subheading">About Me</h5>
                    <p class="paragraph" style="text-align: center;" >I do coding for the languages that are listed below. I also play tombone and bass guitar :). I also play a fair ammout of video games. On this site you can find out information on projects I've done. There is also a very epic <a href="steam.php">SteamID tool</a> that I made so go check that out.</p>
                    <br>
                    
                    

                        <h4 class="subheading" style="text-align: center;">What I do...</h4>
                        <br>
                            <div class="row justify-content-center">
                                <div  class="card card-border"  data-aos="fade-up" style="width: 18rem; text-align:center;">
                                <div class="card-body">
                                <img  src="img/html.png" alt="html5logo" height="100px" style="padding: none; margin: none;"/>
                                    <p class="card-text"><i class="fas fa-star fa-1x"></i><i class="fas fa-star fa-1x"></i><i class="fas fa-star fa-1x"></i><i class="fas fa-star fa-1x"></i><i class="fas fa-star fa-1x"></i></p>
                                    
                                </div>
                                </div>
                                
                                <div data-aos="fade-up" class="card card-border" style="width: 18rem; text-align:center;">
                                        <div class="card-body">
                                        <img  src="img/lua.png" alt="lualogo" height="100px" style="padding: none; margin: none;"/>
                                            <p class="card-text"><i class="fas fa-star fa-1x"></i><i class="fas fa-star fa-1x"></i><i class="fas fa-star fa-1x"></i><i class="fas fa-star-half-alt fa-1x"></i><i class="far fa-star fa-1x"></i></p>
                                            
                                        </div>
                                        </div>
                                 <div data-aos="fade-up" class="card card-border" style="width: 18rem; text-align:center;">
                                                <div class="card-body">
                                                <img  src="img/php.png" alt="phplogo" height="100px" style="padding: none; margin: none;"/>
                                                    <p class="card-text"><i class="fas fa-star fa-1x"></i><i class="fas fa-star fa-1x"></i><i class="far fa-star fa-1x"></i><i class="far fa-star fa-1x"></i><i class="far fa-star fa-1x"></i></p>
                                                    
                                                </div>       
                                                </div>
                                  <div  data-aos="fade-up" class="card card-border" style="width: 18rem; text-align:center;">
                                                    
                                                    <div class="card-body">
                                                        <img   src="img/css.png" alt="csslogo" height="100px" style="padding: none; margin: none;"/>
                                                            <p class="card-text"><i class="fas fa-star fa-1x"></i><i class="fas fa-star fa-1x"></i><i class="fas fa-star fa-1x"></i><i class="fas fa-star fa-1x"></i><i class="far fa-star fa-1x"></i></p>
                                                            
                                                        </div>
                                                        </div>              
                                  <div data-aos="fade-up" class="card card-border" style="width: 18rem; text-align:center;">
                                                                <div class="card-body">
                                                                <img  src="img/js.png" alt="jslogo" height="100px" style="padding: none; margin: none;"/>
                                                                    <p class="card-text"><i class="fas fa-star fa-1x"></i><i class="fas fa-star fa-1x"></i><i class="far fa-star fa-1x"></i><i class="far fa-star fa-1x"></i><i class="far fa-star fa-1x"></i></p>
                                                                    
                                                                 </div>
                                                        </div>                      
                            </div>
                            <br>
                       
                    
                            
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