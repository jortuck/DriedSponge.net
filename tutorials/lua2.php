<!DOCTYPE html>


<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        
        <meta charset="UTF-8">
        <meta name="description" content="Welcome to my second Lua tutorial!. In this tutorial I will cover the following items: addon structure, functions, and variables.">
        <meta name="keywords" content="lua functions, Lua tutorial, gmod lua functions,lua hooks, DriedSponge Lua Tutorials Getting Started,lua Getting Started">
        <meta name="author" content="Jordan Tucker">
        <meta property="og:site_name" content="DriedSponge.net | Lua Tutorial 2 - Getting Started" />
        <meta name="viewport" content="width = device-width, initial-scale = 1">
        <?php 
            include("../meta.php"); 
            ?>
        <link id="styless" rel="stylesheet" href = "../textclass.css">
        <link id="favicon" rel="icon" href = "https://cdn.driedsponge.net/img/zfavicon.ico" type="image/x-icon">
        <title>Lua Tutorial 2 - Getting Started</title>
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
                        <h2><strong><a href="index.php">Tutorials</a> &gt; Lua Tutorial 2 - Getting Started</strong></h2>
                        <br>
                    </hgroup>
                    <p class="paragraph">Welcome to my second Lua tutorial!. In this tutorial I will cover the following items:</p>
                    <ul class="paragraph">
                            <li><a href="#as">Addon Structure</a></li>
                            <li><a href="#f">Functions</a></li>
                            <li><a href="#v">Variables</a></li>
                        </ul>
                    <h4 class="subheading">Video:</h4>  
                   
                    <br>
                    <h4 class="subheading" id="as">Addon Structure</h4>
                        <p class="paragraph">Addon structure is very important when loading your addon. If you do it improperly, your addon will not load and therefore not work. I will do my best to describe how to structure your addon here, but it's probably better to watch the video.</p>
                        <p class="paragraph">First, navigate to where your garrysmod folder is (<i>Usually in Steam\steamapps\common\GarrysMod\garrysmod</i>). In that folder you should see another folder called addons</p>
                        <img src="https://i.driedsponge.net/images/png/1sIid.png" alt="GMOD Directory"></img>
                        <p class="paragraph">This is the folder where all your addons will go (<i>The gma files are just addons from the workshop. You do not need to worry about them</i>). Enter the addons folder and create a new folder. You can name the folder what ever you want.</p>
                        <img src="https://i.driedsponge.net/images/gif/hSnDR.gif" alt="Addon Directory"></img>    
                        <p class="paragraph">This is where every file regarding your addon will go. This includes lua/sound/materials and other items to. In this tutorial, I will only be talking about the lua folder, so go ahead a create that folder.</p>
                        <img src="https://i.driedsponge.net/images/gif/ZYJUb.gif" alt="Lua Directory"></img>
                        <p class="paragraph">In the lua folder, create a folder called autorun. This tells the game to automatically run the code when the script is loaded. You don't always have to use an autorun folder but it's good to use when getting started. Next, create two folders in the autorun folder. One called <i>client</i> and one called <i>server</i>. You will also want to create a lua file called <i>shared.lua</i>.</p>
                        <img src="https://i.driedsponge.net/images/gif/2P1aX.gif" alt="Client/Server Directory"></img>
                        <p class="paragraph">The client folder is where all your client code will go. The server folder is where your server code is stored. The shared.lua is for all of your shared code (<i>If it is neccesary, you can create multiple shared lua files! Also it does not have to be named shared.lua! That is just what I named it.</i>). Finally create a lua file in the client folder named whatever you want and crete a file in the server folder amed whatever you want. File names don't really matter, all that matters in the directory and that it's a lua file.</p>
                        <img src="https://i.driedsponge.net/images/gif/Manbw.gif" alt="Client/Server files"></img>
                        <p class="paragraph">The lua file you put in the client folder will have all your client code. The lua file you put in the server folder will have all of your server code. This marks the end of this segment.</p>
                    <br>
                    <h4 class="subheading" id="f">Functions</h4> 
                    <p class="paragraph">A function is basically a thing that tells the game to do something. As explained in <a href="lua1.php">the first tutorial</a>, there are server, client, and shared functions(See <a href="lua1.php#css">Client/Server/Shared</a>). An example of a functions would be <code>print("hello world")</code>. This tells the server or client to print the string hello world in console.</p>
                    <p class="paragraph">Right now we are going to test this function. In your shared file enter <code>print("hello shared")</code>. It sould look like this:</p>
                    <img src="https://i.driedsponge.net/images/png/3BKVa.png" alt="print functions"></img>
                    <p class="paragraph">To test your code, start up gmod and click start new game.<strong>Make sure you have max players set to at least two</strong>, this is because the server side does not load in single player. Then click start game.</p>
                    <p class="paragraph">To check if your code worked, open console by pressing the tilda key (<i>The key right below the escape key. If this does not work, you might have to enable the devloper console in settings</i>). When you open your console look for  the <code>"hello shared"</code> string.</p>
                    <img src="https://i.driedsponge.net/images/gif/Wr5dz.gif" alt="print functions in console"></img>
                    <p class="paragraph">As you can see it printed twice. Blue means server, yellow means client. You can tell this is shared because it printed once on the server and once on the client! Now that we have our first function out of the way, lets move on to variables. In a futire tutorial I will talk about creating your own functions!</p>
                    <br>
                    <h4 class="subheading" id="dt">Variables</h4>
                    <p class="paragraph">In Lua (<i>and the majority of other coding languages</i>), there are three data types: string, boolean, and number. A string can store any alphanumeric character and most other symbols (<i>ex: !@#$%</i>). Strings are defined using quotes (<i>""</i>). A boolean or bool for short, is a <strong>true</strong> or <strong>false</strong> value. A number is any number obviously (<i>Decimals and negatives are supported!</i>). Below is an example screenshot:</p>
                    <img src="https://i.driedsponge.net/images/png/Sa8iQ.png" alt="datatype example"/>
                    <br>
                    <p class="paragraph">This is the end of my second tutorial!. As always, if anyone needs help the best way to talk to me is in <a href="https://discord.gg/EEPXhqE" target="_blank">my discord server</a>. Have a good day/evening!</p>

                    


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