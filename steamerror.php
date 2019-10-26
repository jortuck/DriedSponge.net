<!DOCTYPE html>


<html>
    <head>
<!--         Site created: 9/19/19
        Author: DriedSponge(Jordan Tucker) -->

        <meta name="description" content="DriedSponge.net | Steam Error">
        <meta name="author" content="Jordan Tucker">
        <meta property="og:site_name" content="DriedSponge.net | Steam Error" />
       
        <?php 
            include("meta.php"); 
            ?>
        
        <title>Error</title>
        <script src="https://kit.fontawesome.com/0add82e87e.js" crossorigin="anonymous"></script>
        <style>
        hgroup h1{
            text-align: center;
            font-size: 60px; 
            color: white;
        }
        .ep{
            text-align: center;
            font-size: 30px; 
            color: white;
            
        }
        .btntext{
            font-size: 30px; 
        }
    </style>
    </head>
 <body>

    
    <div class="container-fluid-lg">
        <div class="page-header">
        
            <nav class="navbar navbar-expand-lg navbar-dark nbth fixed-top" >
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
    <div class="app">
    <div class="container-fluid-lg" style="padding-top: 80px;">
      
   
        
            <div class="container">
                <div class="jumbotron">
                <hgroup >
                        <h1><i class="fas fa-user-times"></i></h1>
                    <h1><strong>Error: Invalid data!</strong></h1>

                    <br>
                </hgroup>

                <p class="ep">The data you entered in to the SteamID finder was invalid or the account no longer exist!</p>
                <br>
                <p style="text-align: center;"><button class="btn btn-success" onclick="goback()"><strong class="btntext">Go Back</strong></button></p>
                <p style="text-align: center;"><a href="steam.php"><button class="btn btn-success"><strong class="btntext">Try Again</strong></button></a></p>
                 </div>

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
                      function goback() {
                        window.history.back();
                            }

                 </script>   
                
     
 </body>






</html>