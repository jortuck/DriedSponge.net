<div class="container-fluid-lg" >
    
        <div class="page-header">
         
            <nav class="navbar navbar-expand-lg navbar-dark nbth ">
                    <a class="navbar-brand" href="/home"><strong>driedsponge.net</strong></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarmain" aria-controls="navbarmain" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars" style="color: black;"></i>
                          </button>
                    <div class="collapse navbar-collapse" id="navbarmain">
                            
                        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                            <li class="nav-item" id="homelink"><a class="nav-link" href="/home/">Home</a></li>
                            <li class="nav-item" id="steam"><a class="nav-link" href="/steam/" target="_blank">Steam Tool</a></li>
                            <li class="nav-item" id="ad"><a class="nav-link" href="/advertise/">Advertise</a></li>
                            <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="MyProjects" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            My Projects
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="MyProjects">
                                             <a class="dropdown-item" href="/projects/web">Web Projects</a>
                                            </div>
                                        </li>
                                <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Other
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="/feedback">Feedback</a>
                                <a class="dropdown-item" href="/contributors">Contributors</a>
                                <a class="dropdown-item" href="/legal/privacy">Privacy Policy</a>
                                </div>
                            </li>
                        </ul>
                        
                        <?php 
                         
                                if(!isset($_SESSION['steamid'])) {
                                loginbutton("rectangle"); //login button

                                }  else {
                                include ('steamauth/userInfo.php'); //To access the $steamprofile array
                                ?>
                                <ul class="navbar-nav  mt-2 mt-lg-0">
                                <li class="nav-item dropdown" style="list-style-type:none;">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" style="color: white;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?=htmlspecialchars($steamprofile['personaname']);?>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="?logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
                                    <?php
                                    if (isAdmin($_SESSION['steamid'])){ 
                                    ?>
                                        <a class="dropdown-item" href="/manage/"><i class="fas fa-cog"></i></i> Management</a>                                  
                                    <?php
                                    }
                                    ?>
                                </div>
                            </li>
                                </ul>
                        </div>
                                <?php 
                                    } ?>
                        
                        
                  </nav>

        </div>
    </div>