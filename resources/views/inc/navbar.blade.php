@auth
    <ul id="dropdown1" class="dropdown-content">
        <li><a href="{{route('logout')}}"><i class="material-icons">exit_to_app</i> Logout</a></li>
        @can('manage.see')
            <li><a href="{{route('manage.index')}}"><i class="material-icons">dashboard</i> Management</a></li>
        @endcan
    </ul>
@endauth
<nav>
    <div class="nav-wrapper">
        <div class="container">
            <div>
                <a href="{{route('pages.index')}}" class="brand-logo"><div class="valign-wrapper" style="margin: 5px 0px"><img alt="logo" class="lozad hide-on-med-and-down" id="img" data-src="https://cdn.driedsponge.net/img/logo/logo-square.webp"><span id="navtxt">Dried <span class="white-text">Sponge</span></span></div></a>
                <a href="#" data-target="mobilenav" class="sidenav-trigger text-white"><i class="material-icons">menu</i></a>
            </div>
            <ul class="right hide-on-med-and-down">
                <li><a href="{{route('pages.index')}}">Projects</a></li>
                <li><a href="{{route('pages.index')}}">Advertise</a></li>
                @guest
                    <li><a href="{{route('login')}}"><img style="vertical-align:middle" class="lozad responsive-img"
                                                          alt="sign in with steam"
                                                          data-src="https://cdn.driedsponge.net/img/login/steam_01.webp"></a>
                    </li>
                @endguest
                @auth
                <!-- Dropdown Trigger -->
                    <li><a class="dropdown-trigger" href="#!" data-target="dropdown1">
                            <div class="chip chip-profile">
                                <img src="{{Auth::user()->avatar}}" alt="Your Avatar">
                                <span style="color:white !important;"><b>{{Auth::user()->username}}</b></span>
                            </div>
                            <i class="material-icons right" style="padding-left: 0;margin-left: 0">arrow_drop_down</i>
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

                <img id='user-bg-img'
                     class="lozad"
                     data-src="@if(Cookie::get('theme') == 'dark')  https://cdn.driedsponge.net/img/nav/dark_sidenav_bg.webp @else https://cdn.driedsponge.net/img/nav/light_sidenav_bg.webp @endif"
                     alt="Background image">
            </div>
            @guest
                <a href="{{route('login')}}"><img class="lozad" alt="sign in with steam"
                                                   data-src="https://cdn.driedsponge.net/img/login/steam_01.webp"></a>
            @endguest
            @auth
                <img id="avatar" alt="Your avatar" src="{{Auth::user()->avatar}}">
                <br>
                <span id="name">{{Auth::user()->username}}</span>
                <span>{{Auth::user()->steamid}}</span>
            @endauth
        </div>
    </li>
    <li><a href="#!"><i class="material-icons">cloud</i>First Link With Icon</a></li>
    <li><a href="#!">Second Link</a></li>
    <li>
        <div class="divider"></div>
    </li>
    <li><a class="subheader">Subheader</a></li>
    <li><a class="waves-effect" href="#!">Third Link With Waves</a></li>
</ul>
