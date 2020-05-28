  <header>
  <ul id='left-nav' class="sidenav sidenav-fixed" style="width: 250px;">
      <li>
          <div class="user-view shadowed">
              <div class="background">
                  <img id='user-bg-img' src="https://i.driedsponge.net/images/png/sb7Po.png">
              </div>
              <img id="avatar" src="{{Auth::user()->avatar}}"><br>
              <span id="name">{{Auth::user()->username}}</span>
              <span>{{Auth::user()->steamid}}</span>
          </div>
      </li>
      <li><a class="waves-effect" href="/manage/"><i class="material-icons">dashboard</i>Dashboard</a></li>
      <li> <div class="divider"></div></li>
       <li><a class="subheader">Users</a></li>
      <li><a class="waves-effect" href="/manage/users/"><i class="material-icons">people</i>Users</a></li>
      <li><a class="waves-effect" href="/manage/bans"><i class="material-icons">block</i>Bans</a></li>
      <li> <div class="divider"></div></li>
       <li><a class="subheader">Administration</a></li> 
      <li id='roleslink'><a class="waves-effect" href="/manage/roles"><i class="material-icons">assignment_ind</i>Roles</a></li>
      <li><a class="waves-effect" href="/manage/permissions"><i class="material-icons">security</i>Permissions</a></li>
      <li> <div class="divider"></div></li>
      <li><a href="/home/"><i class="material-icons">home</i>Return Home</a></li>
      <li><a href="/logout0.7/"><i class="material-icons">exit_to_app</i>Logout</a></li>
      <li><a><button class="btn waves-effect waves-light " onclick="ToggleDarkTheme()">Toggle Dark Theme</button></a></li>
  </ul>
  <script>
      function ToggleDarkTheme(){
          $curtheme = $('#dark-theme-css').attr('href');
          if($curtheme=='/css/dark.css'){
            $('#dark-theme-css').attr('href',' ')
            $('#user-bg-img').attr('src',' ')
          }else{
            $('#user-bg-img').attr('src','https://i.driedsponge.net/images/png/sb7Po.png')
            $('#dark-theme-css').attr('href','/css/dark.css')
          }
      }
  </script>
  <a href="#" data-target="left-nav" class="sidenav-trigger" id="left-nav-btn"><i class="material-icons" style="color: white">menu</i></a>
</header>
