<?php
require('steamauth/steamauth.php'); 
include("databases/connect.php");
?>
<!DOCTYPE html>


<html>
    <head>
<!--         Site created: 9/19/19
        Author: DriedSponge(Jordan Tucker) -->

        <meta name="description" content="Sumbit feedback about my site">
        <meta name="keywords" content="feedback, driedsponge.net feedback">
        <meta name="author" content="Jordan Tucker">
        <meta property="og:site_name" content="DriedSponge.net | Feedback" />
       
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
                <p class="paragraph"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deleteform">
                        Add user to blacklist
                      </button></p>
                      <?php if($useralreadyexist == true){ ?>
                        <p class="paragraph">Error: The user is already in the database!</p>
                        
                      <?php 
                      } 
                      ?>
                        <table class="table paragraph pintro">
                        <thead>
                        <tr>
                        <th scope="col">Buttons!</th>
                            <th scope="col">ID64</th>
                            <th scope="col">Reason</th>
                            <th scope="col">Timestamp</th>
                        </tr>
                        </thead>
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
                    </td><td><?php echo $row["id64"];?></td><td><?php echo $row["rsn"];?></td><td><?php echo $row["stamp"];?></td></tr>"; 
                            
                            <?php
                        }
                      ?>
                        </table>
                        <br> 
                        <div class="modal" tabindex="-1" id="deleteform" role="dialog">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" style="color: black;">Add user to form blacklist</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                            <form action="manage.php" method="post">
                                             <div class="form-group">
                                                  <label for="id64" style="color: black;">SteamID64</label>
                                                     <input id="id64" name="id64" type="text" class="form-control"  placeholder="Enter SteamID64"  required>
                                                     <br>
                                                        <label for="rsn" style="color: black;">Reason</label>
                                                       <input id="rsn" name="rsn" type="text" class="form-control" placeholder="Enter reason" required>
                                                     <br>
                                                    <button name="submit-block" type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    </div>
                                  </div>
                                </div>
                              </div>                  
                        
                    

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