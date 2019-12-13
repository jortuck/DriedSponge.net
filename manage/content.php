<?php
require('../steamauth/steamauth.php'); 
include("../databases/connect.php");
?>
<!DOCTYPE html>


<html>
    <head>
<!--         Site created: 9/19/19
        Author: DriedSponge(Jordan Tucker) -->

        <meta name="description" content="Admins only guys">
        <meta name="keywords" content="driedsponge.net mange">
        <meta name="author" content="Jordan Tucker">
        <meta property="og:site_name" content="DriedSponge.net | Mangement" />
       
        <?php 
            include("../meta.php"); 
            ?>
        
        <title>Manage - Content Management</title>
        <script src="https://kit.fontawesome.com/0add82e87e.js" crossorigin="anonymous"></script>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <link rel="stylesheet" href = "//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" type="text/css" >
        
    </head>
 <body>

<?php
include("../tutorials/navbar.php");

?>
<style>
.dropdown-head-link{
  color: black;
  text-decoration: none;

}
.dropdown-head-link:hover{
  color: black;
  text-decoration: underline;

}

</style>

    <div class="app">
    <div class="container-fluid-lg" style="padding-top: 80px;">
        
            <div class="container">
            
            <?php 
            $notadmin = false;
            $cachecleared = false;
            if (isset($_SESSION['steamid'])){ 
              if (isAdmin($_SESSION['steamid'])){
                
                $cachedfiles = scandir("../cache");
                $ignored = array('.', '..', '.svn', '.htaccess','.gitignore','.gitkeep'); 
                $totalcached = count($cachedfiles) - 3;
                    if(isset($_POST['clear-cache']) and isMasterAdmin($_SESSION['steamid'])){
                       $cachecleared = true;
                       foreach ($cachedfiles as $deletefile){
                        if (in_array($deletefile, $ignored)) continue;
                        $filename = '../cache/'.$deletefile;
                        unlink ($filename);

                       }
                    }elseif(isset($_POST['clear-cache'])){
                        $notadmin = true;
                    }
                ?>
                    <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link nav-tab" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-tab" href="users.php">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-tab active" href="content.php">Content Mangement</a>
                </li>
                </ul>
                <br>
                <hgroup>
                        <h1 class="display-4"><strong>Content Mangement</strong></h1>
                </hgroup>
                <br>
                    <div class="card">
                        <div class="card-header">
                            <h3>Cache</h3>
                        </div>
                            <div class="card-body text-center">
                                <p class="paragraph">Current ammout of items in cache: <strong><?=htmlentities($totalcached);?></strong></p>
                                <br>
                                <form action="content.php" method="post" >
                                        <button type="submit" name="clear-cache" class="btn btn-danger paragraph" >
                                        Clear Cache
                                    </button>
                                </form>
                            </div>
                    </div>
                <?php }else{ ?>
                    <hgroup>
                        <h1 class="display-2"><strong>You are not management, get out!</strong></h1>
                        <?php
                        header("Location: ../index.php");
                        ?>
                    
                    <br>
                </hgroup>

                <?php 
            }
            
        }else{
        ?>
        <h1 class="articleh1">Please login to manage.</h1>
                    <br>
                    <p class="text-center"><a href='?login'><img src='https://steamcommunity-a.akamaihd.net/public/images/signinthroughsteam/sits_02.png'></a></p>
        <?php
        }
            ?>
                    </div>
                </div>

            </div>
            <!-- end of app -->
            <?php 
            include("../footer.php"); // we include footer.php here. you can use .html extension, too.
            ?>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
                <script src="https://unpkg.com/popper.js@1"></script>
                <script src="https://unpkg.com/tippy.js@4"></script>
                <script src="main.js"></script>
                <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
                <?php                    
                      if($notadmin == true){
                        ?>
                        <script type="text/JavaScript">  
                        toastr["error"]("You cannot do this because you are not DriedSponge!", "Error:")     
                        </script>
                    <?php
                      }
 
                      if($cachecleared == true){
                      ?>
                      <script type="text/JavaScript">  
                      toastr["success"]("The cache has been cleared!", "Congradulations!")     
                      </script>
                      <?php 
                      } 
                        ?>
 </body>

</html>