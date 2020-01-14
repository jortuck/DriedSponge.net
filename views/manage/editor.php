<?php
require('steamauth/steamauth.php'); 

?>
<!DOCTYPE html>


<html>
    <head>
<!--         Site created: 9/19/19
        Author: DriedSponge(Jordan Tucker) -->

        <meta name="description" content="Admins only guys">
        <meta name="keywords" content="driedsponge.net editor">
        <meta name="author" content="Jordan Tucker">
        <meta property="og:site_name" content="DriedSponge.net | Editor" />
       
        <?php 
            include("views/includes/meta.php"); 
            ?>
        
        <title>Editor</title>
        <script src="https://kit.fontawesome.com/0add82e87e.js" crossorigin="anonymous"></script>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <link rel="stylesheet" href = "//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" type="text/css" >
        
    </head>
 <body>


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
                include ('steamauth/userInfo.php');
              if (isMasterAdmin($_SESSION['steamid'])){ 
                if(isset($pageid)){
                    $_SESSION['editid'] =$pageid;
                }
                $editing = $_SESSION['editid'];
                $currentq = SQLWrapper()->prepare("SELECT content,title,privacy,slug,description FROM content WHERE thing = :thing");
                $currentq->execute([':thing' => $editing]);
                $current = $currentq->fetch();
                $editname =$current['title'];
                $currentdes = $current['description'];
                $cp = $current['privacy'];
                $cs = $current['slug'];
                if(!empty($current)){
                
                if(isset($_POST['submit-changes'])){
                    $changedcontent = $_POST['content'];
                    $changedprivacy = $_POST['privacysettings'];
                    $newdes = $_POST['des'];
                    $newslug = str_replace(" ","",$_POST['slug']);
                    $changedthing = $editing;
                    $newtitle = $_POST['title'];
                    $changedby = $_SESSION['steamid'];
                    $changedexist = SQLWrapper()->prepare("SELECT content FROM content WHERE thing = :thing");
                    $changedexist->execute([':thing' => $changedthing]);
                    $changedexistrow = $changedexist->fetch();
                    if (!empty($changedexistrow)) {
                        SQLWrapper()->prepare("UPDATE content SET content= :content,  created = :created, privacy = :privacy,title = :title,slug = :slug,description = :description WHERE thing = :thing")->execute([':content' => $changedcontent, ':created' => $changedby, ':thing' => $changedthing, ':privacy' => $changedprivacy, ':title' => $newtitle, 'description' => $newdes,'slug' =>$newslug]);
                        $motdchanged = true;
                        header("Location: /manage/edit/".$changedthing."/saved");   
                    } else {
                        SQLWrapper()->prepare("INSERT INTO content (thing,content,created)
                        VALUES (?,?,?)")->execute([$changedthing, $motdcontent,$motdcreatedby]);
                         header("Location: /manage/edit/".$changedthing."/saved");                          
                    }
                    }

                ?>
                <hgroup>
                        <h1 class="display-4"><strong>DriedSponge.net Editor</strong></h1>
                </hgroup>
                <br>
                <form  action="/manage/edit/<?=htmlspecialchars($editing);?>" method="post">
                <div class="form-group">
                                <button id="submit"name="submit-changes" type="submit" class="btn btn-primary">Save</button>
                                </div> 
                                <div class="form-row">
                                <div class="col">
                                            <label for="title">Page Title</label>
                                            <input class="form-control" placeholder="Enter Title" value="<?=htmlspecialchars($editname);?>" name="title" id="title"></input>
                                    </div>
                                    <div class="col">
                                            <label for="privacysettings">Privacy</label>
                                            <select class="form-control" id="privacysettings" name="privacysettings">
                                            <option value="0">Public</option>
                                            <option value="1">Must be logged in</option>
                                            <option value="2">Must be verified in discord</option>
                                            <option value="3">Must be admin</option>
                                            <option value="4">Must be owner</option>
                                            </select>
                                    </div>                                                 
                                    </div>  
                                    <div class="form-row">
                                        <div class="col">
                                            <label for="des">Page Description</label>
                                            <input maxlength="160" class="form-control" placeholder="Enter Meta Description" value="<?=htmlspecialchars($currentdes);?>" name="des" id="des"></input>
                                        </div>
                                        <div class="col">
                                            <label for="slug">Slug</label>
                                            <input id="slug" name="slug" class="form-control" placeholder="https://driedsponge.net/{slug}" value="<?=htmlspecialchars($cs);?>" type="text" maxlength="20">
                                    </div>  
                                    </div>
                                <div class="form-group">
                           <label for="content" style="color: black;">Edit the contents</label>
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
                        header("Location: /home/");
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
                
                <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
                
                <script src="https://cdn.tiny.cloud/1/dom10ctinmaceofbm524vgsfebgy22lsh2ooomg0oqs8wu28/tinymce/5/tinymce.min.js"></script>
                <script>
                    $(function() {
                        $("#privacysettings").val('<?php echo $cp;?>');
                    });
                </script>
                <script>
                tinymce.init({
                    selector:'textarea', 
                    branding: false, 
                    plugins: "link,anchor,autoresize,autosave,image,wordcount,searchreplace,fullscreen,code",
                    menubar: "file edit insert view format table tools help ",
                    toolbar: "undo redo | styleselect | bold italic underline strikethrough format code | align left center right justify | link image anchor | wordcount ",
                    default_link_target: "_blank",
                    });</script>
                <?php
                        if(isset($action)){
                            if($action === "saved"){
                            ?>
                            <script type="text/JavaScript">  
                            toastr["success"]("Your changes have been saved! You can exit the editor or keep editing.", "Congratulations!")     
                            </script>
                            <?php
                        }
                    }
                        ?>
 </body>

</html>