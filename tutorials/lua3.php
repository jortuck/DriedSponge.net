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
                            <li><a href="#i">if/then statements</a></li>
                            <li><a href="#a">and/or statements</a></li>
                        </ul>
                    <h4 class="subheading">Video:</h4>  
                    <p class="paragraph" style="text-align: center;"><iframe width="560" height="315" src="https://www.youtube.com/embed/nVYZvn-vanw" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></p>           
                        <br>


                    <h4 class="subheading" id="h">Hooks</h4>
                        <p class="paragraph">OK, the first thing you need to know about hooks is that they are epic! They allow you to run a function when something else happens. In this tutorial, I'm gonna be using the <a href="https://wiki.garrysmod.com/page/GM/PlayerSay" target="_blank">PlayerSay</a> hook.</p>
                        <p class="paragraph">First we need to set up the hook, so go back and open up the server.lua file we created in <a href="lua.php?page=2#as">tutorial 2</a>. We want to put this hook in the server file because according to the <a target="_blank" href="https://wiki.garrysmod.com/">wiki</a>, it's a server side hook (<i>which means it only works server side</i>).</p>
                        <p class="paragraph">To add the hook, you need to use the <a href="https://wiki.garrysmod.com/page/hook/Add">hook.Add</a> function. This is how you would add it into your code:</p>
                        <img src="https://i.driedsponge.net/images/png/I3VFD.png" alt="hook.add example"/>
                        <p class="paragraph">Now you have your hook. Any function you put inside the hook will be ran when the player says something in chat because the hook is <a href="https://wiki.garrysmod.com/page/GM/PlayerSay" target="_blank">PlayerSay</a>. In the hook function, <i>ply</i> is the entity that chatted, <i>text</i> is what the entity said (string), and <i>team</i> is whether they said it in team chat or not (boolean). Remember: The functions you put in the hook have to be server side because the hook is server side. The client side version of this hook is <a href="https://wiki.garrysmod.com/page/GM/OnPlayerChat" target="_blank">OnPlayerChat</a>.</p>
                        <p class="paragraph">Ok now let's make this hook do something. I want it to log the players SteamID64 and what they said to the server console so I'm gonna add my print function.</p>
                        <img src="https://i.driedsponge.net/images/png/AluHb.png" alt="hook with print example"/>
                        <p class="paragraph">Here is what everything does:</p>
                        <ul class="paragraph">
                            <li><code>ply:Get:<a href="https://wiki.garrysmod.com/page/Player/SteamID64" target="_blank">SteamID64()</a></code> will return the SteamID64 of the entity, in this case it's the player that chatted. If the entity is a bot it will return 90071996842377216.</li>
                            <li><code>text</code> is the string of whatever the player said.</li>
                        </ul>
                        <p class="paragraph">To test your code, start your game and say something in chat. It should return the following:</p>
                        <img src="https://i.driedsponge.net/images/png/TRWBN.png" alt="hook return" />
                        <p class="paragraph">Hooks can be very useful when trying to create a variety of things. We're now gonna make are hook more complex by adding if/then statements. In the future, I will talk about more advanced hooks and creating your own hooks!</p>
                        <br>
                        <h4 class="subheading" id="i">if/then statements</h4>
                        <p class="paragraph">If then statements, or custom checks, allow you to trigger a function based on whether a boolean is true or false. If the boolean is true, then it will trigger the function that comes after the then. If the boolean is false, then it will do nothing, or you can set up an else statement that determines what the if/then does if the given value is false.</p>
                        <p class="paragraph">There are multiple operators you can use in if then statement:</p>
                        <ul class="paragraph">
                            <li><code>==</code> - This is equal to. For example: <code>poo == poo</code>. This would return true because poo does equal poo!</li>
                            <li><code>~=</code> or <code>!=</code> - This is not equal to. For example: <code>poo ~= poo</code>. This would return false because poo is equal to poo. If it was <code>poo ~= pee</code> then it would be true because poo is in fact not equal to pee.</li>
                            <li><code>&gt;</code> - This is greater than. If you took any basic math class in the course of your life you should know what this means. The syntax is <code>12 &gt; 11</code>. This would return true because 12 is greater than 11.</li>
                            <li><code>&lt;</code> - This is less than. The syntax is <code>11 &lt; 12</code>. This would return true because 11 is less than 12.</li>
                            <li>There is also <code>&gt;=</code> and <code>&lt;=</code>. I'm going to assume you know what these mean because it's pretty self explanatory.</li>
                        </ul>
                        <p class="paragraph">Also keep this quote in mind when using these operators.</p>
                            <p class="paragraph"><cite>
                            When comparing values with different types, you must be careful: Remember that "0"==0 is false. Moreover, 2&lt;15 is obviously true, but "2"&lt;"15" is false (alphabetical order!). To avoid inconsistent results, Lua raises an error when you mix strings and numbers in an order comparison, such as 2&lt;"15".
                            <br>
                            - <a href="https://www.lua.org/pil/3.2.html" target="_blank">lua.org 3.2 – Relational Operators</a>
                            </cite></p>
                            <p class="paragraph">Alright, now let's talk about actually forming our if then statement. I want to check to see if the player said Hello. It should look like this.</p>
                            <img src="https://i.driedsponge.net/images/png/MSAwv.png" alt="if then statement" />
                            <p class="paragraph">Alright, now enter your game and say something in chat. It should return the following values:</p>
                            <img src="https://i.driedsponge.net/images/png/6IAGz.png" alt="if then statement RETURN" />
                            <p class="paragraph">Now, I want to punish the player for saying hello, so I will change <code><a href="https://wiki.garrysmod.com/page/Global/print" target="_blank">print</a>("Server: "..ply:<a href="https://wiki.garrysmod.com/page/Player/SteamID64" target="_blank">SteamID64()</a>.." said "..text)</code> to <code>ply:<a href="https://wiki.garrysmod.com/page/Player/Kill" target="_blank">Kill()</a></code>. This will tell the server to kill me or any other user when they send "hello" in chat.</p>
                            <p class="paragraph">You should notice that if you say hello in chat, you will die, and if you say something else it will print "The player did not say hi" to the server console.</p>
                            <p class="paragraph">Also, you can do checks on variables like this:</p>
                            <img src="https://i.driedsponge.net/images/png/xLhvy.png" alt="checks on variables" />
                            <p class="paragraph">Now that you have an understnading of if/then statements, lets move on to and/or statements.</p>
                            <h5><span class="badge badge-primary">Keep in mind: if/then statments work outside of hooks.</span></h5>
                            <br>
                            <h4 class="subheading" id="a">and/or statements</h4>
                            <p class="paragraph">And/or statements make it really easy to perform multiple if then statement checks. Instead of having multiple if/then statements, you can have one if/the statement that uses and/or statements. For example, if the player said hello <strong>and</strong>  has 100 health at the same time, then kill them (<a href="https://wiki.garrysmod.com/page/Entity/Health" target="_blank">Health function</a>). Your syntax should look like this:</p>
                            <img src="https://i.driedsponge.net/images/png/VPcRw.png" alt="and example" />
                            <p class="paragraph">If you have 100 health <strong>and</strong> you said "hello" in chat then you will die, otherwise it will print "The player did not say hi" because of the else statement.</p>
                            <p class="paragraph">Or statements are very similar to and statements. As we stated earlier, and statements only run the function if the player as both checks, or statements only require one of the checks to be passed.</p>
                            <img src="https://i.driedsponge.net/images/png/hPG7U.png" alt="or example" />
                            <p class="paragraph">Because this is an or statements, you might notice you'll die when you say something other than "hello". This is because you have 100 health. It does not care about what you said in chat, if you have 100 health you will die. If you don't want to die, switch the <strong>or</strong> to an <strong>and</strong>. Then you will only die if you say "hello" <strong>and</strong> you have 100 health.</p>
                            <p class="paragraph">Another thing to keep in mind is that you can use and/or statements consecutively, like this:</p>
                            <ul class="paragraph">
                                <li><code>if ply:<a href="https://wiki.garrysmod.com/page/Player/SteamID64" target="_blank">SteamID64()</a> == "76561198357728256" and ply:<a href="https://wiki.garrysmod.com/page/Player/Name" target="_blank">Name()</a> == "DriedSponge" and ply:<a href="https://wiki.garrysmod.com/page/Entity/Health" target="_blank">Health()</a> == 100 then ...</code> - Just keep adding ands and the function will trigger if the player passes all of the checks</li>
                                <li><code>if ply:<a href="https://wiki.garrysmod.com/page/Player/SteamID64" target="_blank">SteamID64()</a> == "76561198357728256" or ply:<a href="https://wiki.garrysmod.com/page/Player/Name" target="_blank">Name()</a> == "DriedSponge" or ply:<a href="https://wiki.garrysmod.com/page/Entity/Health" target="_blank">Health()</a> == 100 then ...</code> - some like this means if this, this, or this applies to you then you pass the check.</li>
                            </ul>
                            <p class="paragraph">The last cool thing you can do with and/or statements is combine them like this:</p>
                            <img src="https://i.driedsponge.net/images/png/AzaPb.png" alt="combined and or" />
                            <p class="paragraph">The last important thing I need to note about and/or statements is that you can combine them in any way you want. The samples I showed you were just examples.</p>
                            <br>
                            <p class="paragraph">This marks the end of my third  tutorial. If something in it doesn't make sense to you please let know in <a href="https://driedsponge.net/discord" target="_blank">my discord server</a>. Have a good day/evening!</p>
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