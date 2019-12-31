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
            $motdchanged = false;
            if (isset($_SESSION['steamid'])){ 
              if (isAdmin($_SESSION['steamid'])){


             $cachedfiles = scandir("../cache");
                $ignored = array('.', '..', '.svn', '.htaccess','.gitignore','.gitkeep'); 
                $totalcached = count($cachedfiles) - 3;
                    if(isset($_POST['clear-cache']) and isMasterAdmin($_SESSION['steamid'])){
                       
                       foreach ($cachedfiles as $deletefile){
                        if (in_array($deletefile, $ignored)) continue;
                        $filename = '../cache/'.$deletefile;
                        unlink ($filename);
                        header("Refresh:0");
                        header("Location: content.php?cache-cleared"); 

                       }
                    }elseif(isset($_POST['clear-cache'])){
                        $notadmin = true;
                    }

                    

                     if(isset($_POST['unlock-ad'])){
                        if (isMasterAdmin($_SESSION['steamid'])){ 
                        $unlockid = $_POST['unlock-ad'];
                        
                        $unlocadq = SQLWrapper()->prepare("UPDATE ads SET overide = :overide WHERE user= :id");
                        $unlocadq->execute([':id' => $unlockid,':overide' => "1"]);
                        header("Location: content.php?unlock-success"); 
                        }else{
                            header("Location: content.php?not-sponge"); 
                        }
                        
                    }

                    if(isset($_POST['newpage'])){
                        if (isMasterAdmin($_SESSION['steamid'])){ 
                        $pagename = $_POST['pagename'];
                        $pageid = $_POST['pageid'];
                        $newpq = SQLWrapper()->prepare("INSERT INTO content (thing,title,created)VALUES (?,?,?)")->execute([$pageid, $pagename,$_SESSION['steamid']]);
                        $newpage = fopen('../'.$pageid.'.php', 'w');
                        $temp = file_get_contents("template.php");
                        $txt = str_replace("BIGCHUNGUS","'".$pageid."'",$temp);
                        fwrite($newpage, $txt);
                        fclose($pagename);
                        header("Location: content.php?page-created"); 
                        }else{
                            header("Location: content.php?not-sponge"); 
                        }
                        
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
                <?php if(isMasterAdmin($steamprofile['steamid'])){
                      ?> 
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
                    <br>
                    <div class="card">
                        <div class="card-header">
                            <h3>Pages</h3>
                        </div>
                        <div class="card-body">  
                            <form  action="content.php" method="post" >
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label for="pagename">Page Name</label>
                                        <input type="text" class="form-control" name="pagename" id="pagename" placeholder="Enter the name of the page" required>
                                    </div>
                                    <div class="form-group col">
                                        <label for="pageid">Page Name</label>
                                        <input type="text" class="form-control" name="pageid" id="pageid" placeholder="Enter a unquie ID for the page" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary" name="newpage">Create New Page</button>
                                </div>
                            </form>

                        <br>
                                                          
                                <table class="table paragraph text-center">
                                    <thead>
                                        <tr>
                                        
                                        <th scope="col">Page Name</th>
                                        <th scope="col">Last Modified</th>
                                        <th scope="col">Last Editor</th>
                                        <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $pagesq = SQLWrapper()->prepare("SELECT thing,UNIX_TIMESTAMP(stamp) AS stamp,created,title FROM content");
                                        $pagesq->execute();
                                        while($row = $pagesq->fetch()){ 
                                            $createdurl = "https://steamcommunity.com/profiles/".$row['created']."/"; 
                                            $href = "editor.php?id=".$row['thing'];

                                    ?>
                                        <tr>
                                       
                                        <td><?=htmlspecialchars($row["title"]);?></td>
                                        <td><?=htmlspecialchars(date("m/d/Y g:i a", $row["stamp"]));?></td>
                                        <td><a href="<?=htmlspecialchars($createdurl)?>" target="_blank"><?=htmlspecialchars($row["created"]);?></a></td>
                                        <td>
                                        <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button" id="options" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Options
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="options">
                                        <a class="dropdown-item" href="<?=htmlspecialchars($href)?>" target="_blank">Settings</a>
                                        </div>
                                        </div>
                                        </td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                    </div>
                    <br>
                    
                    <?php }?>
                    <div class="card">
                        <div class="card-header">
                          <h3>Currently running ads</h3>
                        </div>
                      <div class="card-body">   
                                      <p class="subsubhead" style="color: black; text-align: left;">Current ads in the last 24 hours</p>
                                        <table class="table paragraph " style="color: black;">
                                        <thead>
                                        <tr>
                                        <th scope="col"></th>
                                            <th scope="col">Submitor</th>
                                            <th scope="col">Timestamp</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                      <?php
                                      $sql2 = "SELECT user,overide, UNIX_TIMESTAMP(stamp) AS stamp FROM ads";
                                      $result2 = SQLWrapper()->query($sql2);
                                        while($row2 = $result2->fetch()){ 
                                          $aduurl = "https://steamcommunity.com/profiles/".$row2['user']."/"; 
                                          $admnormalstamp =  date("m/d/Y g:i a", $row2["stamp"]); 
                                          $numDays = abs($row2["stamp"] - time())/60/60/24;
                                          if($numDays <= 1 and !$row2['overide']){
                                            
                                            ?>
                                            
                                            <tr><td>
                                            <form action="content.php" method="post" >
                                            <button type="submit" value="<?=htmlspecialchars($row2["user"]);?>" name="unlock-ad" class="btn btn-primary" >
                                                Unlock
                                            </button>
                                        </form>
                                    </td><td><a href="<?=htmlspecialchars($aduurl)?>" target="_blank"><?=htmlspecialchars($row2["user"]);?></a></td><td><?=htmlspecialchars($admnormalstamp);?></td></tr> 
                                            
                                            <?php
                                        }
                                    }
                                      ?>
                                      </tbody>
                                        </table>
                            </div>
                          </div>
                        <br>
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
                <script src="https://cdn.tiny.cloud/1/dom10ctinmaceofbm524vgsfebgy22lsh2ooomg0oqs8wu28/tinymce/5/tinymce.min.js"></script>
                <script>tinymce.init({selector:'textarea', branding: false, plugins: "link",default_link_target: "_blank"});</script>
                <script>
                	function basicPopup() {
                        popupWindow = window.open(document.getElementById("privacy").value,'popUpWindow','height=500,width=500,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');
                            }
                </script>
                <?php                    
                      if($notadmin == true){
                        ?>
                        <script type="text/JavaScript">  
                        toastr["error"]("You cannot do this because you are not DriedSponge!", "Error:")     
                        </script>
                    <?php
                      }
 
                      if(isset($_GET['cache-cleared'])){
                      ?>
                      <script type="text/JavaScript">  
                      toastr["success"]("The cache has been cleared!", "Congratulations!")     
                      </script>
                      <?php 
                      } 
                      
                        if(isset($_GET['not-sponge'])){
                        ?>
                        <script type="text/JavaScript">  
                      toastr["error"]("You are not DriedSponge", "Error")     
                      </script>
                        <?php
                        }
                        if(isset($_GET['unlock-success'])){
                        ?>
                                <script type="text/JavaScript">  
                                toastr["success"]("This user can now advertise again", "Congratulations!")     
                                </script>
                        <?php
                        }
                        if(isset($_GET['privacy-success'])){
                            ?>
                            <script type="text/JavaScript">  
                            toastr["success"]("The privacy policy has been changed!", "Congratulations!")     
                            </script>
                            <?php
                        }
                        ?>
 </body>

</html>