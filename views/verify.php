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
    include("views/includes/meta.php");
    ?>

    <title>Verify</title>
    <script src="https://kit.fontawesome.com/0add82e87e.js" crossorigin="anonymous"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" type="text/css">

</head>

<body>

    <?php

    $Done = false;
    $roles = false;
    $blocked = false;
    $PLogin = false;
    $InvalidCode = false;
    $ExpiredCode = false;
    if (isset($verify)) {
        $_SESSION["verify_code"] = $verify;
    }
    if (isset($_SESSION['steamid'])) {
        include('steamauth/userInfo.php');
        $checkifdone = SQLWrapper()->prepare("SELECT discordid,stamp,discorduser,givenrole FROM discord WHERE steamid = :id");
        $checkifdone->execute([':id' =>  $steamprofile['steamid']]);
        $checkdonerow = $checkifdone->fetch();
        if (!empty($checkdonerow)) {
            $DisplayForm = false;
            $Done = true;
            $InvalidCode = false;
            $ExpiredCode = false;
            $discordusername = $checkdonerow['discorduser'];
            $discordid = $checkdonerow['discordid'];
            $verifiedon = date("m/d/Y g:i a", $checkdonerow['stamp']);
            if (!$checkdonerow['givenrole']) {
                $roles = true;
            } else {
                $roles = false;
            }
        }


        if (!$Done) {
            $verifyid = $_SESSION["verify_code"];
            if (is_numeric($verifyid)) {
                $validateid = SQLWrapper()->prepare("SELECT discordid, UNIX_TIMESTAMP(codecreated) AS codecreated FROM discord WHERE verifyid = :vid ");
                $validateid->execute([':vid' => $verifyid]);
                $validaterow = $validateid->fetch();
                if (!empty($validaterow)) {
                    $time = time();
                    $codecreatedat = $validaterow["codecreated"];
                    if ($codecreatedat > time() - 300) {
                        $discordid = $validaterow['discordid'];
                        $steamid = $steamprofile['steamid'];
                        $updatevalid = SQLWrapper()->prepare("UPDATE discord SET steamid = :id64, stamp = :stamp, verifyid = :verified WHERE discordid = :vid");
                        $updatevalid->execute([':vid' =>  $discordid, ':id64' =>  $steamid, ':stamp' =>  $time, ':verified' =>  "VERIFIED"]);
                        header("Location: ?success");
                    } else {

                        $ExpiredCode = true; //IF the code is expiered
                    }
                } else {

                    $InvalidCode = true;
                }
            } else {

                $InvalidCode = true;
            }
        }
    } else {
        $PLogin = true;
    }
    ?>

    <div class="app">
        <div class="container-fluid-lg">
                <hgroup>
                    <h1 class="display-2"><strong>Verify</strong></h1>
                </hgroup>
                <br>
            <div class="container-fluid">
                <?php if ($blocked) { ?>
                    <div data-aos="zoom-in" class="content-box">
                        <h1 class="heading">Error!</h1>
                        <p class="paragraph text-center">Uh oh, looks like you have been blacklisted from doing anything on this site. <br> Reason: <?= htmlspecialchars($row["rsn"]); ?></p>
                    </div>
                <?php
                }
                if ($roles) {
                ?>
                <div class="content-box">
                    <h1>Getting your roles!</h1>
                    <h2>Your roles will be assgned within five minutes of verification, or enter the bot-cmds channel and type !verify again.</h2>
                </div>
                <br>
                <?php
                }
                ?>
                <?php if ($Done) { ?>
                    <div class="content-box">
                    <h1>Status</h1>
                    <h2>You have been verified as:<br><?= htmlspecialchars($discordusername) ?> (ID: <?= htmlspecialchars($discordid) ?>)<br>Verified on: <?= htmlspecialchars($verifiedon); ?></h2>
                    <br>
                    <p class="text-center">If this is not your discord account please let me or one of my moderators know immdiatley. If you need to change your account let me or one of my mods know so we can help you.</p>
                    </div>
                <?php
                }
                if ($InvalidCode) {
                ?>
                <div class="content-box">
                    <h1>Error!</h1>
                    <h2>Invalid URL</h2>
                </div>
                <br>
                <?php
                }
                if ($ExpiredCode) {
                ?>
                <div class="content-box">
                    <h1>Error!</h1>
                    <h2>Your verification URL has expired</h2>
                </div>
               <?php
                }
                ?>


                <?php


                if ($PLogin == true) {
                ?>
                    <div class="content-box" data-aos="zoom-in">
                        <h1 class="heading">Please Login To Verify Yourself or Check your verification status</h1>
                        <p class="text-center"><a href='?login'><img src='https://steamcommunity-a.akamaihd.net/public/images/signinthroughsteam/sits_02.png'></a></p>
                        <br>
                        <p class="paragraph text-center">This is so we are able to verify your steam account with your discord account.</p>
                    </div>
                <?php
                }
                ?>


            </div>
        </div>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/popper.js@1"></script>
    <script src="https://unpkg.com/tippy.js@4"></script>
    <script src="main.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        AOS.init();
    </script>



</body>






</html>