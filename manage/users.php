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
        
        <title>Manage - Users</title>
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
            $useralreadyexist = false;
            $blocksuccess = false;
            $unblocksuccess = false;
            $hiresuccess = false;
            $firesuccess = false;
            $notdsponge = false;
            $alreadystaff = false;
            if (isset($_SESSION['steamid'])){ 
              $isadminid = $_SESSION['steamid'];
              $isadminidquery = $conn->prepare("SELECT id64 FROM staff WHERE id64 = :id");
              $isadminidquery->execute([':id' => $isadminid]);
              $isadmin = $isadminidquery->fetch();
            if ($_SESSION['steamid'] == "76561198357728256" or !empty($isadmin)){ 
                    if(isset($_POST['submit-block'])){
                        $blockid = $_POST['id64'];
                        $blockrsn =$_POST['rsn'];
                        $blockstamp = date("r");
                        $sqlblockexistquery = $conn->prepare("SELECT id64 FROM blocked WHERE id64= :id");
                        $sqlblockexistquery->execute([':id' => $blockid]);
                        $blockrows = $sqlblockexistquery->fetch();
                                if (!empty($blockrows)){
                                    $useralreadyexist = true;
                                    $blocksuccess = false;
                                } else{
                                    $sqlblock = $conn->prepare("INSERT INTO blocked (id64, rsn, stamp)
                                    VALUES (?,?,?)")->execute([$blockid,  $blockrsn,$blockstamp]);
                                    $blocksuccess = true;

                                }
                    }
                    if(isset($_POST['submit-unblock'])){
                        $unblockid = $_POST['submit-unblock'];
                        $sqlunblock = $conn->prepare("DELETE FROM blocked WHERE id64= :id");
                        $sqlunblock->execute([':id' => $unblockid]);
                        $unblocksuccess = true;
                        
                    }
                    if(isset($_POST['submit-fire'])){
                      if ($_SESSION['steamid'] == "76561198357728256"){ 
                      $fireid = $_POST['submit-fire'];
                      $sqlfire = $conn->prepare("DELETE FROM staff WHERE id64= :id");
                      $sqlfire->execute([':id' => $fireid]);
                      $firesuccess = true;
                      }else{
                        $notdsponge = true;
                      }
                      
                  }
                  if(isset($_POST['submit-hire'])){
                    if ($_SESSION['steamid'] == "76561198357728256"){ 
                    $hireid = $_POST['id64'];
                    $hirestamp = date("r");
                    $sqlhireexistquery = $conn->prepare("SELECT id64 FROM staff WHERE id64= :id");
                    $sqlhireexistquery->execute([':id' => $hireid]);
                    $hirerows = $sqlhireexistquery->fetch();
                            if (!empty($hirerows)){                                
                                $hiresuccess = false;
                                $alreadystaff = true;
                            } else{
                                $adminhire = $conn->prepare("INSERT INTO staff (id64, stamp)
                                VALUES (?,?)")->execute([$hireid, $hirestamp]);
                                $hiresuccess = true;

                            }
                }else{
                  $notdsponge = true;
                }
              }

                ?>
                <ul class="nav nav-tabs">
              <li class="nav-item">
                <a class="nav-link nav-tab" href="index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link  nav-tab active" href="users.php">Users</a>
              </li>
              <li class="nav-item">
                <a class="nav-link nav-tab" href="#">Content Mangement</a>
              </li>
            </ul>
            <br>
                <hgroup>
                        <h1 class="display-4"><strong>User Management</strong></h1>
                </hgroup>
                <br>
                <div class="card">
                  <div class="card-header">
                    <h3>User Blacklist</h3>
                  </div>
                <div class="card-body">

                    <form action="users.php" method="post">
                                             <div class="form-row">
                                               <div class="form-group col-md-6">
                                                  <label for="id64" style="color: black;">SteamID64</label>
                                                     <input id="id64" name="id64" type="number" class="form-control"  placeholder="Enter SteamID64"  required>
                                                    </div>
                                                     <br>
                                                     <div class="form-group col-md-6">
                                                        <label for="rsn" style="color: black;">Reason</label>
                                                       <input id="rsn" name="rsn" type="text" class="form-control" placeholder="Enter reason" required>
                                                      </div>
                                                     <br>
                                                     <div class="form-group col-md-6">
                                                    <button name="submit-block" type="submit" class="btn btn-primary">Add User</button>
                                                  </div>
                                                </div>
                                            </form>
                                            
                      <br>
                      <p class="subsubhead" style="color: black; text-align: left;">Current Users</p>
                        <table class="table paragraph pintro" style="color: black;">
                        <thead>
                        <tr>
                        <th scope="col">Buttons!</th>
                            <th scope="col">ID64</th>
                            <th scope="col">Reason</th>
                            <th scope="col">Timestamp</th>
                        </tr>
                        </thead>
                        <tbody>
                      <?php
                      $sql = "SELECT id64, rsn, stamp FROM blocked";
                      $result = $conn->query($sql);
                        while($row = $result->fetch()){   
                            ?>
                            
                            <tr><td>
                            <form action="users.php" method="post" >
                             <button type="submit" value="<?=htmlspecialchars($row["id64"]);?>" name="submit-unblock" class="btn btn-danger" >
                                Remove User
                            </button>
                        </form>
                    </td><td><?=htmlspecialchars($row["id64"]);?></td><td><?=htmlspecialchars($row["rsn"]);?></td><td><?=htmlspecialchars($row["stamp"]);?></td></tr> 
                            
                            <?php
                        }
                      ?>
                      </tbody>
                        </table>
                      </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-header">
                          <h3>Admins</h3>
                        </div>
                      <div class="card-body">
                        <!-- Admin manager -->
                                    <form action="users.php" method="post">
                                                                  <label for="id642" style="color: black;">SteamID64</label>
                                                                    <input id="id642" name="id64" type="number" class="form-control"  placeholder="Enter SteamID64"  required>
                                                                    <br>
                                                                    
                                                                    <button name="submit-hire" type="submit" class="btn btn-primary">Add User</button>
                                                                  
                                                            </form>                   
                                      <br>
                                      <p class="subsubhead" style="color: black; text-align: left;">Current Admins</p>
                                        <table class="table paragraph pintro" style="color: black;">
                                        <thead>
                                        <tr>
                                        <th scope="col">Buttons!</th>
                                            <th scope="col">ID64</th>
                                            <th scope="col">Timestamp</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                      <?php
                                      $sql2 = "SELECT id64, stamp FROM staff";
                                      $result2 = $conn->query($sql2);
                                        while($row2 = $result2->fetch()){   
                                            ?>
                                            
                                            <tr><td>
                                            <form action="users.php" method="post" >
                                            <button type="submit" value="<?=htmlspecialchars($row2["id64"]);?>" name="submit-fire" class="btn btn-danger" >
                                                Fire!
                                            </button>
                                        </form>
                                    </td><td><?=htmlspecialchars($row2["id64"]);?></td><td><?=htmlspecialchars($row2["stamp"]);?></td></tr> 
                                            
                                            <?php
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
                <?php if($useralreadyexist == true){ ?>
                <script type="text/JavaScript">  
                toastr["error"]("<?=htmlspecialchars($blockid);?> is already in the databse!", "Error:")     
                </script>
                      <?php 
                      } 
                      if($alreadystaff == true){
                      ?>
                <script type="text/JavaScript">  
                toastr["error"]("This user is already in the databse!", "Error:")     
                </script>
                      <?php 
                      } 
                       if($blocksuccess == true){ 
                      ?>    
                <script type="text/JavaScript">  
                toastr["success"]("<?=htmlspecialchars($blockid);?> has be blocked! Reason: <?=htmlspecialchars($blockrsn);?> ", "Congradulations!")     
                </script>
                      <?php 
                      } 
                      if($unblocksuccess == true){
                      ?>
                <script type="text/JavaScript">  
                toastr["success"]("<?=htmlspecialchars($unblockid);?> has been unblocked!", "Congradulations!")     
                </script>
                      <?php 
                      } 
                      if($firesuccess == true){
                      ?>
                      <script type="text/JavaScript">  
                      toastr["success"]("<?=htmlspecialchars($fireid);?> has been fired!", "Congradulations!")     
                      </script>
                      <?php 
                      } 
                      if($hiresuccess == true){
                      ?>
                      <script type="text/JavaScript">  
                      toastr["success"]("<?=htmlspecialchars($hireid);?> has been hired!", "Congradulations!")     
                      </script>
                      <?php 
                      } 
                      if($notdsponge == true){
                        ?>
                        <script type="text/JavaScript">  
                        toastr["error"]("You cannot do this because you are not DriedSponge!", "Error:")     
                        </script>
                    <?php
                      }
                      ?>

 </body>

</html>