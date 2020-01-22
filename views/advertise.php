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
    <link rel="stylesheet" href = "//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" type="text/css" >
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
            if(isVerified($_SESSION['steamid'])){
        $aduser =  $steamprofile['steamid'];                   
        $adstamp = time();
        $adexist = SQLWrapper()->prepare("SELECT user,adname,overide,content,adcount,UNIX_TIMESTAMP(stamp) AS stamp  FROM ads WHERE user = :id");
        $adexist->execute([':id' => $aduser]);
        $adrow = $adexist->fetch();
        $adcount = $adrow['adcount'];
        $numDays = abs($adrow['stamp'] - $adstamp)/60/60/24;
        $submitted = $adrow['stamp'];
        $timeleft = secondsToTime(86400 - abs($adrow['stamp'] - $adstamp));
        if($numDays >= 1 or $adrow['overide'] == "1"){
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
            
            
        }else{
            $DisplayForm = false;
            $oneday = true;
        }

    }else{
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
        <div class="container-fluid-lg" style="padding-top: 80px;">

            <div class="container">
                <hgroup>
                    <!-- <img src="https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/18/18be38c2f230fea0fa667c8165e4da5cb1a787c0_full.jpg" alt="DriedSponge's Profile Picture"> -->
                    <h1 class="display-2"><strong>Advertise</strong></h1>
                    <br>
                    
                </hgroup>
                <?php if ($blocked) { ?>
                    <h1 class="articleh1">Uh oh, looks like you have been blacklisted from submitting form data. <br> Reason: <?php echo $row["rsn"]; ?></h1>
                <?php
                }
                    if ($oneday) { ?>
                    <h1 class="articleh1">Please wait before advertising again</h1>
                    <br>
                    <div id="time-left">
                    <h2 style="text-align: center;">Time left: <strong id="timeleft"><?=htmlspecialchars($timeleft)?></strong></h2>
                    </div>
                    <br>
                    <h2 style="text-align: center;">If you believe there was an error in processing your ad, please contact me in my discord and I will remove your countdown if the situation warrants it.</h2>
                    <script>
                    function SetTimeLeft(){ //86400 - abs($adrow['stamp'] - $adstamp)
                        var currenttime = Math.round((new Date()).getTime() / 1000);
                        var sseconds =  86400 - Math.abs(<?=htmlspecialchars($submitted);?> - currenttime);
                        var seconds = parseInt(sseconds, 10);
                        if(seconds === "0"){
                            location.reload()
                        }
                        var days = Math.floor(seconds / (3600*24));
                        seconds  -= days*3600*24;
                        var hrs   = Math.floor(seconds / 3600);
                         seconds  -= hrs*3600;
                        var mnts = Math.floor(seconds / 60);
                        seconds  -= mnts*60;
                        console.log();
                        document.getElementById("timeleft").innerHTML = days+" days, "+hrs+" hours, "+mnts+" minutes and "+seconds+" seconds";
                    }
                    setInterval(function(){
                        SetTimeLeft();
                    }, 1000) /* time in milliseconds (ie 2 seconds)*/
                    </script>
                <?php
                }
                if($notverified){
                    ?>
                    <h1 class="articleh1">Not Verified</h1>
                    <h2 style="text-align: center;">It appears that you are not verified in my discord server, therefore we cannot be sure you are actually in the discord server. If you are not in it, you can click <a href="https://discordapp.com/invite/YS4WZWG" target="_blank">here</a> to join. If you are in the discord, head into the bot commands channel and do <strong>!verify</strong> to get started.</h2>
                   <?php 
                }
                if ($DisplayForm) {
                    
                    ?>

                    <p id="about-p" class="paragraph pintro">Send an advertisement of anything to my discord server advertisement channel. If you abuse this system, your account may be blocked from future advertising. You can advertise every 24hrs.</p>
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
                        <div id="wait-message" class="d-none">
                            <div class="alert alert-secondary" role="alert">
                                <span> please wait while im loading... </span>
                            </div>
                        </div>
                    </div>
                    <br>
                    <?php
                    if($ReRun){
                        ?>
                        <script>
                        $(document).ready(function() {
                            $("#repeat-last-ad").submit(function(event) {
                                event.preventDefault();
                                $("#wait-message").removeClass("d-none");
                                $("#error-message").addClass("d-none");
                                $("#success-message").addClass("d-none");
                                $("#repeat-last-ad").hide();
                                $("#submit-new-ad").hide();
                                $("#about-p").hide()
                                $.post("/pages/ajax/ad-submit.php", {
                                        lastad: 1
                                    })
                                    .done(function(data) {
                                        $("#wait-message").addClass("d-none");
                                        if (data.success) {
                                            $("#success-message").removeClass("d-none");
                                                $("#success_message_text").html(data.message);
                                                setInterval(function(){
                                                    location.reload();
                                                }, 5000) 
                                        } else {
                                            $("#error-message").removeClass("d-none");
                                            $("#error_message_text").html(data.message);
                                            $("#submit-new-ad").show();
                                            $("#about-p").show()
                                            $("#repeat-last-ad").show();
                                        }
                                    });
                            });
                        });
                        </script>
                        <div class="text-center">
                        <form id="repeat-last-ad" action="/pages/ajax/ad-submit.php" method="post">
                            <button type="submit"  name="last-ad" class="btn btn-primary paragraph" >
                                    Repeat Last Ad
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
                                    $("#wait-message").removeClass("d-none");
                                    $("#error-message").addClass("d-none");
                                    $("#success-message").addClass("d-none");
                                    $("#submit-new-ad").hide();
                                    $("#about-p").hide()
                                    $("#repeat-last-ad").hide();
                                    $.post("/pages/ajax/ad-submit.php", {
                                            adname: adname,
                                            adcontent: adcontent,
                                            submit: 1
                                        })
                                        .done(function(data) {
                                            $("#wait-message").addClass("d-none");
                                            if (data.success) {
                                                $("#success-message").removeClass("d-none");
                                                $("#success_message_text").html(data.message);
                                                setInterval(function(){
                                                    location.reload();
                                                }, 5000) 
                                            } else {
                                                if(!data.basics){
                                                    $("#error-message").removeClass("d-none");
                                                    $("#error_message_text").html(data.message);
                                                }
                                                if(data.basics){
                                                if(data.errorNAME && data.errorNAMETXT != null){
                                                    $("#adname").addClass("is-invalid");
                                                    $("#ad-name-feedback").addClass("invalid-feedback");
                                                    $("#ad-name-feedback").show();
                                                    $("#ad-name-feedback").html(data.errorNAMETXT);
                                                }else{
                                                    $("#adname").removeClass("is-invalid");
                                                    $("#adname").addClass("is-valid");
                                                    $("#ad-name-feedback").hide();
                                                }
                                                if(data.errorCON && data.errorCONTXT != null){
                                                    $("#newadcontent").addClass("is-invalid");
                                                    $("#ad-con-feedback").addClass("invalid-feedback");
                                                    $("#ad-con-feedback").show();
                                                    $("#ad-con-feedback").html(data.errorCONTXT);
                                                }else{
                                                    $("#newadcontent").removeClass("is-invalid");
                                                    $("#newadcontent").addClass("is-valid");
                                                    $("#ad-con-feedback").hide();
                                                }
                                                }
                                                $("#submit-new-ad").show();
                                                $("#about-p").show()
                                                $("#repeat-last-ad").show();
                                            }
                                        });
                                });
                            })
                        </script>
                        <div id="submit-ad-response"></div>
                    <form id="submit-new-ad" action="/pages/ajax/ad-submit.php" method="post">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input id="name" name="name" type="text" class="form-control" value="<?= htmlspecialchars($steamprofile['personaname']); ?>" placeholder="<?= htmlspecialchars($steamprofile['personaname']); ?>" readonly>
                            <br>
                            <label for="adname">Name of your ad</label>
                            <input id="adname" name="adname" type="text" maxlength="25" class="form-control"  placeholder="<?=htmlspecialchars($DefaultAdName);?>" >
                            <div id="ad-name-feedback"></div>
                            <br>           
                            <label for="newadcontent">Tell users about what your advertising. Think of it as just typing a normal message into discord. URLs are allowed (<a href="https://support.discordapp.com/hc/en-us/articles/210298617-Markdown-Text-101-Chat-Formatting-Bold-Italic-Underline-" target="_blank">Discord Markdown</a> is supported)</label>
                            <textarea id="newadcontent" class="form-control" name="newadcontent" maxlength="1500" rows="10" placeholder="<?=htmlspecialchars($DefaultAdDesc);?>" ></textarea>
                            <div id="ad-con-feedback"></div>
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
    include("views/includes/footer.php"); // we include footer.php here. you can use .html extension, too.
    ?>

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/popper.js@1"></script>
    <script src="https://unpkg.com/tippy.js@4"></script>
    <script src="main.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
   
    
                    <script>
                        navitem = document.getElementById('ad').classList.add('active')
                    </script>
</body>






</html>