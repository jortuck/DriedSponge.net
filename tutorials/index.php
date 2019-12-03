<?php
require ('../steamauth/steamauth.php');  
?>
<!DOCTYPE html>


<html>
    <head>
<!--         Site created: 9/19/19
        Author: DriedSponge(Jordan Tucker) -->
        
        <meta name="description" content="On my YouTube channel, I do various coding tutorials. Primarily with Lua but you might see some other languages on there too. For every tutorial I make, I create a web page for it. The web pages could include more information than the video so I recommend you always browse through them.">
        <meta name="keywords" content="Lua, tutorial, coding, coding tutorials, lua tutorials">
        <meta name="author" content="Jordan Tucker">
        <meta property="og:site_name" content="DriedSponge.net | Tutorials" />
      
        <?php 
            include("../meta.php"); 
            ?>
        
        <title>Tutorials</title>
        <script src="https://kit.fontawesome.com/0add82e87e.js" crossorigin="anonymous"></script>
    </head>
<style>
  .card{
    margin-bottom: 20px;

  }
  .row{
    justify-content: center;
  }
  </style>
 <body>
        
<?php include("navbar.php") ;?>
    <div class="app">
    <div class="container-fluid-lg" style="padding-top: 80px;">
        
            <div class="container">
               
                    <hgroup>
                    <h1 class="display-2"><strong>Tutorials</strong></h1>
                        <br>
                    </hgroup>
                    <p class="paragraph pintro">On my YouTube channel, I do various coding tutorials. Primarily with Lua but you might see some other languages on there too. For every tutorial I make, I create a web page for it. The web pages could include more information than the video so I recommend you always browse through them.</p>
                    <h4 class="subheading">Lua Tutorials</h4>    
                    <a href="luaresources.php" class="btn btn-primary">Resources</a>
                    <br>
                    <br>
                    <div class="row" style="justify-content: center;">
                    
                            <div class="card" style="width: 21rem;">
                                    <h5 class="card-header">
                                            Lua Tutorial 1 - Basics
                                          </h5>    
                                    <div class="card-body">
                                      <p class="card-text"><strong>Topics Covered</strong></p>
                                    <ul class="card-text">
                                    <li><a href="lua.php?page=1#bct">Basic Coding Tools</a></li>
                                    <li><a href="lua.php?page=1#css">Client/Shared/Server</a></li>
                                    <li><a href="lua.php?page=1#dt">Data Types</a></li>
                                    </ul>
                                    <a href="lua.php?page=1" class="btn btn-primary">View Tutorial</a>
                                    <a href="https://youtu.be/W53tk0yTJCo" target="_blank" class="btn btn-primary">Watch Video</a>
                                    </div>
                                    <div class="card-footer text-muted">
                                       October 12th, 2019 
                                      </div>
                                      
                        </div>
                      <div class="card" style="width: 21rem;">
                                  <h5 class="card-header">
                                          Lua Tutorial 2 - Getting Started
                                        </h5>    
                                  <div class="card-body">
                                    <p class="card-text"><strong>Topics Covered</strong></p>
                                  <ul class="card-text">
                                  <li><a href="lua.php?page=2#as">Addon Structure</a></li>
                                  <li><a href="lua.php?page=2#f">Functions</a></li>
                                  <li><a href="lua.php?page=2#v">Variables</a></li>
                                  </ul>
                                  <a href="lua.php?page=2" class="btn btn-primary">View Tutorial</a>
                                  <a href="https://youtu.be/W53tk0yTJCo" target="_blank" class="btn btn-primary">Watch Video</a>
                                  </div>
                                  <div class="card-footer text-muted">
                                      October 20th, 2019 
                                    </div>
                      </div>
                      
                      <div class="card" style="width: 21rem;">
                                  <h5 class="card-header">
                                          Lua Tutorial 3 - if/then/and/or
                                        </h5>    
                                  <div class="card-body">
                                    <p class="card-text"><strong>Topics Covered</strong></p>
                                  <ul class="card-text">
                                  <li><a href="lua.php?page=3#h">Hooks</a></li>
                                  <li><a href="lua.php?page=3#i">if then statements</a></li>
                                  <li><a href="lua.php?page=3#a">and/or statements</a></li>
                                  </ul>
                                  <a href="lua.php?page=3" class="btn btn-primary">View Tutorial</a>
                                  <a href="https://youtu.be/nVYZvn-vanw" target="_blank" class="btn btn-primary">Watch Video</a>
                                  </div>
                                  <div class="card-footer text-muted">
                                      November 17th, 2019 
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
                    navitem = document.getElementById('tut').classList.add('active')
                    
        </script>
 </body>






</html>