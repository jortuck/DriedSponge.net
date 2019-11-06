<!DOCTYPE html>


<html>
    <head>
        
        
        <meta name="description" content="Welcome to my third lua tutorial! In this tutorial we will be covering the following:">
        <meta name="keywords" content="lua custom checks, lua if then, dredisponge.net lua tutorial, lua and, lua or, lua and or">
        <meta name="author" content="Jordan Tucker">
        <meta property="og:site_name" content="DriedSponge.net | Lua Tutorial 3 - if/then/and/or" />
        
        <title>Lua Tutorial 3 - if/then/and/or</title>
        <script src="https://kit.fontawesome.com/0add82e87e.js" crossorigin="anonymous"></script>
    </head>

 <body>
        

    <div class="app">
    <div class="container-fluid-lg" style="padding-top: 80px;">

        
            <div class="container">
               
                    <hgroup>
                        <h2><strong><a href="index.php">Tutorials</a> &gt; Lua Tutorial 3 - if/then/and/or</strong></h2>
                        <h5><span class="badge badge-danger">Everything in this tutorial is done asuming you read <a style="color: white; text-decoration: underline;" href="lua.php?page=2">tutorial 2</a>.</span></h5>
                        <br>
                    </hgroup>
                    <p class="paragraph">Welcome to my third lua tutorial! In this tutorial we will be covering the following:</p>
                    <ul class="paragraph">
                            <li><a href="#h">Hooks</a></li>
                            <li><a href="#i">if then statements</a></li>
                            <li><a href="#a">and/or statements</a></li>
                        </ul>
                    <h4 class="subheading">Video:</h4>  
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/h2qyMIxIA2o" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <br>


                    <h4 class="subheading" id="h">Hooks</h4>
                        <p class="paragraph">OK, the first thing you need to know about hooks is that they are epic! They allow you to run a function when something else happens. In this tutorial, I'm gonna be using the <a href="https://wiki.garrysmod.com/page/GM/PlayerSay" target="_blank">PlayerSay</a> hook.</p>
                        <p class="paragraph">First we need to set up the hook, so go back and open up the server.lua file we created in <a href="lua.php?page=2#as">tutorial 2</a>. We want to put this hook in the server file because acording to the <a target="_blank" href="https://wiki.garrysmod.com/">wiki</a>, it's a server side hook (<i>which means it only works server side</i>).</p>
                        <p class="paragraph">To add the hook, you need to use the <a href="https://wiki.garrysmod.com/page/hook/Add">hook.Add</a> function. This is how you would add it into your code:</p>
                        <img src="https://i.driedsponge.net/images/png/I3VFD.png" alt="hook.add example"/>
                        <p class="paragraph">Now you have your hook. Any function you put inside the hook will be ran when the player says something in chat because the hook is <a href="https://wiki.garrysmod.com/page/GM/PlayerSay" target="_blank">PlayerSay</a>. In the hook function, ply is the entity that chatted, text is what they said, and team is whether they said it in team chat or not. Remember: The functions you put in the hook have to be server side because the hook is server side. The client side version of this hook is <a href="https://wiki.garrysmod.com/page/GM/OnPlayerChat" target="_blank">OnPlayerChat</a>. You would use the client side hoook if you wanted to have a menu open when the player said a specific command, for example, !menu.</p>
                        <p class="paragraph">Ok now lets make this hook do something. I want it to log the players SteamID64 and what they said to the server console so I'm gonna add my print function.</p>
                        <img src="https://i.driedsponge.net/images/png/AluHb.png" alt="hook with print example"/>
                        <p class="paragraph">Here is what every thing does:</p>
                        <ul class="paragraph">
                            <li><code>ply:Get:SteamID64()</code> will return the SteamID64 of the entity, in this case its the player that chatted. If the entity is a bot it will return nil.</li>
                            <li><code>text</code> is the string of whatever the player said.</li>
                        </ul>
                        <p class="paragraph">To test your code, start your game and say something in chat. It should return the following:</p>
                        <img src="https://i.driedsponge.net/images/png/TRWBN.png" alt="hook return" />







                    <br>
                    
                    


</div>
</div>
</div> 

<!-- end of app -->



                
                <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/popper.js@1"></script>
        <script src="https://unpkg.com/tippy.js@4"></script>
       
 </body>






</html>