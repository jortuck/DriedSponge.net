<!DOCTYPE html>


<html>
    <head>
<!--         Site created: 9/19/19
        Author: DriedSponge(Jordan Tucker) -->

        <meta name="description" content="Steam Error">
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

 <?php
include("navbar.php")
?>
    
    <div class="app">
    <div class="container-fluid-lg" style="padding-top: 80px;">
      
   
        
            <div class="container">
            <div class="form-group">
            <hgroup>
                        <h2><strong>Steam ID Tool</strong></h2>
                        <br>
                    </hgroup>
                    <?php
                        include("search.php");
                     ?>
                <div class="jumbotron">
                <hgroup >
                        <h1><i class="fas fa-user-times"></i></h1>
                    <h1><strong>Error: Invalid data!</strong></h1>

                    <br>
                </hgroup>

                <p class="ep">The data you entered in to the SteamID finder was invalid or the account no longer exist!</p>
                <br>
                <!-- <p style="text-align: center;"><button class="btn btn-success" onclick="goback()"><strong class="btntext">Go Back</strong></button></p>
                <p style="text-align: center;"><a href="steam.php"><button class="btn btn-success"><strong class="btntext">Try Again</strong></button></a></p> -->
                 </div>

            </div>
        </div>
    </div>
</div>
            <!-- end of app -->
            <?php 
            include("hex.php");
            include("footer.php"); // we include footer.php here. you can use .html extension, too.
            ?>
                
                <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
                <script src="https://unpkg.com/popper.js@1"></script>
                <script src="https://unpkg.com/tippy.js@4"></script>
                <script src="main.js"></script>
                <script>
                document.getElementById("id64").value = "<?php echo $WHO; ?>";

                </script>
                <script>
                      function goback() {
                        window.history.back();
                            }

                 </script>   
                
                <script>
                    navitem = document.getElementById('steam').classList.add('active')
                    
                </script>
                <script src="search.js"></script>
 </body>






</html>