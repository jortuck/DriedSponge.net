<?php
session_start();
?>
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
    </head>
 <body>
 <?php
include("navbar.php")
?>
<?php
$FailedCaptch = false;
$DisplayLogin = true;
if(isset($_POST['submit'])){
    $DisplayForm = false;
 $captcha = $_POST['g-recaptcha-response'];
 $json = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Ld9SaQUAAAAACIaPxcErESw-6RvtljAMd3IYsQL&response=$captcha");
$captchares = json_decode($json);
$success = $captchares->success;
 if($success == true){
    if()

 }
}
?>
 <div class="app">
    <div class="container-fluid-lg" style="padding-top: 80px;">
        
            <div class="container">
                <hgroup>
                        <!-- <img src="https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/18/18be38c2f230fea0fa667c8165e4da5cb1a787c0_full.jpg" alt="DriedSponge's Profile Picture"> -->
                        <h1 class="display-2"><strong>Login</strong></h1>
                    
                    <br>
                </hgroup>
                
  
                        <p class="paragraph pintro">Tell me what you think about the site and what could be changed. Both positive and negative feedback are accepted!</p>
                        <br>                        
                        <form action="login.php" method="post">
                        <div class="form-group">
                            <label for="email">Email</label>
                                <input id="email" name="email" type="text" class="form-control" placeholder="Your email address" required>
                                 <br>
                                 <label for="say">What are your thoughts on the site?</label>
                                <input id="say"class="form-control" name="say"  type="password" placeholder="Password"  required></input>
                                <br>
                                <div class="g-recaptcha" data-sitekey="6Ld9SaQUAAAAAG81x31GrfZeiJEd1gtd59CRMbC7" required></div>
                                <br>
                                <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                    
                    
                



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