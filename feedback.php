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

    <title>Feedback</title>
    <script src="https://kit.fontawesome.com/0add82e87e.js" crossorigin="anonymous"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href = "//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" type="text/css" >

</head>

<body>
    <?php
    include("navbar.php")
    ?>
    <?php


    if (isset($_SESSION['steamid'])) {
        $PLogin = false;
        $Done = false;


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





        if (isset($_POST['submit'])) {
            
            $DisplayForm = false;
            $captcha = $_POST['g-recaptcha-response'];
            $json = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Ld9SaQUAAAAACIaPxcErESw-6RvtljAMd3IYsQL&response=$captcha");
            $captchares = json_decode($json);
            $success = $captchares->success;
            if ($success == true) {

                if (!isset($_POST['name'], $_POST['say'])) {
                    return;
                }
                $request = json_encode([
                    "content" => "",
                    "embeds" => [
                        [
                            "author" => [
                                "name" => $steamprofile['personaname'] . " (" . $steamprofile['steamid'] . ")",
                                "url" => $steamprofile['profileurl'],
                                "icon_url" => $steamprofile['avatarmedium']
                            ],
                            "title" => "DriedSponge.net - Feedback",
                            "type" => "rich",
                            "description" =>  $_POST['say'],
                            "timestamp" => date("c"),
                        ]
                    ]
                ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

                $ch = curl_init("https://discordapp.com/api/webhooks/650866821095882762/Y-Sf_yCTGDKSh_hm8nSkvAphQQyl8KtPxISx6NSQ1t3daUVhobXKX1EW-E-wqseC7ndf");

                curl_setopt_array($ch, [
                    CURLOPT_POST => 1,
                    CURLOPT_FOLLOWLOCATION => 1,
                    CURLOPT_HTTPHEADER => array("Content-type: application/json"),
                    CURLOPT_POSTFIELDS => $request,
                    CURLOPT_RETURNTRANSFER => 1
                ]);


                curl_exec($ch);
                header("Location: feedback.php?submit-success");
                
            } else {
                $DisplayForm = true;
                header("Location: feedback.php?failed-captcha");
                
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
                    <h1 class="display-2"><strong>Feedback</strong></h1>

                    <br>
                </hgroup>
                <?php if ($blocked == true) { ?>
                    <h1 class="articleh1">Uh oh, looks like you have been blacklisted from submitting form data. <br> Reason: <?php echo $row["rsn"]; ?></h1>
                <?php
                }
                    ?>
                


                <?php
                if ($DisplayForm) {
                    ?>

                    <p class="paragraph pintro">Tell me what you think about the site and what could be changed. Both positive and negative feedback are accepted!</p>
                    <br>
                    <form action="feedback.php" method="post">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input id="name" name="name" type="text" class="form-control" value="<?= htmlspecialchars($steamprofile['personaname']); ?>" placeholder="<?= htmlspecialchars($steamprofile['personaname']); ?>" readonly>
                            <br>
                            <label for="say">What are your thoughts on the site?</label>
                            <textarea id="say" class="form-control" name="say" rows="3" placeholder="Type here I guess..." required></textarea>
                            <br>
                            <div class="g-recaptcha" data-sitekey="6Ld9SaQUAAAAAG81x31GrfZeiJEd1gtd59CRMbC7" required></div>
                            <br>
                            <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                <?php
                }
                              
                if ($PLogin == true) {
                    ?>
                    <h1 class="articleh1">Please login to submit feedback</h1>
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
    if(isset($_GET['submit-success'])){
                        ?>
                        <script type="text/JavaScript">  
                      toastr["success"]("Thank you! Your feedback has been submitted!", "Congratulations!")     
                      </script>
                        <?php
                        }
                        if (isset($_GET['failed-captcha'])) {
                        ?>
                        <script type="text/JavaScript">  
                        toastr["error"]("Uh oh! Looks like you failed the captcha! Try again but this time try acting less like a robot.", "Error!")     
                        </script>
                        <?php
                        }
                        ?>

</body>






</html>