<?php
require('../steamauth/steamauth.php'); 
include("../databases/connect.php");
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
            include("../meta.php"); 
            ?>
        
        <title>Manage - Users</title>
        <script src="https://kit.fontawesome.com/0add82e87e.js" crossorigin="anonymous"></script>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <link rel="stylesheet" href = "//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" type="text/css" >
        
    </head>
 <body>

<?php
include("../databases/connect.php");
include("../src/libs/functions.php");
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
    <div class="container-fluid-lg" style="padding-top: 30px;">
        
            <div class="container">
            
            <?php 
            $ivalidid = false;
            if (isset($_SESSION['steamid'])){ 
                include ('../steamauth/userInfo.php');
              if (isAdmin($_SESSION['steamid'])){ 
                if(isset($_GET['id'])){
                    $_SESSION['editid'] =$_GET['id'];
                }
                $editing = $_SESSION['editid'];
                $currentq = SQLWrapper()->prepare("SELECT content FROM content WHERE thing = :thing");
                $currentq->execute([':thing' => $editing]);
                $current = $currentq->fetch();
                if(!empty($current)){
                
                if(isset($_POST['submit-changes'])){
                    $changedcontent = $_POST['content'];
                    $changedthing = $editing;
                    $changedby = $_SESSION['steamid'];
                    $changedexist = SQLWrapper()->prepare("SELECT content FROM content WHERE thing = :thing");
                    $changedexist->execute([':thing' => $changedthing]);
                    $changedexistrow = $changedexist->fetch();
                    if (!empty($changedexistrow)) {
                        SQLWrapper()->prepare("UPDATE content SET content= :content,  created = :created WHERE thing = :thing")->execute([':content' => $changedcontent, ':created' => $changedby, ':thing' => $changedthing]);
                        $motdchanged = true;
                        header("Location: editor.php?id=".$changedthing."&saved");
                    } else {
                        SQLWrapper()->prepare("INSERT INTO content (thing,content,created)
                        VALUES (?,?,?)")->execute([$changedthing, $motdcontent,$motdcreatedby]);
                         header("Location: editor.php?id=".$changedthing."&saved");                          
                    }
                    }

                ?>
                <hgroup>
                        <h1 class="display-4"><strong>DriedSponge.net Editor</strong></h1>
                </hgroup>
                <br>
                <form  action="editor.php" method="post">
                        <div class="form-group">
                        
                            <label for="submit" style="color: black;">Edit the privacy policy</label>
                            <br>
                            <button id="submit"name="submit-changes" type="submit" class="btn btn-primary">Save</button>
                            <br>
                            <br>
                                <textarea id="content" name="content" rows="40" class="form-control"><?=htmlspecialchars_decode($current["content"]);?></textarea>                                      
                                
                                </div>                                
                     </form> 
                <?php 
                }else{
                   ?>
                    <h1 class="display-2" style="color:red;"><strong>Can't edit that page because it does not exist!</strong></h1>
                    
                   <?php 
                }
                }else{ 
                ?>
                    <hgroup>
                        <h1 class="display-2"><strong>You are not management, get out!</strong></h1>
                        <?php
                        header("Location: ../index.php");
                        ?>
                    
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
            
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
                <script src="https://unpkg.com/popper.js@1"></script>
                <script src="https://unpkg.com/tippy.js@4"></script>
                <script src="main.js"></script>
                <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
                <script src="https://cdn.tiny.cloud/1/dom10ctinmaceofbm524vgsfebgy22lsh2ooomg0oqs8wu28/tinymce/5/tinymce.min.js"></script>
                <script>
                tinymce.init({
                    selector:'textarea', 
                    branding: false, 
                    plugins: "link,anchor,autoresize,autosave,image,wordcount,searchreplace,fullscreen,code",
                    menubar: "file edit insert view format table tools help ",
                    toolbar: "undo redo | styleselect | bold italic underline strikethrough format code | align left center right justify | link image anchor | wordcount",
                    default_link_target: "_blank",
                    });</script>
                <?php
                        if(isset($_GET['saved'])){
                            ?>
                            <script type="text/JavaScript">  
                            toastr["success"]("Your changes have been saved! You can exit the editor or keep editing.", "Congratulations!")     
                            </script>
                            <?php
                        }
                        ?>
 </body>

</html>