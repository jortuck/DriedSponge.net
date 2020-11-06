@auth
    <ul id="dropdown1" class="dropdown-content">
        <li><a href="{{route('logout')}}"><i class="material-icons">exit_to_app</i> Logout</a></li>
        @can('Manage.See')
            <li><a href="{{route('manage.index')}}"><i class="material-icons">dashboard</i> Management</a></li>
        @endcan
    </ul>
@endauth
<nav>
    <div class="nav-wrapper">
        <div class="container">
            <div>
                <a href="{{route('pages.index')}}" class="brand-logo hide-on-med-and-down">
                    <div class="valign-wrapper logo-wrapper"><img alt="logo" class="hide-on-med-and-down" id="img"
                                                                  src="https://cdn.driedsponge.net/img/logo/logo-square.webp"><span
                            id="navtxt">Dried <span class="white-text">Sponge</span></span></div>
                </a>
                <a href="{{route('pages.index')}}" class="brand-logo hide-on-med-and-up show-on-medium-and-down"><span
                        id="navtxt-mobile">Dried <span class="white-text">Sponge</span></span></a>
                <a href="#" data-target="mobilenav" class="sidenav-trigger text-white"><i
                        class="material-icons">menu</i></a>
            </div>
            <ul class="right hide-on-med-and-down">
                <li><a href="{{route('pages.projects')}}">Projects</a></li>
                {{--                <li><a href="{{route('pages.index')}}">Advertise</a></li>--}}
                @guest
                    <li><a href="{{route('login')}}"><img class="responsive-img nav-login-img"
                                                          alt="sign in with steam"
                                                          src="https://cdn.driedsponge.net/img/login/steam_01.webp"></a>
                    </li>
                @endguest
                @auth
                <!-- Dropdown Trigger -->
                    <li><a class="dropdown-trigger" href="#!" data-target="dropdown1">
                            <div class="chip chip-profile">
                                <img src="{{Auth::user()->avatar}}" alt="Your Avatar">
                                <span class="white-text"><b>{{Auth::user()->username}}</b></span>
                            </div>
                            <i class="material-icons right nav-drop-arrow-right">arrow_drop_down</i>
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
<ul id="mobilenav" class="mobile sidenav">
    <li>
        <div class="user-view shadowed">
            <div class="background">
                <img id='user-bg-img' src="https://cdn.driedsponge.net/img/nav/dark_sidenav_bg.webp"
                     alt="Background image">
            </div>
            @guest
                <a href="{{route('login')}}"><img alt="sign in with steam"
                                                  src="https://cdn.driedsponge.net/img/login/steam_01.webp"></a>
            @endguest
            @auth
                <img id="avatar" alt="Your avatar" src="{{Auth::user()->avatar}}">
                <br>
                <span id="name">{{Auth::user()->username}}</span>
                <span>{{Auth::user()->steamid}}</span>
            @endauth
        </div>
    </li>
    <li><a class="subheader">General</a></li>
    <li><a class="waves-effect" href="{{route('pages.projects')}}"><i class="material-icons">developer_board</i>Projects</a>
    </li>
    {{--    <li><a class="waves-effect" href="#!"><i class="material-icons">open_in_browser</i>Advertise</a></li>--}}
    @auth
        <li>
            <div class="divider"></div>
        </li>
        <li><a class="subheader">Account</a></li>
        <li><a class="waves-effect" href="/logout/"><i class="material-icons">exit_to_app</i>Logout</a></li>
        @can('Manage.See')
            <li><a href="{{route('manage.index')}}"><i class="material-icons">dashboard</i> Management</a></li>
        @endcan
    @endauth
</ul>
