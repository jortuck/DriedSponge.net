<!DOCTYPE html>


<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        
        <meta charset="UTF-8">
        <meta name="description" content="Welcome to the first Lua tutorial. In this tutorial we will cover the following items: Basic coding tools, Client/Shared/Server, Data Types">
        <meta name="keywords" content="Basic lua, Lua tutorial, gmod lua basics,Client/Shared/Server, DriedSponge Lua Tutorials basics">
        <meta name="author" content="Jordan Tucker">
        <meta property="og:site_name" content="DriedSponge.net | Lua Tutorial 1 - Basics" />
        <meta name="viewport" content="width = device-width, initial-scale = 1">
        <?php 
            include("../meta.php"); 
            ?>
        <link id="styless" rel="stylesheet" href = "../textclass.css">
        <link id="favicon" rel="icon" href = "https://cdn.driedsponge.net/img/zfavicon.ico" type="image/x-icon">
        <title>Lua Tutorial 1 - Basics</title>
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
                            <li><a href="#bct">Basic Coding Tools</a></li>
                            <li><a href="#css">Client/Shared/Server</a></li>
                            <li><a href="#dt">Data Types</a></li>
                        </ul>
                    <p class="paragraph">The reason this tutorial is so short is because it contains essential information you will use forever.</p>
                    <h4 class="subheading">Video:</h4>  
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/W53tk0yTJCo" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <br>
                    <h4 class="subheading" id="bct">Basic coding tools</h4>
                        <p class="paragraph">In order to even start coding, you need syntax editor. This allows you to see your code properly and it makes it way easier to modify. Here is a list of the ones I recommend:</p>
                        <ul class="paragraph">
                                <li><a href="https://www.sublimetext.com/" target="_blank">Sublime Text</a></li>
                                <li><a href="https://notepad-plus-plus.org/" target="_blank">Notepad++</a></li>
                                <li><a href="https://code.visualstudio.com/" target="_blank">Visual Studio Code</a> - <i>This is the one I use and personally prefer</i></li>
                            </ul> 
                            <p class="paragraph">One thing you need to know how to do is commenting. Commenting basically omits that part of the code, causing it not to be ran.</p>
                            
                            <img src="https://i.driedsponge.net/images/png/2kcbY.png" alt="comment example"></img>
                            <p class="paragraph">As you can see, the commented code is green, meaning that it will not be run. You can use the comments to tell yourself what certain functions do. You can also use it to credit yourself in your work. In lua you use two dashes to comment (--).</p>
                            <p class="paragraph">The final important thing you need to know about is the <a href="https://wiki.garrysmod.com" target="_blank">GMOD wiki</a>. You will visit this site various times to look up functions and hooks in the game so I recommend keeping it bookmarked in your browser.</p>
                    <br>
                    <h4 class="subheading" id="css">Client/Shared/Server</h4>
                    <p class="paragraph">In Garry's Mod, there are three realms that exist: client, server  and shared.</p>
                    <ul class="paragraph">
                        <li>Client - The client code is the code that is run on the local players game client (<i>The players GMOD game</i>)</li>
                        <li>Server - The server code is all the code ran by the server (<i>The server is the thing that players join to play gmod</i>)</li>
                        <li>Shared - The shared code us functions and hooks that can run on both the client and the server</li>
                    </ul>                                   
                    <p class="paragraph">In case all of that was confusing, here is a quick example. Say my name is Joe, and I want to send a message in chat. In order for my message to be seen by all players, it has to be sent to the server first. When the server receives it, it will distribute the message to the rest of the players so they can see it.</p>
                        
                    <p class="paragraph">Another important thing to note is that the server cannot run client functions and the client cannot run server functions. Example: A client cannot run the ban function because it is a server function, and only the server can use the ban function.</p>
                    <br>
                    <h4 class="subheading" id="dt">Data Types</h4>
                    <p class="paragraph">In Lua (<i>and the majority of other coding languages</i>), there are three data types: string, boolean, and number. A string can store any alphanumeric character and most other symbols (<i>ex: !@#$%</i>). Strings are defined using quotes (<i>""</i>). A boolean or bool for short, is a <strong>true</strong> or <strong>false</strong> value. A number is any number obviously (<i>Decimals and negatives are supported!</i>). Below is an example screenshot:</p>
                    <img src="https://i.driedsponge.net/images/png/Sa8iQ.png" alt="datatype example"/>
                    <br>
                    <p class="paragraph">This is the end of the first tutorial. This information will help you a lot in the future. If anybody needs help the best way to talk to me is in <a href="https://discord.gg/EEPXhqE" target="_blank">my discord server</a>. Have a good day/evening!</p>

                    


</div>
</div>
</div> 

<!-- end of app -->
<?php 
    include("../footer.php"); 
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