<?php
require('steamauth/steamauth.php'); 
include("databases/connect.php");
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
            include("meta.php"); 
            ?>
        
        <title>Manage</title>
        <script src="https://kit.fontawesome.com/0add82e87e.js" crossorigin="anonymous"></script>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    </head>
 <body>

<?php
include("navbar.php");

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
            if (isset($_SESSION['steamid'])){ 
            if ($_SESSION['steamid'] == "76561198357728256"){ 
                if(isset($_POST['submit-block'])){
                    $blockid = $_POST['id64'];
                    $blockrsn =$_POST['rsn'];
                    $blockstamp = date("r");
                    $sqlblockexist = "SELECT id64 FROM blocked WHERE id64='$blockid'";
                    $sqlblockexistquery = $conn->query($sqlblockexist);
                            if ($sqlblockexistquery->rowCount() == 1) {
                                $useralreadyexist = true;
                                
                            } else{
                                $sqlblock = "INSERT INTO blocked (id64, rsn, stamp)
                                VALUES ('$blockid', '$blockrsn','$blockstamp')";

                                if ($conn->query($sqlblock) === TRUE) {
                                    echo "New record created successfully";
                                } 
                            }
                }
                if(isset($_POST['submit-unblock'])){
                    $unblockid = $_POST['submit-unblock'];
                    
                    $sqlunblock= "DELETE FROM blocked WHERE id64='$unblockid'";
                    $conn->query($sqlunblock);   
                }

                ?>
                <hgroup>
                        <!-- <img src="https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/18/18be38c2f230fea0fa667c8165e4da5cb1a787c0_full.jpg" alt="DriedSponge's Profile Picture"> -->
                        <h1 class="display-2"><strong>Management</strong></h1>
                    
                    <br>
                </hgroup>
                <div class="card card-accordion">
                <div class="card-header manage-card-header">
                <h3>
                  <a data-toggle="collapse" class="dropdown-head-link" href="#userblacklist" role="button" aria-expanded="false" aria-controls="userblacklist">User blacklist</a> 
              </h3>
                </div>
                <div class="collapse" id="userblacklist">
                  
                    <div class="card-body">
                      <p class="subsubhead" style="color: black; text-align: left;">Add user</p>
                    <form action="manage.php" method="post">
                                             <div class="form-row">
                                               <div class="form-group col-md-6">
                                                  <label for="id64" style="color: black;">SteamID64</label>
                                                     <input id="id64" name="id64" type="text" class="form-control"  placeholder="Enter SteamID64"  required>
                                                    </div>
                                                     <br>
                                                     <div class="form-group col-md-6">
                                                        <label for="rsn" style="color: black;">Reason</label>
                                                       <input id="rsn" name="rsn" type="text" class="form-control" placeholder="Enter reason" required>
                                                      </div>
                                                     <br>
                                                     <div class="form-group col-md-6">
                                                    <button name="submit-block" type="submit" class="btn btn-primary">Submit</button>
                                                  </div>
                                                </div>
                                            </form>
                                            
                      <?php if($useralreadyexist == true){ ?>
                        <p class="paragraph" style="color:red;">Error: The user is already in the database!</p>
                        
                      <?php 
                      } 
                      ?>
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
                            <form action="manage.php" method="post" />
                             <button type="submit" value="<?php echo $row["id64"];?>" name="submit-unblock" class="btn btn-primary" >
                                Remove User
                            </button>
                        </form>
                    </td><td><?php echo $row["id64"];?></td><td><?php echo $row["rsn"];?></td><td><?php echo $row["stamp"];?></td></tr> 
                            
                            <?php
                        }
                      ?>
                      </tbody>
                        </table>
                      </div>
                      </div>
                    </div>
                        <br> 
                      
                        
                    

                <?php }else{ ?>
                    <hgroup>
                        <!-- <img src="https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/18/18be38c2f230fea0fa667c8165e4da5cb1a787c0_full.jpg" alt="DriedSponge's Profile Picture"> -->
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
            include("footer.php"); // we include footer.php here. you can use .html extension, too.
            ?>
                
                <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
                <script src="https://unpkg.com/popper.js@1"></script>
                <script src="https://unpkg.com/tippy.js@4"></script>
                <script src="main.js"></script>
              
 </body>






</html>