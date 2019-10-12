<!DOCTYPE html>


<html>
    <head>
<!--         Site created: 9/19/19
        Author: DriedSponge(Jordan Tucker) -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        
        <meta charset="UTF-8">
        <meta name="description" content="On my YouTube channel, I do various coding tutorials. Primarily with Lua but you might see some other languages on there too. For every tutorial I make, I create a web page for it. The web pages could include more information than the video so I recommend you always browse through them.">
        <meta name="keywords" content="Lua, tutorial, coding, coding tutorials, lua tutorials">
        <meta name="author" content="Jordan Tucker">
        <meta property="og:site_name" content="DriedSponge.net | Tutorials" />
        <meta name="viewport" content="width = device-width, initial-scale = 1">
        <?php 
            include("../meta.php"); 
            ?>
        <link id="styless" rel="stylesheet" href = "../textclass.css">
        <link id="favicon" rel="icon" href = "https://cdn.driedsponge.net/img/zfavicon.ico" type="image/x-icon">
        <title>Lua Projects</title>
        <script src="https://kit.fontawesome.com/0add82e87e.js" crossorigin="anonymous"></script>
    </head>

 <body>
        
    <div class="container-fluid-lg">

        <div class="page-header">
        
            <nav class="navbar navbar-expand-lg navbar-dark nbth fixed-top " >
                    <a class="navbar-brand" href="#"><strong>driedsponge.net</strong></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarmain" aria-controls="navbarmain" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                          </button>
                    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                            
                        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                            <li class="nav-item"><a class="nav-link" href="../index.php">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="../webdesign.php">Web Projects</a></li>
                            <li class="nav-item"><a class="nav-link" href="../lua.php">Lua Projects</a></li>
                            <li class="nav-item active"><a class="nav-link" href="index.php">Coding Tutorials<span class="sr-only">(current)</span></a></li>
                        </ul>  
                        </div>
                  </nav>
                
                  
        </div>
        
    </div>
    <div class="app">
    <div class="container-fluid-lg" style="padding-top: 80px;">
        

        
        

                            
   
        
            <div class="container">
               
                    <hgroup>
                        <h2><strong>Tutorials</strong></h2>
                        <br>
                    </hgroup>
                    <p class="paragraph">On my YouTube channel, I do various coding tutorials. Primarily with Lua but you might see some other languages on there too. For every tutorial I make, I create a web page for it. The web pages could include more information than the video so I recommend you always browse through them.</p>
                    <h4 class="subheading">Lua Tutorials</h4>                                    
                    <br>
                    <div class="row" style="justify-content: center;">
                    
                            <div class="card" style="width: 21rem;">
                                    <h5 class="card-header">
                                            Lua Tutorial 1 - Basics
                                          </h5>    
                                
                                    <div class="card-body">
                                    
                                      </h5>
                                      <p class="card-text"><strong>Topic Covered</strong></p>
                                      
                                    <ul class="card-text">
                                    <li><a href="lua1.php#bct">Basic Coding Tools</a></li>
                                    <li><a href="lua1.php#css">Client/Shared/Server</a></li>
                                    <li><a href="lua1.php#dt">Data Types</a></li>
                                    </ul>
                                    <a href="lua1.php" class="btn btn-primary">View Tutorial</a>
                                    </div>
                                
                            
    
                        </div>
                        



                    


</div>
</div>
</div> 
</div> 
<!-- end of app -->
<?php 
    include("../footer.php"); // we include footer.php here. you can use .html extension, too.
    ?>


                
                <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/popper.js@1"></script>
        <script src="https://unpkg.com/tippy.js@4"></script>
        <script>
             var date = new Date();
        if (date.getMonth() == 9)
                    {
                    var spookfavicon = document.getElementById('favicon');
                    spookfavicon.href = "https://cdn.driedsponge.net/img/favicon-spook.ico"
                    var css = document.getElementById('styless');
                    css.href = "../spook.css"
                    document.getElementById('themefoot').innerHTML = "Spooky";
                    } else {
                    document.getElementById('themefoot').innerHTML = "Normal";
                    }
        </script>
 </body>






</html>