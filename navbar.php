
<div class="container-fluid-lg" >
    
        <div class="page-header">
         
            <nav class="navbar navbar-expand-lg navbar-dark nbth fixed-top">
                    <a class="navbar-brand" href="https://driedsponge.net"><strong>driedsponge.net</strong></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarmain" aria-controls="navbarmain" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars" style="color: black;"></i>
                          </button>
                    <div class="collapse navbar-collapse" id="navbarmain">
                            
                        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                            <li class="nav-item" id="homelink"><a class="nav-link" href="index.php">Home</a></li>
                            <li class="nav-item" id="tut"><a class="nav-link" href="tutorials/index.php">Coding Tutorials</a></li>
                            <li class="nav-item" id="steam"><a class="nav-link" href="steam.php">Steam Tool</a></li>
                            <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="MyProjects" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            My Projects
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="MyProjects">
                                             <a class="dropdown-item" href="webdesign.php">Web Projects</a>
                                            <a  class="dropdown-item" href="lua.php">Lua Projects</a>
                                            </div>
                                        </li>
                                <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Other
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="feedback.php">Feedback</a>
                                <a class="dropdown-item" href="contributors.php">Contributors</a>
                                <a class="dropdown-item" href="privacy.php">Privacy Policy</a>
                                </div>
                            </li>
                        </ul>
                        
                        <?php 
                         
                                if(!isset($_SESSION['steamid'])) {
                                loginbutton("rectangle"); //login button

                                }  else {
                                include ('steamauth/userInfo.php'); //To access the $steamprofile array
                                ?>
                                <li class="nav-item dropdown" style="list-style-type:none;">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php echo $steamprofile['personaname']; ?>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="?logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
                                    <?php
                                     if($_SESSION['steamid'] == "76561198357728256"){
                                    ?>
                                        <a class="dropdown-item" href="manage.php"><i class="fas fa-cog"></i></i> Management</a>                                  
                                    <?php
                                    }
                                    ?>
                                </div>
                            </li>
                        </div>
                                <?php 
                                    } ?>
                        
                        
                  </nav>

        </div>
    </div>