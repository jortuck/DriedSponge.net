
<!DOCTYPE html>


<html>
    <head>
<!--         Site created: 9/19/19
        Author: DriedSponge(Jordan Tucker) -->

        <meta name="description" content="Steam Error">
        <meta name="author" content="Jordan Tucker">
        <meta property="og:site_name" content="DriedSponge.net | Steam Error" />
       
        <?php 
            include("views/includes/meta.php"); 
            ?>
        
        <title>Error</title>
        <script src="https://kit.fontawesome.com/0add82e87e.js" crossorigin="anonymous"></script>

    </head>
 <body>

 <?php
include("views/includes/navbar.php")
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
                        include("views/includes/search.php");
                     ?>
                <br>
                    <div class="text-center">
                    
                    <h1><i class="fas fa-user-slash"></i></h1>
                    <h1><strong>User not found</strong></h1>
                    
                    
               

                    <br>
                    </div>
                

            </div>
        </div>
    </div>
</div>
            <!-- end of app -->
            <?php 
            include("views/includes/hex.php");
            include("views/includes/footer.php"); // we include footer.php here. you can use .html extension, too.
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


 </body>






</html>