<?php
require('steamauth/steamauth.php');
include("databases/connect.php");
?>
<!DOCTYPE html>


<html>

<head>
    <!--         Site created: 9/19/19
        Author: DriedSponge(Jordan Tucker) -->

    <meta name="description" content="verify your discord account">
    <meta name="keywords" content="verify, driedsponge.net verify">
    <meta name="author" content="Jordan Tucker">
    <meta property="og:site_name" content="DriedSponge.net | Verify" />

    <?php
    include("meta.php");
    ?>

    <title>Verify</title>
    <script src="https://kit.fontawesome.com/0add82e87e.js" crossorigin="anonymous"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href = "//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" type="text/css" >

</head>

<body>
    <?php
    include("navbar.php")
    ?>
    <?php

        $Done = false;
        $roles = false;
        $blocked = false;
    if (isset($_SESSION['steamid'])) {
        $PLogin = false;
        $Done = false;
        $blocked = false;
        $checkifdone = SQLWrapper()->prepare("SELECT discordid,stamp,discorduser,givenrole FROM discord WHERE steamid = :id");
        $checkifdone->execute([':id' =>  $steamprofile['steamid']]);
        $checkdonerow = $checkifdone->fetch();
        if (!empty($checkdonerow)) {
            $DisplayForm = false;
            $Done = true;
            $discordusername = $checkdonerow['discorduser'];
            $discordid = $checkdonerow['discordid'];
            $verifiedon = date("m/d/Y g:i a", $checkdonerow['stamp']);
            if($checkdonerow['givenrole']=="NO"){
                $roles = true;
            }else{
                $roles = false;
            }

        } else {
        $DisplayForm = true;
        $FailedCaptch = false;
        $blocked = false;
        $row = null;
        $chekid = $_SESSION['steamid'];

        $sqlblockexistquery = SQLWrapper()->prepare("SELECT id64, rsn, stamp FROM blocked WHERE id64 = :id");
        $sqlblockexistquery->execute([':id' => $chekid]);

        $row = $sqlblockexistquery->fetch();
        if (!empty($row)) {
            $DisplayForm = false;
            $blocked = true;
        } else {
            $DisplayForm = true;
        }





        if (isset($_POST['verify-submit'])) {
            $verifyid = $_POST['verifycode'];
         
                if(is_numeric($verifyid)){
                    $validateid = SQLWrapper()->prepare("SELECT discordid, UNIX_TIMESTAMP(codecreated) AS codecreated FROM discord WHERE verifyid = :vid ");
                    $validateid->execute([':vid' => $verifyid]);
                    $validaterow = $validateid->fetch();
                    if (!empty($validaterow)) {
                        $discordid = $validaterow['discordid'];
                        $steamid = $steamprofile['steamid'];
                        $time = time();
                        $codecreatedat = $validaterow["codecreated"];
                        if($codecreatedat > time() -300){
                        $updatevalid = SQLWrapper()->prepare("UPDATE discord SET steamid = :id64, stamp = :stamp, verifyid = :verified WHERE discordid = :vid");
                        $updatevalid->execute([':vid' =>  $discordid,':id64' =>  $steamid,':stamp' =>  $time,':verified' =>  "VERIFIED"]);
     
                        header("Location: ?success");
                    }else{
                        header("Location: ?code-expired"); //IF the code is expiered
                    }
                    } else {
                        header("Location: ?invalid-id"); //If the id is not in DB
                    }
                }else{
                    header("Location: ?invalid-id"); //If the ID is not a number
                }
            
        }
    }
    } else {
        $DisplayForm = false;
        $PLogin = true;
        
        
    }
    ?>

    <div class="app">
        <div class="container-fluid-lg" style="padding-top: 80px;">

            <div class="container">
                <hgroup>
                    <!-- <img src="https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/18/18be38c2f230fea0fa667c8165e4da5cb1a787c0_full.jpg" alt="DriedSponge's Profile Picture"> -->
                    <h1 class="display-2"><strong>Verify</strong></h1>

                    <br>
                </hgroup>
                <?php if ($blocked){ ?>
                    <h1 class="articleh1">Uh oh, looks like you have been blacklisted from submitting form data. <br> Reason: <?php echo $row["rsn"]; ?></h1>
                <?php
                }if ($roles){
                    ?>
                      <h1 class="display-3" style="text-align: center;">Your roles will be assgned within five minutes of verification</h1>
                    <?php
                }
                    ?>
                <?php if ($Done){ ?>
                    <h1 class="articleh1" style="color:green;">You have been verified as:<br><?=htmlspecialchars($discordusername)?>(ID: <?=htmlspecialchars($discordid)?>)<br>Verified on: <?=htmlspecialchars($verifiedon);?></h1>
                    <br>
                    <h2 style="text-align: center;">If this IS NOT your discord account please let me or one of my moderators know immdiatley. If you need to change your account let me or one of my mods know so we can help you.</h2>
                <?php
                }
                
                    ?>

                <?php
                if ($DisplayForm) {
                    ?>
                    <br>
                    <form action="verify.php" method="post">
                        <div class="form-group">
                            <label for="id64">SteamID64</label>
                            <input id="id64" name="id64" type="text" class="form-control" value="<?= htmlspecialchars($steamprofile['steamid']); ?>" placeholder="<?= htmlspecialchars($steamprofile['personaname']); ?>" readonly>
                            <br>
                            <label for="verifycode">Enter the code the bot sent you.</label>
                            <input id="verifycode" class="form-control" name="verifycode" type="number" placeholder="Type here I guess..." required></input>
                            
                            <button name="verify-submit" type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                <?php
                }
                              
                if ($PLogin == true) {
                    ?>
                    <h1 class="articleh1">Please login to verify yourself</h1>
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/popper.js@1"></script>
    <script src="https://unpkg.com/tippy.js@4"></script>
    <script src="main.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
   
                        <?php
                        
                        if (isset($_GET['failed-captcha'])) {
                        ?>
                        <script type="text/JavaScript">  
                        toastr["error"]("Uh oh! Looks like you failed the captcha! Try again but this time try acting less like a robot.", "Error!")     
                        </script>
                        <?php
                        }
                        if (isset($_GET['invalid-id'])) {
                        ?>
                            <script type="text/JavaScript">  
                             toastr["error"]("The Code you entered was invalid", "Error!")     
                             </script>
                        <?php
                        }
                        if (isset($_GET['success']) && isset($discordusername)) {
                        ?>
                        <script type="text/JavaScript">  
                            toastr["success"]("You have been verified as <?=htmlspecialchars($discordusername)?>!", "Congratulations!")     
                        </script>
                        <?php
                        }
                        if(isset($_GET['code-expired'])){ 
                        ?>
                        <script type="text/JavaScript">  
                             toastr["error"]("The Code you entered is expired!", "Error!")     
                             </script>
                        <?php
                        }
                        ?>

</body>






</html>