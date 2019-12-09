<?php
require('steamauth/steamauth.php');  
?>
<!DOCTYPE html>


<html>
    <head>
<!--         Site created: 9/19/19
        Author: DriedSponge(Jordan Tucker) -->
        
        <meta name="description" content="Here you can find a list of all of my web projects and you may be able to view some of them. Some of these were made in my web design class, that's why they might be a bit dull. This list also contains other web things I have made for other people">
        <meta name="keywords" content="Portfolio,DriedSponge,info.driedsponge.net">
        <meta name="author" content="Jordan Tucker">
        
        <meta property="og:site_name" content="DriedSponge.net | Web Projects" />
        <?php 
            include("meta.php"); 
            ?>
            
        <title>Web Projects</title>
        <script src="https://kit.fontawesome.com/0add82e87e.js" crossorigin="anonymous"></script>
    </head>

 <body>
 <?php
include("navbar.php")
?>
     <div class="app">
   
    <div class="container-fluid-lg" style="padding-top: 80px;">

        
            <div class="container">
               
                    <hgroup>
                            <!-- <img src="https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/18/18be38c2f230fea0fa667c8165e4da5cb1a787c0_full.jpg" alt="DriedSponge's Profile Picture"> -->
                            <h1 class="display-2"><strong>Web Projects</strong></h1>
                        <br>
                    </hgroup>
                    <p class="paragraph pintro">Here you can find a list of all of my web projects and you may be able to view some of them. Some of these were made in my web design class, that's why they might be a bit dull. This list also contains other web things I have made for other people.</p>
                    
                    <br>
                    <div data-aos="fade-right" class="row">
                      <div class="col-lg">
                        <div class="showcase-text">
                          <h2>Custom Image Viewer</h2>
                          <p class="paragraph">For this project, I wanted to add more "style" to my image server so I used some css and html to just make it look better in general. I also used java script to add buttons to copy the image url, and download the image.</p>
                          <p class="paragraph"><span class="badge badge-success">Active</span></p>
                          <p class="paragraph">
                          <a href="https://i.driedsponge.net/bIrPj" target="_blank"class="btn btn-primary">Visit Example</a></p>
                    </div>
                  </div>
                    <div class="col-lg">
                        <img src="https://i.driedsponge.net/images/png/UbV0j.png" class="img-fluid showcase-img" alt="Example" >
                    </div>
                  </div>
                  <br>
                  <br>
                  <div data-aos="fade-left" class="row">
                    <div  class="col-lg">
                        <img src="https://i.driedsponge.net/images/png/BtceH.png" class="img-fluid showcase-img">
                    </div>
                    <div  class="col-lg">
                      <div class="showcase-text">
                        <h2>DriedSponge.net (This site!)</h2>
                          <p class="paragraph">This site was created to show all the coding projects I've made. I also use it to practice my HTML, CSS, PHP, and js.</p>
                          <p class="paragraph"><span class="badge badge-success">Active (obviously)</span></p>
                          
                          <a target="_blank"href="https://driedsponge.net/" class="btn btn-primary">Visit Site</a>
                        </div>
                      </div>
                  </div>
                  <br>
                  <br>
                  <div data-aos="fade-right" class="row">
                    <div class="col-lg">
                        <div class="showcase-text">
                          <h2>SteamID Finder</h2>
                            <p class="paragraph">I created this SteamID finder to practice my php skills. It uses the steam api and <a target="_blank" href="https://github.com/xPaw/SteamID.php">this SteamID converter</a> to looke up info about any steam user.</p>
                            <p class="paragraph"><span class="badge badge-success">Active</span></p>
                            <p class="paragraph">
                            <a href="https://driedsponge.net/steam.php" target="_blank"class="btn btn-primary">Visit Site</a></p>
                    </div>
                  </div>
                  <div class="col-lg">

                      <img src="https://i.driedsponge.net/images/png/4a3fo.png" class="img-fluid showcase-img" alt="Example" >

                </div>
                </div>
                  <br>



                    

                        </div>
</div>
</div> 
<br>
<!-- End of "app" -->
<?php 
    include("footer.php"); // we include footer.php here. you can use .html extension, too.
    ?>




                
                <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> 
        <script src="https://unpkg.com/popper.js@1"></script>
        <script src="https://unpkg.com/tippy.js@4"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
        <script src="main.js"></script>   
        <script>
            navitem = document.getElementById('web').classList.add('active')
            //navitem.class = "nav-item active"
        </script>    
        <script>
          AOS.init();
      </script>
 </body>






</html>