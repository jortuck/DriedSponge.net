<?php
require('steamauth/steamauth.php');
include("databases/connect.php");
?>
<!DOCTYPE html>


<html>

<head>
    <!--         Site created: 9/19/19
        Author: DriedSponge(Jordan Tucker) -->

    <meta name="description" content="Advertise in my discord server">
    <meta name="keywords" content="Advertise, driedsponge.net Advertise">
    <meta name="author" content="Jordan Tucker">
    <meta property="og:site_name" content="DriedSponge.net | Advertise" />

    <?php
    include("meta.php");
    ?>

    <title>Advertise</title>
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
        $oneday = false;
        $blocked = false;
        $ReRun = false;
        $DisplayForm = true;
        $row = null;
        $chekid = $_SESSION['steamid'];

        $sqlblockexistquery = SQLWrapper()->prepare("SELECT id64, rsn, stamp FROM blocked WHERE id64 = :id");
        $sqlblockexistquery->execute([':id' => $chekid]);

        $row = $sqlblockexistquery->fetch();
        if (!empty($row)) {
            $DisplayForm = false;
            $blocked = true;
        } else {
    
        $aduser =  $steamprofile['steamid'];
                             
        $adstamp = time();
        $adexist = SQLWrapper()->prepare("SELECT user,adname,overide,content,UNIX_TIMESTAMP(stamp) AS stamp  FROM ads WHERE user = :id");
        $adexist->execute([':id' => $aduser]);
        $adrow = $adexist->fetch();
        $numDays = abs($adrow['stamp'] - $adstamp)/60/60/24;
        $timeleft = secondsToTime(86400 - abs($adrow['stamp'] - $adstamp));
        if($numDays >= 1 or $adrow['overide']){
        $oneday = false;
            if(!empty($adrow['content'])){
                $ReRun = true;
                $LastRan = date("m/d/Y g:i a", $adrow["stamp"]);
                $DefaultAdName =  $adrow["adname"];
                $DefaultAdDesc =  $adrow["content"];
            }else{
                $DefaultAdName = "Server Name/Product Name/Community Name/etc";
                $DefaultAdDesc = "Type details here...";
            }
            if(isset($_POST['last-ad'])){
                SQLWrapper()->prepare("UPDATE ads SET overide = :overide WHERE user = :curuser")->execute([':curuser' => $aduser,':overide' => 0]);    
                                                    
                $request = json_encode([
                    "content" => "",
                    "embeds" => [
                        [
                            "author" => [
                                "name" => "Ad sent from ".$steamprofile['personaname'] . " (" . $steamprofile['steamid'] . ")",
                                "url" => $steamprofile['profileurl'],
                                "icon_url" => $steamprofile['avatarmedium']
                            ],
                            "title" => str_replace("@"," ",$adrow['adname']),
                            "type" => "rich",
                            "description" =>  str_replace("@"," ",$adrow['content']),
                            "timestamp" => date("c"),
                        ]
                    ]
                ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

                $ch = curl_init("https://discordapp.com/api/webhooks/655554251702927390/-dICp0ReXpC63SW3DNpJqc1zE5hzhJD_HmyBrt5f0Xoh8y-YiErccuXLiRWQj5jrCG3U");

                curl_setopt_array($ch, [
                    CURLOPT_POST => 1,
                    CURLOPT_FOLLOWLOCATION => 1,
                    CURLOPT_HTTPHEADER => array("Content-type: application/json"),
                    CURLOPT_POSTFIELDS => $request,
                    CURLOPT_RETURNTRANSFER => 1
                ]);


                curl_exec($ch);
                header("Location: advertise.php?submit-success");
            }
            if (isset($_POST['submit'])) {
                $adname = $_POST['adname'];
                $adcontent = $_POST['say'];  
                $DisplayForm = true;
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
                                    "name" => "Ad sent from ".$steamprofile['personaname'] . " (" . $steamprofile['steamid'] . ")",
                                    "url" => $steamprofile['profileurl'],
                                    "icon_url" => $steamprofile['avatarmedium']
                                ],
                                "title" => str_replace("@"," ",$_POST['adname']),
                                "type" => "rich",
                                "description" =>  str_replace("@"," ",$_POST['say']),
                                "timestamp" => date("c"),
                            ]
                        ]
                    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    
                    $ch = curl_init("https://discordapp.com/api/webhooks/655554251702927390/-dICp0ReXpC63SW3DNpJqc1zE5hzhJD_HmyBrt5f0Xoh8y-YiErccuXLiRWQj5jrCG3U");
    
                    curl_setopt_array($ch, [
                        CURLOPT_POST => 1,
                        CURLOPT_FOLLOWLOCATION => 1,
                        CURLOPT_HTTPHEADER => array("Content-type: application/json"),
                        CURLOPT_POSTFIELDS => $request,
                        CURLOPT_RETURNTRANSFER => 1
                    ]);
    
    
                    curl_exec($ch);                   
                        
                        
                        
                            if (!empty($adrow)) {                          
                                SQLWrapper()->prepare("UPDATE ads SET user= :id, adname = :adname, content = :content, overide = :overide WHERE user = :curuser")->execute([':id' => $aduser, ':adname' => $adname,':content' => $adcontent,':curuser' => $aduser, ':overide' => 0]);                          
                                header("Location: advertise.php?submit-success");
                            } else {
                                SQLWrapper()->prepare("INSERT INTO ads (user, adname, content)
                                VALUES (?,?,?)")->execute([$aduser,  $adname, $adcontent]);
                                header("Location: advertise.php?submit-success");                      
                            }
                       
                } else {
                    $DisplayForm = true;
                    header("Location: advertise.php?failed-captcha");
                    
                }
            }
        }else{
            $DisplayForm = false;
            $oneday = true;
        }

        } //end block check






    } else { //Plese login
        $DisplayForm = false;
        $PLogin = true;
        
        
    }
    ?>

    <div class="app">
        <div class="container-fluid-lg" style="padding-top: 80px;">

            <div class="container">
                <hgroup>
                    <!-- <img src="https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/18/18be38c2f230fea0fa667c8165e4da5cb1a787c0_full.jpg" alt="DriedSponge's Profile Picture"> -->
                    <h1 class="display-2"><strong>Advertise</strong></h1>

                    <br>
                </hgroup>
                <?php if ($blocked == true) { ?>
                    <h1 class="articleh1">Uh oh, looks like you have been blacklisted from submitting form data. <br> Reason: <?php echo $row["rsn"]; ?></h1>
                <?php
                }
                    if ($oneday == true) { ?>
                    <h1 class="articleh1">Please wait before advertising again</h1>
                    <br>
                    <h2 style="text-align: center;">Time left: <strong><?=htmlspecialchars($timeleft)?></strong></h2>
                    <br>
                    <h2 style="text-align: center;">If you believe there was an error in porcessing your ad, please contact me in my discord and I will remove your countdown if the situation warrants it.</h2>
                <?php
                }
                    
                if ($DisplayForm) {
                    
                    ?>

                    <p class="paragraph pintro">Send an advertisement of anything to my discord server advertisement channel. If you abuse this system, your account may be blocked from future advertising. You can advertise every 24hrs.</p>
                    <br>
                    <?php
                    if($ReRun){
                        ?>
                        <div class="text-center">
                        <form action="advertise.php" method="post">
                            <button type="submit" id="repeat-last-ad" data-tippy-content="Resend the same ad you sent on: <?=htmlspecialchars($LastRan);?>" name="last-ad" class="btn btn-primary paragraph" >
                                    Repeat Last Ad
                            </button>
                        </form>
                        </div>
                        <br>
                        <?php } ?>
                    <form action="advertise.php" method="post">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input id="name" name="name" type="text" class="form-control" value="<?= htmlspecialchars($steamprofile['personaname']); ?>" placeholder="<?= htmlspecialchars($steamprofile['personaname']); ?>" readonly>
                            <br>
                            <label for="adname">Name of your ad</label>
                            <input id="adname" name="adname" type="text" maxlength="25" class="form-control"  placeholder="<?=htmlspecialchars($DefaultAdName);?>" required>
                            <br>           
                            <label for="say">Tell users about what your advertising. Think of it as just typing a normal message into discord. URLs are allowed (<a href="https://support.discordapp.com/hc/en-us/articles/210298617-Markdown-Text-101-Chat-Formatting-Bold-Italic-Underline-" target="_blank">Discord Markdown</a> is supported)</label>
                            <textarea id="say" class="form-control" name="say" maxlength="1500" rows="10" placeholder="<?=htmlspecialchars($DefaultAdDesc);?>" required></textarea>
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
                    <h1 class="articleh1">Please login to advertise in my discord</h1>
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
                      toastr["success"]("Your ad has been posted in my discord sever.", "Congratulations!")     
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