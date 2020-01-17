
<!DOCTYPE html>


<html>
    <head>
<!--         Site created: 9/19/19
        Author: DriedSponge(Jordan Tucker) -->
        
        <meta name="description" content="Need to look something up about a user on steam? Do it here! Use any SteamID or profile URL to look up information! If the user you're searching for has a GmodStore profile, their GMS info will show up too!" />
        <meta name="keywords" content="driedsponge.net, SteamID finder, SteamID, SteamAPI, Steam users, SteamID search, steam convert, steamid converter, steamurl converter, steam converter, SteamID64, SteamID3, steam profile lookup" />
        <meta name="author" content="Jordan Tucker" />
        
        <meta property="og:site_name" content="DriedSponge.net | Steam ID Tool" />
        <?php 
            include("views/includes/meta.php"); 
            ?>
            
        <title>Steam ID Tool</title>
        <script src="https://kit.fontawesome.com/0add82e87e.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href = "//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" type="text/css" >

    </head>
    
 <body>
 <?php
include("views/includes/navbar.php")
?>
     <div class="app">
    <div class="container-fluid-lg" style="padding-top: 80px;">

        
            <div class="container">
               
                    <hgroup>
                            <!-- <img src="https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/18/18be38c2f230fea0fa667c8165e4da5cb1a787c0_full.jpg" alt="DriedSponge's Profile Picture"> -->
                            <h1 class="display-2"><strong>SteamID Tool</strong></h1>
                        <br>
                    </hgroup>
                    <p class="paragraph pintro">Need to look something up about a user on steam? Do it here! Use any SteamID or profile URL to look up information! If the user you're searching for has a GmodStore profile, their GMS info will show up too! For more info on the site visit my <a href="/projects/web">Web Projects </a>page.</p>
                    <br>
                    
                    <?php
                    
                    include("views/includes/search.php");
                        ?>
                    <?php
                    if(isset($_SESSION['steamid'])) {
                        $steaminfo = SteamInfo($_SESSION['steamid']);
                        ?>
  
                    <div class="jumbotron" style="text-align: center;">
                    <h2><img src="<?=htmlspecialchars($steaminfo['img']);?>"/></h2>
                    <h1>Your data:</h1>
                    
                    <p class="jumbotronparagraph"><strong>Username:</strong> <?=htmlspecialchars($steaminfo['name']);?> <button  value="<?=htmlspecialchars($steaminfo['name']);?>" onclick="copything(this.value)" class="btn btn-success"><i class="far fa-copy"></i></button></p>
                    <p class="jumbotronparagraph"><strong>SteamID64:</strong> <?=htmlspecialchars($steaminfo['id64']);?> <button  value="<?=htmlspecialchars($steaminfo['id64']);?>" onclick="copything(this.value)" class="btn btn-success"><i class="far fa-copy"></i></button></p>
                    <p class="jumbotronparagraph"><strong>SteamID:</strong> <?=htmlspecialchars($steaminfo['idn']);?> <button  value="<?=htmlspecialchars($steaminfo['idn']);?>" onclick="copything(this.value)" class="btn btn-success"><i class="far fa-copy"></i></button></p>
                    <p class="jumbotronparagraph"><strong>SteamID3:</strong> <?=htmlspecialchars($steaminfo['id3']);?> <button value="<?=htmlspecialchars($steaminfo['id3']);?>" onclick="copything(this.value)" class="btn btn-success"><i class="far fa-copy"></i></button></p>
                    <p class="jumbotronparagraph"><strong>Profile URL:</strong> <a class="jumbaurl" target="_blank" href="<?=htmlspecialchars($steaminfo['url']);?>"><?=htmlspecialchars($steaminfo['url']);?></a> <button value="<?=htmlspecialchars($steaminfo['url']);?>" onclick="copything(this.value)" class="btn btn-success"><i class="far fa-copy"></i></button></p>
                    <h4 class="jumboh4">Personal Info (This may not be accurate)</h4><br>
                    <p class="jumbotronparagraph"><strong>Real Name:</strong> <?=htmlspecialchars($steaminfo['realname']);?><button value="<?=htmlspecialchars($steaminfo['realname']);?>" onclick="copything(this.value)" class="btn btn-success"><i class="far fa-copy"></i></button></p>
                    <p  class="jumbotronparagraph"><strong>Country</strong>: <?=htmlspecialchars($steaminfo['country']);?> <button value="<?=htmlspecialchars($steaminfo['country']);?>" onclick="copything(this.value)" class="btn btn-success"><i class="far fa-copy"></i></button></p>
                    <?php if(isset($steaminfo['gmsname'])){?>
                    <h4 class="jumboh4">GmodStore Info</h4><br>
                    <p class="jumbotronparagraph"><strong>GmodStore Name:</strong> <?=htmlspecialchars($steaminfo['gmsname']);?> <button value="<?=htmlspecialchars($steaminfo['gmsname']);?>" onclick="copything(this.value)" class="btn btn-success"><i class="far fa-copy"></i></button></p>
                    <p class="jumbotronparagraph"><strong>GmodStore URL:</strong> <a class="jumbaurl" target="_blank" href="<?=htmlspecialchars($steaminfo['gmsurl']);?>"><?=htmlspecialchars($steaminfo['gmsurl']);?></a> <button value="<?=htmlspecialchars($steaminfo['gmsurl']);?>" onclick="copything(this.value)" class="btn btn-success"><i class="far fa-copy"></i></button></p>
                    </div>
                        <?php
                        }
                    }else{
                        ?>
                        <h1 class="articleh1">Login to see your own info</h1>
                    <br>
                    <p style="text-align: center;"><a href='?login'><img src='https://steamcommunity-a.akamaihd.net/public/images/signinthroughsteam/sits_02.png'></a></p>
                            <?php
                    }
                    



                    ?>
                    

                        </div>
</div>
</div> 
<!-- End of "app" -->
<?php 
    include("views/includes/hex.php");
    include("views/includes/footer.php"); // we include footer.php here. you can use .html extension, too.
    ?>




                
                <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> 
        <script src="https://unpkg.com/popper.js@1"></script>
        <script src="https://unpkg.com/tippy.js@4"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
        <script src="main.js"></script> 
        <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        <script>
                    navitem = document.getElementById('steam').classList.add('active')
                    
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
 </body>






</html>