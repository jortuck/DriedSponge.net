
<!DOCTYPE html>


<html>
    <head>
<!--         Site created: 9/19/19
        Author: DriedSponge(Jordan Tucker) -->
        
        <meta name="description" content="Need to look something up about a user on steam? Do it here! Use any SteamID or profile URL to look up information! If the user you're searching for has a GmodStore profile, their GMS info will show up too!" />
        <meta name="keywords" content="driedsponge.net, SteamID finder, SteamID, SteamAPI, Steam users, SteamID search, steam convert, steamid converter, steamurl converter, steam converter, SteamID64, SteamID3, steam profile lookup" />
        <meta name="author" content="Jordan Tucker" />
        
        <meta property="og:site_name" content="DriedSponge.net | Steam ID Tool" />
        <?php 
            include("views/includes/meta.php"); 
            ?>
            
        <title>Steam ID Tool</title>
        <script src="https://kit.fontawesome.com/0add82e87e.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href = "//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" type="text/css" >
        <link rel="stylesheet" type="text/css" href="<?=v(url());?>css/steam.css" />
    </head>
    
 <body>

     <div class="app">
    <div class="container-fluid-lg" style="padding-top:30px;">

        
            <div class="container">
               
                    <hgroup>
                            <!-- <img src="https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/18/18be38c2f230fea0fa667c8165e4da5cb1a787c0_full.jpg" alt="DriedSponge's Profile Picture"> -->
                            <h1 class="display-2">SteamID Tool</h1>
                        <br>
                    </hgroup>
                    <p class="paragraph pintro">Need to look something up about a user on steam? Do it here! Use any SteamID or profile URL to look up information! If the user you're searching for has a GmodStore profile, their GMS info will show up too!</p>
                    <br>
                    
                    <?php
                    
                    include("views/includes/search.php");
                        ?>
                    <?php
                    if(isset($_SESSION['steamid'])) {
                        include ('steamauth/userInfo.php');
                        ?>

                    <div class="text-center">
                    <p class="paragraph"><a href="?logout">Logout</a></p>
                    <h2><img style="border-radius: 1em;box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.30), 0 8px 22px 0 rgba(0, 0, 0, 0.30);max-width: 150px;" src="<?=htmlspecialchars($steamprofile['avatarfull']);?>"/></h2>
                    <br>
                    <h1>Your data</h1>
                    </div>
                    <br>
                    <table class="table paragraph table-dark text-center">
                        <script>
                            $(document).ready(function(){
                                $("#userinfo").removeClass("d-none")
                                $("#loading").hide()
                            })
                        </script>
                        <div id="loading"><div class="text-center"><div class="spinner-border text-primary " role="status"><span class="sr-only">Loading...</span></div><br><p class="paragraph"><b>Loading...</b></p></div></div>
                        <tbody id="userinfo" class="d-none">
                        <?php 
                        include("views/includes/SteamID.php");
                        $sids= new SteamID($steamprofile['steamid']);
                        

                          $info = array(
                            array("Username",$steamprofile['personaname'],false),
                            array("SteamID64",$steamprofile['steamid'],false),
                            array("SteamID",$sids->RenderSteam2() . PHP_EOL,false),
                            array("SteamID3",$sids->RenderSteam3() . PHP_EOL,false),
                            array("Profile URL",$steamprofile['profileurl'],true),
                            array("Name",$steamprofile['realname'],false)                            
                          );
                          $gmsinfo = GMSInfo($steamprofile['steamid']);
                          if(isset($gmsinfo['name'])){
                            array_push($info,
                                array("GmodStore Name", $gmsinfo['name'],false),
                                array("GmodStore URL", $gmsinfo['slug'],true)
                            );
                          }
                          foreach ($info as $value) {
                           
                          if(!$value[2]){

                          
                        ?>
                    
                        <tr>
                        <th scope="row"><?=htmlspecialchars($value[0]);?></th>
                        <td><?=htmlspecialchars($value[1]);?></td>
                        <td><button  onclick="copything('<?=htmlspecialchars($value[1]);?>')" class="btn btn-primary"><i class="far fa-copy"> Copy</i></button></td>
                        </tr>
                    <?php
                    }else{
                        ?>
                        <tr>
                        <th scope="row"><?=htmlspecialchars($value[0]);?></th>
                        <td><a target="_blank" href="<?=htmlspecialchars($value[1]);?>"><?=htmlspecialchars($value[1]);?></a></td>
                        <td><button  onclick="copything('<?=htmlspecialchars($value[1]);?>')" class="btn btn-primary"><i class="far fa-copy"> Copy</i></button></td>
                        </tr>
                        <?php
                    }
                        }
                    ?>
                    </tbody>
                    </table>
                    

                        <?php
                        
                    }else{
                        ?>
                        <h1 class="articleh1">Login to see your own info</h1>
                    <br>
                    <p style="text-align: center;"><a href='?login'><img src='https://steamcommunity-a.akamaihd.net/public/images/signinthroughsteam/sits_02.png'></a></p>
                            <?php
                    }
                    



                    ?>
                    

                        </div>
</div>
</div> 
<!-- End of "app" -->
<br>
<footer class="text-center">
        

            <p style="font-size: 1.3em;"><b>Copyright © 2020 DriedSponge.net</b></p>

  
</footer>




                
                <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> 
        <script src="https://unpkg.com/popper.js@1"></script>
        <script src="https://unpkg.com/tippy.js@4"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
        <script src="main.js"></script> 
        <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        <script>
                    navitem = document.getElementById('steam').classList.add('active')
                    
                </script>
                <script>
                        function  copything(value){
                          
              
                          navigator.clipboard.writeText(value)
                          
                         toastr["success"](value + " was successfully copied to clipboard", "Congratulations!")
              
                         toastr.options = {
                              "closeButton": true,
                              "debug": false,
                              "newestOnTop": false,
                              "progressBar": true,
                              "positionClass": "toast-top-right",
                              "preventDuplicates": true,
                              "onclick": null,
                              "showDuration": "300",
                              "hideDuration": "1000",
                              "timeOut": "5000",
                              "extendedTimeOut": "1000",
                              "showEasing": "swing",
                              "hideEasing": "linear",
                              "showMethod": "fadeIn",
                              "hideMethod": "fadeOut"
                              }
                        }
              
              
                      </script>
 </body>






</html>