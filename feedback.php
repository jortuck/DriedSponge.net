<!DOCTYPE html>


<html>
    <head>
<!--         Site created: 9/19/19
        Author: DriedSponge(Jordan Tucker) -->

        <meta name="description" content="On this page you can see a list of everyone who has contributed to this site.">
        <meta name="keywords" content="contributors, driedsponge.net contributors">
        <meta name="author" content="Jordan Tucker">
        <meta property="og:site_name" content="DriedSponge.net | Contributors" />
       
        <?php 
            include("meta.php"); 
            ?>
        
        <title>Feedback</title>
        <script src="https://kit.fontawesome.com/0add82e87e.js" crossorigin="anonymous"></script>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    </head>
 <body>
<?php
include("navbar.php")
?>
<?php
$FailedCaptch = false;
$DisplayForm = true;
if(isset($_POST['submit'])){
    $DisplayForm = false;
 $captcha = $_POST['g-recaptcha-response'];
 $json = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Ld9SaQUAAAAACIaPxcErESw-6RvtljAMd3IYsQL&response=$captcha");
$captchares = json_decode($json);
$success = $captchares->success;
 if($success == true){
    echo "woohoo";
        
    if (!isset($_POST['email'], $_POST['say'])) {
        return;
    }
    $request = json_encode([
        "embeds" => [
            
            [
                    "author" => [
                    "name" => "test",
                    "url" => "https://driedsponge.net",
                    "icon_url" => "https://i.driedsponge.net/images/png/TQSzu.png",
                        ],
                    "footer" => [
                    "text" => "Powered by WUPHF! For GMOD",
                    "url" => "https://steamcommunity.com/sharedfiles/filedetails/?id=1805078462",
                        ],
                "title" => "test",
                "type" => "rich",
                "description" => "test",
                "timestamp" => date("c"),
                "tts" => true,
                "url" => "https://steamcommunity.com/sharedfiles/filedetails/?id=1805078462",
                "image"=> [
                 "url"=> "https://i.driedsponge.net/images/png/TQSzu.png"
                ],
            ]
            
        ]
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    
    $ch = curl_init("https://discordapp.com/api/webhooks/650866821095882762/Y-Sf_yCTGDKSh_hm8nSkvAphQQyl8KtPxISx6NSQ1t3daUVhobXKX1EW-E-wqseC7ndf");
    
    curl_setopt_array($ch, [
        CURLOPT_POST => 1,
        CURLOPT_FOLLOWLOCATION => 1,
        CURLOPT_POSTFIELDS => $request,
        CURLOPT_RETURNTRANSFER => 1
    ]);
    
    curl_exec($ch);
 }else{
    $DisplayForm = true;
    $FailedCaptch = true;
 }
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
                <?php 
                if ($FailedCaptch){
                ?>
                <h1 class="articleh1" style="color: red;">Uh oh! Looks like you failed the captcha! Try again but this time try acting less like a robot.</h1>
                <?php 
                    }
                ?>

                    <?php
                    if ($DisplayForm){
                        ?>
                        
                        <p class="paragraph pintro">Tell me what you think about the site and what could be changed. Both positive and negative feedback are accepted!</p>
                        <br>                        
                        <form action="feedback.php" method="post">
                        <div class="form-group">
                            <label for="email">Email</label>
                                <input id="email" name="email" type="text" class="form-control" placeholder="Your email address" required>
                                 <br>
                                 <label for="say">What are your thoughts on the site?</label>
                                <textarea id="say"class="form-control" name="say" rows="3" placeholder="Type here I guess..."  required></textarea>
                                <br>
                                <div class="g-recaptcha" data-sitekey="6Ld9SaQUAAAAAG81x31GrfZeiJEd1gtd59CRMbC7" required></div>
                                <br>
                                <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                    <?php
                    }else{
                        ?>
                    <h1 class="articleh1">Thank you for submitting your response!</h1>
                    



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