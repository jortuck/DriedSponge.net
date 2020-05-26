<div class="container-fluid-lg" >
    <div class="page-header">
        <nav class="navbar navbar-expand-lg navbar-dark nbth ">
                <a class="navbar-brand" href="/manage/">Management</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarmain" aria-controls="navbarmain" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars" style="color: black;"></i>
                      </button>
                <div class="collapse navbar-collapse" id="navbarmain">
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                        <li class="nav-item" id="dashlink"><a class="nav-link" href="/manage/">Dashboard</a></li>
                        <li  id="adminlink" class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="AdministrationDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Administration
                            </a>
                            <div class="dropdown-menu" aria-labelledby="UsersDropdown">
                                 <a class="dropdown-item" href="/manage/roles">Roles</a>
                                 <a class="dropdown-item" href="/manage/permissions">Permissions</a>
                            </div>
                        </li>
                        <li  id="userlink" class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="UsersDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Users
                            </a>
                            <div class="dropdown-menu" aria-labelledby="UsersDropdown">
                                 <a class="dropdown-item" href="/web-projects">Manage All Users</a>
                                 <a class="dropdown-item" href="/web-projects">Bans</a>
                            </div>
                        </li>
                        <li class="nav-item" id="homelink"><a class="nav-link" href="/home/">Exit Management</a></li>
                    </ul>
                        @auth
                            <ul class="navbar-nav  mt-2 mt-lg-0">
                            <li class="nav-item dropdown" style="list-style-type:none;">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" style="color: white;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{Auth::user()->username}}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="/logout/"><i class="fas fa-sign-out-alt"></i> Logout</a>
                                <a class="dropdown-item" href="/home/"><i class="fas fa-home"></i> Exit Management</a>

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