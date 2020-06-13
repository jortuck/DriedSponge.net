<header>
    <ul id='left-nav' class="sidenav sidenav-fixed" style="width: 250px;">
        <li>
            <div class="user-view shadowed">
                <div class="background">

                    <img id='user-bg-img'
                         class="lozad"
                         data-src="@if(Cookie::get('theme') == 'dark')  https://cdn.driedsponge.net/img/nav/dark_sidenav_bg.webp @else https://cdn.driedsponge.net/img/nav/light_sidenav_bg.webp @endif"
                         alt="Background image">
                </div>
                @guest
                    <a href="{{route('login')}}"><img alt="sign in with steam"
                                                      class="lozad"

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
        <li><a class="waves-effect" href="{{route('manage.index')}}"><i
                    class="material-icons">dashboard</i>Dashboard</a></li>
        <li>
            <div class="divider"></div>
        </li>
        <li><a class="subheader">Users</a></li>
        <li><a class="waves-effect" href="/manage/users/"><i class="material-icons">people</i>Users</a></li>
        <li><a class="waves-effect" href="/manage/bans"><i class="material-icons">block</i>Bans</a></li>
        <li>
            <div class="divider"></div>
        </li>
        <li><a class="subheader">Administration</a></li>
        <li id='roleslink'><a class="waves-effect" href="{{route('roles.index')}}"><i class="material-icons">assignment_ind</i>Roles</a>
        </li>
        <li><a class="waves-effect" href="{{route('permissions.index')}}"><i class="material-icons">security</i>Permissions</a>
        </li>
        <li>
            <div class="divider"></div>
        </li>
        <li><a href="{{route('pages.index')}}"><i class="material-icons">home</i>Return Home</a></li>
        @auth
            <li><a href="{{route('logout')}}"><i class="material-icons">exit_to_app</i>Logout</a></li>
        @endauth
        <li><a>
                <button class="btn waves-effect waves-light " id="theme-toggle">Toggle Dark Theme</button>
            </a></li>
    </ul>
    <a href="#" data-target="left-nav" class="sidenav-trigger" id="left-nav-btn"><i class="material-icons"
                                                                                    style="color: white">menu</i></a>
</header>
