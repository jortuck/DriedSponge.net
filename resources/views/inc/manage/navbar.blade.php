<header>
  <ul id='left-nav' class="sidenav sidenav-fixed" style="width: 250px;">
      <li>
          <div class="user-view shadowed">
              <div class="background">

                  <img id='user-bg-img' src="@if(Cookie::get('theme') == 'dark')  https://i.driedsponge.net/images/png/sb7Po.png @else https://i.driedsponge.net/images/png/SiB6Y.png @endif" alt="Background image">
              </div>
              @guest
                  <a href="{{route('login')}}"><img alt="sign in with steam" src="https://steamcommunity-a.akamaihd.net/public/images/signinthroughsteam/sits_01.png"></a>
              @endguest
              @auth
              <img id="avatar" alt="Your avatar" src="{{Auth::user()->avatar}}" >
              <br>
              <span id="name">{{Auth::user()->username}}</span>
              <span>{{Auth::user()->steamid}}</span>
              @endauth

          </div>
      </li>
      <li><a class="waves-effect" href="{{route('manage.index')}}"><i class="material-icons">dashboard</i>Dashboard</a></li>
      <li> <div class="divider"></div></li>
       <li><a class="subheader">Users</a></li>
      <li><a class="waves-effect" href="/manage/users/"><i class="material-icons">people</i>Users</a></li>
      <li><a class="waves-effect" href="/manage/bans"><i class="material-icons">block</i>Bans</a></li>
      <li> <div class="divider"></div></li>
       <li><a class="subheader">Administration</a></li>
      <li id='roleslink'><a class="waves-effect" href="{{route('roles.index')}}"><i class="material-icons">assignment_ind</i>Roles</a></li>
      <li><a class="waves-effect" href="{{route('permissions.index')}}"><i class="material-icons">security</i>Permissions</a></li>
      <li> <div class="divider"></div></li>
      <li><a href="{{route('pages.index')}}"><i class="material-icons">home</i>Return Home</a></li>
      @auth
      <li><a href="{{route('logout')}}"><i class="material-icons">exit_to_app</i>Logout</a></li>
      @endauth
      <li><a><button class="btn waves-effect waves-light " onclick="ToggleDarkTheme()">Toggle Dark Theme</button></a></li>
  </ul>
  <script>
      function ToggleDarkTheme(){
          let curtheme = getCookie('theme');
          if(curtheme === "dark"){
            $('#dark-theme-css').attr('href',' ')
            $('#user-bg-img').attr('src','https://i.driedsponge.net/images/png/SiB6Y.png')
              document.cookie = 'theme=light';
          }else{
            $('#user-bg-img').attr('src','https://i.driedsponge.net/images/png/sb7Po.png')
            $('#dark-theme-css').attr('href','/css/dark.css')
              document.cookie = 'theme=dark';
          }
      }
  </script>
  <a href="#" data-target="left-nav" class="sidenav-trigger" id="left-nav-btn"><i class="material-icons" style="color: white">menu</i></a>
</header>
