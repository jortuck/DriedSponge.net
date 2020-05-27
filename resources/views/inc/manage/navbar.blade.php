<a href="#" data-activates="left-nav" class="button-collapse" id="left-nav-btn"><i class="material-icons" style="color: black">menu</i></a>
<header>
  <ul id='left-nav' class="sidenav fixed" style="width: 250px; transform: translateX(0%);">
      <li>
          <div class="user-view shadowed">
              <div class="background">
                  
              </div>
              <img id="avatar" src="{{Auth::user()->avatar}}"><br>
              <span id="name">{{Auth::user()->username}}</span>
              <span>{{Auth::user()->steamid}}</span>
          </div>
      </li>
      {{-- <li><a class="subheader">Subheader</a></li> --}}
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
  </ul>
</header>