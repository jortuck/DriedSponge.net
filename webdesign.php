<!DOCTYPE html>


<html>
    <head>
<!--         Site created: 9/19/19
        Author: DriedSponge(Jordan Tucker) -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        
        <meta charset="UTF-8">
        <meta name="description" content="Here you can find a list of all of my web projects and you may be able to view some of them. Some of these were made in my web design class, that's why they might be a bit dull. This list also contains other web things I have made for other people">
        <meta name="keywords" content="Portfolio,DriedSponge,info.driedsponge.net">
        <meta name="author" content="Jordan Tucker">
        <meta name="viewport" content="width = device-width, initial-scale = 1">
        <meta property="og:site_name" content="DriedSponge.net | Web Projects" />
        <?php 
            include("meta.php"); 
            ?>
        <link id="styless" rel="stylesheet" href = "textclass.css">
        <link id="favicon" rel="icon" href = "https://cdn.driedsponge.net/img/zfavicon.ico" type="image/x-icon">
        <title>Web Projects</title>
        <script src="https://kit.fontawesome.com/0add82e87e.js" crossorigin="anonymous"></script>
    </head>
    
 <body>

     <div class="app">
    <div class="container-fluid-lg">
        <div class="page-header">
        
            <nav class="navbar navbar-expand-lg navbar-dark  nbth fixed-top" >
                    <a class="navbar-brand" href="#"><strong>driedsponge.net</strong></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarmain" aria-controls="navbarmain" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                          </button>
                    <div class="collapse navbar-collapse" id="navbarmain">
                            
                        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                            <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                            <li class="nav-item active"><a class="nav-link" href="webdesign.php">Web Projects<span class="sr-only">(current)</span></a></li>
                            <li class="nav-item"><a class="nav-link" href="lua.php">Lua Projects</a></li>
                        
                        </ul>  
                        </div>
                  </nav>
                
                  
        </div>
        
    </div>
    <div class="container-fluid-lg" style="padding-top: 80px;">
        

        
        

                            
   
        
            <div class="container">
               
                    <hgroup>
                            <!-- <img src="https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/18/18be38c2f230fea0fa667c8165e4da5cb1a787c0_full.jpg" alt="DriedSponge's Profile Picture"> -->
                        <h2><strong>Web Projects</strong></h2>
                        <br>
                    </hgroup>
                    <p class="paragraph">Here you can find a list of all of my web projects and you may be able to view some of them. Some of these were made in my web design class, that's why they might be a bit dull. This list also contains other web things I have made for other people</p>
                    
                    <div class="card">
                            <h5 class="card-header">The J-Prop Shop <span class="badge badge-danger">Deprecated</span></h5>
                            <div class="card-body">
                              <h5 class="card-title">About</h5>
                              <p class="card-text">This was the very first site I made. It is from a made up scenario in the HTML/CSS text book we use in school. I did not do the CSS for this cite, only the HTML (<em>thats why it looks like its from 2005!</em>). This site was very easy to make and honestly it was a good one to get started on HTML with.</p>
                              <a href="https://driedsponge.net/web_design/jpropshop/" target="_blank"class="btn btn-primary">Visit site</a>
                            </div>
                          </div>
                          <div class="card">
                            <h5 class="card-header">Custom Image Viewer <span class="badge badge-success">Active</span></h5>
                            <div class="card-body">
                              <h5 class="card-title">About</h5>
                              <p class="card-text">I did not create the custom image uploader, I use a combination of <a target="_blank" href="https://getsharex.com/">ShareX</a>  and this thing called <a target="_blank" href="https://github.com/aerouk/imageserve">imageserver</a>. This works perfectly for when I want to upload and share my screen shots with my friends, the only issue was when you would open the image in chrome or any other browser, it would show the image but with very ugly html. So I decided to modify the viewer file to make the html and css way better. I also added some Javascript to add some additional functionality to the site.</p>
                              <a href="https://i.driedsponge.net/bIrPj" target="_blank"class="btn btn-primary">Visit Example</a>
                            </div>
                          </div>
                          <div class="card">
                            <h5 class="card-header">DriedSponge.net (This site!) <span class="badge badge-success">Active (obviously)</span></h5>
                            <div class="card-body">
                              <h5 class="card-title">About</h5>
                              <p class="card-text">This site was created to show all the coding projects I've made. I also use it to practice my HTML, CSS, PHP, and js. I try to use all of my skills on this site. Most of the content is html and css, but I also use php and js for some other small things.</p>
                              <a href="https://driedsponge.net/" target="_blank"class="btn btn-primary">Visit site</a>
                            </div>
                          </div>
            



                    

                        </div>
</div>
</div> 
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
 </body>






</html>