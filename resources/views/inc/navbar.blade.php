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
                        <li class="nav-item" id="ad"><a class="nav-link" href="/advertise/">Advertise</a></li>
                        <li  id="projectslink" class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="MyProjects" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        My Projects
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="MyProjects">
                                         <a class="dropdown-item" href="/web-projects">Web Projects</a>
                                        </div>
                                </li>
                            <li id='otherlink' class="nav-item dropdown">
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
                        @auth
                            <ul class="navbar-nav  mt-2 mt-lg-0">
                            <li class="nav-item dropdown" style="list-style-type:none;">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" style="color: white;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{Auth::user()->username}}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="/logout/"><i class="fas fa-sign-out-alt"></i> Logout</a>
                            </div>
                            </li>
                            </ul>
                        @endauth
                        @guest
                        <a href="/login/"><img src="https://steamcommunity-a.akamaihd.net/public/images/signinthroughsteam/sits_01.png"></a>
                        @endguest
                    </div>
                    
                    
              </nav>

    </div>
</div>