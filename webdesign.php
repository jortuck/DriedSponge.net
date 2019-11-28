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
                          <div class="card" data-aos="fade-up">
                            <h5 class="card-header">Custom Image Viewer <span class="badge badge-success">Active</span></h5>
                            <div class="card-body">
                              <h5 class="card-title">About</h5>
                              <p class="card-text">I did not create the custom image uploader, I use a combination of <a target="_blank" href="https://getsharex.com/">ShareX</a>  and this thing called <a target="_blank" href="https://github.com/aerouk/imageserve">imageserver</a>. This works perfectly for when I want to upload and share my screen shots with my friends, the only issue was when you would open the image in chrome or any other browser, it would show the image but with very ugly html. So I decided to modify the viewer file to make the html and css way better. I also added some Javascript to add some additional functionality to the site.</p>
                              <a href="https://i.driedsponge.net/bIrPj" target="_blank"class="btn btn-primary">Visit Example</a>
                            </div>
                          </div>
                          <br>
                          <div class="card" data-aos="fade-up">
                            <h5 class="card-header">DriedSponge.net (This site!) <span class="badge badge-success">Active (obviously)</span></h5>
                            <div class="card-body">
                              <h5 class="card-title">About</h5>
                              <p class="card-text">This site was created to show all the coding projects I've made. I also use it to practice my HTML, CSS, PHP, and js. I try to use all of my skills on this site. Most of the content is html and css, but I also use php and js for some other small things.</p>
                              <a href="https://driedsponge.net/" target="_blank"class="btn btn-primary">Visit site</a>
                            </div>
                          </div>
                          <br>
                          <div class="card" data-aos="fade-up">
                              <h5 class="card-header">SteamID Finder <span class="badge badge-success">Active (obviously)</span></h5>
                              <div class="card-body">
                                <h5 class="card-title">About</h5>
                                <p class="card-text">I created this SteamID finder to practice my php skills. It uses the steam api and <a target="_blank" href="https://github.com/xPaw/SteamID.php">this SteamID converter</a> to looke up info about any steam user. It was a lot of fun to make and it can actually be pretty useful.</p>
                                <a href="https://driedsponge.net/steam.php" target="_blank"class="btn btn-primary">Visit site</a>
                              </div>
                            </div>



                    

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