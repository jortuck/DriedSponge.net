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

                <a href="{{route('pages.index')}}" class="brand-logo">DriedSponge.net</a>
                <a href="#" data-target="mobilenav" class="sidenav-trigger text-white"><i
                        class="material-icons">menu</i></a>
            </div>
            <ul class="right hide-on-med-and-down">
                <li><a href="{{route('pages.index')}}">Projects</a></li>
                <li><a href="{{route('pages.index')}}">Advertise</a></li>
                @guest
                    <li><a href="{{route('login')}}"><img style="vertical-align:middle" class="lozad responsive-img"
                                                          alt="sign in with steam"
                                                          data-src="https://steamcommunity-a.akamaihd.net/public/images/signinthroughsteam/sits_01.png"></a>
                    </li>
                @endguest
                @auth
                <!-- Dropdown Trigger -->
                    <li><a class="dropdown-trigger" href="#!" data-target="dropdown1">
                            <div
                                style="background-color: rgba(0,0,0,0); padding-right: 0;margin-right: 0; font-weight: normal; font-size: 1rem"
                                class="chip">
                                <img src="{{Auth::user()->avatar}}" alt="Your Avatar">
                                <span style="color:black !important;"
                                      class="text-black">{{Auth::user()->username}}</span>
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
                     src="@if(Cookie::get('theme') == 'dark')  https://i.driedsponge.net/images/png/sb7Po.png @else https://i.driedsponge.net/images/png/SiB6Y.png @endif"
                     alt="Background image">
            </div>
            @guest
                <a href="{{route('login')}}"><img alt="sign in with steam"
                                                  src="https://steamcommunity-a.akamaihd.net/public/images/signinthroughsteam/sits_01.png"></a>
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
