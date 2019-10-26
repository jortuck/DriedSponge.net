
<!DOCTYPE html>


<html>
    <head>
<!--         Site created: 9/19/19
        Author: DriedSponge(Jordan Tucker) -->
        
        <meta name="description" content="Need to look something up about a user on steam? Do it here!">
        <meta name="keywords" content="driedsponge.net, SteamID finder, SteamID, SteamAPI, Steam users, SteamID search">
        <meta name="author" content="Jordan Tucker">
        
        <meta property="og:site_name" content="DriedSponge.net | Web Projects" />
        <?php 
            include("meta.php"); 
            ?>
            
        <title>Steam ID Tool</title>
        <script src="https://kit.fontawesome.com/0add82e87e.js" crossorigin="anonymous"></script>
    </head>
    
 <body>

     <div class="app">
    <div class="container-fluid-lg">
        <div class="page-header">
        
            <nav class="navbar navbar-expand-lg navbar-dark  nbth fixed-top" >
                    <a class="navbar-brand" href="#"><strong>driedsponge.net</strong></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarmain" aria-controls="navbarmain" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                          </button>
                    <div class="collapse navbar-collapse" id="navbarmain">
                            
                        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                            <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="webdesign.php">Web Projects</a></li>
                            <li class="nav-item"><a class="nav-link" href="lua.php">Lua Projects</a></li>
                            <li class="nav-item"><a class="nav-link" href="tutorials/index.php">Coding Tutorials</a></li>
                            <li class="nav-item active"><a class="nav-link" href="steam.php">Steam Tool<span class="sr-only">(current)</span></a></li>
                        </ul>  
                        </div>
                  </nav>
                
                  
        </div>
        
    </div>
    <div class="container-fluid-lg" style="padding-top: 80px;">
        

        
        

                            
   
        
            <div class="container">
               
                    <hgroup>
                            <!-- <img src="https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/18/18be38c2f230fea0fa667c8165e4da5cb1a787c0_full.jpg" alt="DriedSponge's Profile Picture"> -->
                        <h2><strong>Steam ID Tool</strong></h2>
                        <br>
                    </hgroup>
                    <p class="paragraph">Need to look something up about a user on steam? Do it here! For more info on the site visit my <a href="webdesign.php">Web Projects </a>page</p>
                    <br>
                    <form id="steamform">
                      <div class="form-group">
                        
                        <input id="id64" type="text" class="form-control"  aria-describedby="emailHelp" placeholder="Enter a SteamID/SteamID64/SteamID3">
                      </div>
                      <button onclick="go()" type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    
                          
            



                    

                        </div>
</div>
</div> 
<!-- End of "app" -->
<?php 
    include("footer.php"); // we include footer.php here. you can use .html extension, too.
    ?>




                
                <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> 
        <script src="https://unpkg.com/popper.js@1"></script>
        <script src="https://unpkg.com/tippy.js@4"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
        <script src="main.js"></script> 
        <script>
        function go(){
        var input = document.getElementById("id64").value;
        open("controller.php?id=" + input);
    
        }
        </script>

 </body>






</html>