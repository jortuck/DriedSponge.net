<!DOCTYPE html>


<html>
    <head>
<!--         Site created: 9/19/19
        Author: DriedSponge(Jordan Tucker) -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        
        <meta charset="UTF-8">
        <meta name="description" content="Here is a list of my Lua projects. Some of them are available  for download either from here or from the steam workshop. This list also shows items I've made for other people.">
        <meta name="keywords" content="Portfolio">
        <meta name="author" content="Jordan Tucker">
        <meta property="og:site_name" content="DriedSponge.net | Lua Projects" />
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
                        <h2><strong><a href="index.php">Tutorials</a> &gt; Lua Tutorial 1 - Basics</strong></h2>
                        <br>
                    </hgroup>
                    <p class="paragraph">Welcome to the first Lua tutorial. In this tutorial we will cover the following items:</p>
                    <ul class="paragraph">
                            <li><a href="#css">Client/Shared/Server</a></li>
                            <li><a href="#st"></a>Data Types</a></li>
                        </ul>
                    <p class="paragraph">The reason this tutorial is so short is because it contains essential information you will use forever.</p>
                    <h4 class="subheading">Video:</h4>  
                    <br>
                    <h4 class="subheading" id="css">Client/Shared/Server</h4>
                    <p class="paragraph">In Garry's Mod, there are three realms that exist: client, sever and shared.</p>
                    <ul class="paragraph">
                        <li>Client - The client code is the code that is run on the local players game client (<i>The players GMOD game</i>)</li>
                        <li>Server - The server code is all the code ran by the server (<i>The server is the thing that players join to play gmod</i>)</li>
                        <li>Shared - The shared code us functions and hooks that can run on both the client and the server</li>
                    </ul>                                   
                    <p class="paragraph">In case all of that was confusing, here is a quick example. Say my name is Joe, and I want to send a message in chat. In order for my message to be seen by all players, it has to be sent to the server first. When the server recieves it, it will distribute the message to the rest of the players so they can see it. In case you are still confused by this, here is a diagram I made.</p>
                        
                    <p class="paragraph">Another important thing about this topic is that the server cannot run client functions and vice versa</p>


                    


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