
<!DOCTYPE html>


<html>
    <head>
<!--         Site created: 9/19/19
        Author: DriedSponge(Jordan Tucker) -->
        
        <meta name="description" content="Need to look something up about a user on steam? Do it here! Use any SteamID or profile URL to look up information!" />
        <meta name="keywords" content="driedsponge.net, SteamID finder, SteamID, SteamAPI, Steam users, SteamID search, steam convert, steamid converter, steamurl converter, steam converter, SteamID64, SteamID3, steam profile lookup" />
        <meta name="author" content="Jordan Tucker" />
        
        <meta property="og:site_name" content="DriedSponge.net | Steam ID Tool" />
        <?php 
            include("meta.php"); 
            ?>
            
        <title>Steam ID Tool</title>
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
                            <h1 class="display-2"><strong>SteamID Tool</strong></h1>
                        <br>
                    </hgroup>
                    <p class="paragraph pintro">Need to look something up about a user on steam? Do it here! Use any SteamID or profile URL to look up information! For more info on the site visit my <a href="webdesign.php">Web Projects </a>page.</p>
                    <br>
                    
                    <?php
                    
                    include("search.php");
                        ?>
                    
                    

                        </div>
</div>
</div> 
<!-- End of "app" -->
<?php 
    include("hex.php");
    include("footer.php"); // we include footer.php here. you can use .html extension, too.
    ?>




                
                <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> 
        <script src="https://unpkg.com/popper.js@1"></script>
        <script src="https://unpkg.com/tippy.js@4"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
        <script src="main.js"></script> 
        <script src="search.js"></script>
        <script>
                    navitem = document.getElementById('steam').classList.add('active')
                    
                </script>
 </body>






</html>