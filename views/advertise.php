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
    include("views/includes/meta.php");
    ?>

    <title>Advertise</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    <script src="https://kit.fontawesome.com/0add82e87e.js" crossorigin="anonymous"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body>
    <?php
    include("views/includes/navbar.php")
    ?>
    <?php

    $oneday = false;
    $notverified = false;
    $blocked = false;
    if (isset($steamprofile['steamid'])) {
        $PLogin = false;
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
            if (isVerified($_SESSION['steamid'])) {
                $aduser =  $steamprofile['steamid'];
                $adstamp = time();
                $adexist = SQLWrapper()->prepare("SELECT user,adname,overide,content,adcount,UNIX_TIMESTAMP(stamp) AS stamp  FROM ads WHERE user = :id");
                $adexist->execute([':id' => $aduser]);
                $adrow = $adexist->fetch();
                $adcount = $adrow['adcount'];
                $numDays = abs($adrow['stamp'] - $adstamp) / 60 / 60 / 24;
                $submitted = $adrow['stamp'];
                $timeleft = secondsToTime(86400 - abs($adrow['stamp'] - $adstamp));
                if ($numDays >= 1 or $adrow['overide'] == "1") {
                    $oneday = false;
                    if (!empty($adrow['content'])) {
                        $ReRun = true;
                        $LastRan = date("m/d/Y g:i a", $adrow["stamp"]);
                        $DefaultAdName =  $adrow["adname"];
                        $DefaultAdDesc =  $adrow["content"];
                    }
                } else {
                    $DisplayForm = false;
                    $oneday = true;
                }
            } else {
                $notverified = true;
                $DisplayForm = false;
            }
        } //end block check






    } else { //Plese login
        $DisplayForm = false;
        $PLogin = true;
    }
    ?>

    <div class="app">
        <div class="container-fluid-lg">

            <hgroup>
                <!-- <img src="https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/18/18be38c2f230fea0fa667c8165e4da5cb1a787c0_full.jpg" alt="DriedSponge's Profile Picture"> -->
                <h1 class="display-2"><strong>Advertise</strong></h1>
                <br>
            </hgroup>
            <?php if ($blocked) { ?>
                <div class="container-fluid">
                    <div data-aos="zoom-in" class="content-box">
                        <h1 class="heading">Error!</h1>
                        <p class="paragraph text-center">Uh oh, looks like you have been blacklisted from submitting form data. <br> Reason: <?= htmlspecialchars($row["rsn"]); ?></p>
                    </div>
                </div>
            <?php
            }
            if ($oneday) { ?>
                <div class="container-fluid">
                    <div class="content-box">
                        <h1>Please wait before advertising again</h1>
                        <br>
                        <div id="time-left">
                            <h2 style="text-align: center;">Time left: <strong id="timeleft"><?= htmlspecialchars($timeleft) ?></strong></h2>
                        </div>
                        <br>
                        <p class="text-center">If you believe there was an error in processing your ad, please contact me in my discord and I will remove your countdown if the situation warrants it.</p>
                    </div>
                </div>
                <script>
                    function SetTimeLeft() {
                        var currenttime = Math.round((new Date()).getTime() / 1000);
                        var sseconds = 86400 - Math.abs(<?= htmlspecialchars($submitted); ?> - currenttime);
                        var seconds = parseInt(sseconds, 10);
                        if (seconds === "0") {
                            location.reload()
                        }
                        var days = Math.floor(seconds / (3600 * 24));
                        seconds -= days * 3600 * 24;
                        var hrs = Math.floor(seconds / 3600);
                        seconds -= hrs * 3600;
                        var mnts = Math.floor(seconds / 60);
                        seconds -= mnts * 60;
                        console.log();
                        document.getElementById("timeleft").innerHTML = days + " days, " + hrs + " hours, " + mnts + " minutes and " + seconds + " seconds";
                    }
                    setInterval(function() {
                        SetTimeLeft();
                    }, 1000) /* time in milliseconds (ie 2 seconds)*/
                </script>
            <?php
            }
            if ($notverified) {
            ?>
                <div class="container-fluid">
                    <div class="content-box">
                        <h1 class="articleh1">Error!</h1>
                        <h2>Not Verified</h2>
                        <p class="text-center">It appears that you are not verified in my discord server, therefore we cannot be sure you are actually in the discord server. If you are not in it, you can click <a href="https://discordapp.com/invite/YS4WZWG" target="_blank">here</a> to join. If you are in the discord, head into the bot commands channel and do <strong>!verify</strong> to get started.</p>
                    </div>
                </div>
            <?php
            }
            if ($DisplayForm) {

            ?>
                <div class="container-fluid">
                    <div class="content-box">
                        <h1>About</h1>
                        <p class="text-center">Send an advertisement of anything to my discord server advertisement channel. If you abuse this system, your account may be blocked from future advertising. You can advertise every 24hrs.</p>
                    </div>
                    <div class="text-center" id="feedback-response">
                        <div id="error-message" class="d-none">
                            <div class="alert alert-danger" role="alert">
                                <span><b>Error:</b> <span id="error_message_text"><i>insert success message here</i></span></span>
                            </div>
                        </div>
                        <div id="success-message" class="d-none">
                            <div class="alert alert-success" role="alert">
                                <span><b>Success:</b> <span id="success_message_text"><i>insert success message here</i></span></span>
                            </div>
                        </div>
                        <div id="loading"></div>
                    </div>
                    <br>
                    <?php
                    if ($ReRun) {
                    ?>
                        <script>
                            $(document).ready(function() {
                                $("#repeat-last-ad").submit(function(event) {
                                    event.preventDefault();
                                    Loading(true, '#loading');
                                    $("#error-message").addClass("d-none");
                                    $("#success-message").addClass("d-none");
                                    $("#repeat-last-ad-box").hide();
                                    $("#submit-new-ad-box").hide();
                                    $("#about-p").hide()
                                    $.post("/pages/ajax/ad-submit.php", {
                                            lastad: 1
                                        })
                                        .done(function(data) {
                                            Loading(false, '#loading');
                                            if (data.success) {
                                                $("#success-message").removeClass("d-none");
                                                $("#success_message_text").html(data.message);
                                                setInterval(function() {
                                                    location.reload();
                                                }, 5000)
                                            } else {
                                                $("#error-message").removeClass("d-none");
                                                $("#error_message_text").html(data.message);
                                                $("#submit-new-ad-box").show();
                                                $("#about-p").show()
                                                $("#repeat-last-ad-box").show();
                                            }
                                        });
                                });
                            });
                        </script>
                        <div class="content-box" id="repeat-last-ad-box">
                            <h1>Repeat Last Ad</h1>
                            <div class="container">
                                <div class="row display-flex">
                                    <div class="col indexcol">
                                        <div class="card card-border">
                                            <div class="card-body">
                                                <h1 class="heading"><?=htmlspecialchars($DefaultAdName);?></h1>
                                                <p class="paragraph" style="text-align: center;"><?=htmlspecialchars($DefaultAdDesc);?></p>
                                                <br>
                                                <p class="paragraph">Sent On: <?=htmlspecialchars($LastRan);?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <form id="repeat-last-ad" class="text-center">
                                <button type="submit" name="last-ad" class="btn btn-success">
                                    Confirm
                                </button>
                            </form>
                        </div>
                        <br>
                    <?php } ?>
                    <script>
                        $(document).ready(function() {
                            $("#submit-new-ad").submit(function(event) {
                                event.preventDefault();
                                var adname = $("#adname").val();
                                var adcontent = $("#newadcontent").val();
                                Loading(true, '#loading');
                                $("#error-message").addClass("d-none");
                                $("#success-message").addClass("d-none");
                                $("#submit-new-ad-box").hide();
                                $("#about-p").hide()
                                $("#repeat-last-ad-box").hide();
                                $.post("/pages/ajax/ad-submit.php", {
                                        adname: adname,
                                        adcontent: adcontent,
                                        submit: 1
                                    })
                                    .done(function(data) {
                                        Loading(false, '#loading');
                                        if (data.success) {
                                            $("#success-message").removeClass("d-none");
                                            $("#success_message_text").html(data.message);
                                            setInterval(function() {
                                                location.reload();
                                            }, 5000)
                                        } else {
                                            if (!data.basics) {
                                                $("#error-message").removeClass("d-none");
                                                $("#error_message_text").html(data.message);
                                            }
                                            if (data.basics) {
                                                if (data.errorNAME && data.errorNAMETXT != null) {
                                                    InValidate("#adname", "#ad-name-feedback", data.errorNAMETXT)
                                                } else {
                                                    Validate("#adname", "#ad-name-feedback")
                                                }
                                                if (data.errorCON && data.errorCONTXT != null) {
                                                    InValidate("#newadcontent", "#ad-con-feedback", data.errorCONTXT)
                                                } else {
                                                    Validate("#newadcontent", "#ad-con-feedback")
                                                }
                                            }
                                            $("#submit-new-ad-box").show();
                                            $("#about-p").show()
                                            $("#repeat-last-ad-box").show();
                                        }
                                    });
                            });
                        })
                    </script>
                    <div id="submit-ad-response"></div>
                    <div class="content-box" id="submit-new-ad-box">
                        <h1>Create A New Ad</h1>
                        <form id="submit-new-ad">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input id="name" name="name" type="text" class="form-control form-control-alternative" value="<?= htmlspecialchars($steamprofile['personaname']); ?>" placeholder="<?= htmlspecialchars($steamprofile['personaname']); ?>" readonly>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="adname">Name of your ad</label>
                                <input id="adname" name="adname" type="text" maxlength="25" class="form-control form-control-alternative" placeholder="My cool server!">
                                <div id="ad-name-feedback"></div>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="newadcontent">Tell users about what your advertising. Think of it as just typing a normal message into discord. URLs are allowed (<a href="https://support.discordapp.com/hc/en-us/articles/210298617-Markdown-Text-101-Chat-Formatting-Bold-Italic-Underline-" target="_blank">Discord Markdown</a> is supported)</label>
                                <textarea id="newadcontent" class="form-control form-control-alternative" name="newadcontent" maxlength="1500" rows="8" placeholder="nvm we actually suck"></textarea>
                                <div id="ad-con-feedback"></div>
                            </div>
                            <br>
                            <button name="submit" type="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>
            <?php
            }

            if ($PLogin == true) {
            ?>
                <div class="container-fluid">
                    <div class="content-box" data-aos="zoom-in">
                        <h1 class="heading">Please login to advertise in my discord</h1>
                        <p class="text-center"><a href='?login'><img src='https://steamcommunity-a.akamaihd.net/public/images/signinthroughsteam/sits_02.png'></a></p>
                        <br>
                        <p class="paragraph text-center">This is required so we can uniquely identify which ad is yours and so we can prevent spam.</p>
                    </div>
                </div>
            <?php
            }
            ?>



        </div>

    </div>
    <!-- end of app -->
    <?php
    include("views/includes/footer.php"); // we include footer.php here. you can use .html extension, too.
    ?>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/popper.js@1"></script>
    <script src="https://unpkg.com/tippy.js@4"></script>
    <script src="main.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        AOS.init();
    </script>

    <script>
        navitem = document.getElementById('ad').classList.add('active')
    </script>
</body>






</html>