<header class="main-header">
    <a href="#" class="logo">
      <span class="logo-mini"><b>S</b></span>
      <span class="logo-lg"><b>SMAART</b>&trade; Api</span>
    </a>
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{asset('/bower_components/admin-lte/dist/img/user2-160x160.jpg')}}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{ucfirst($name = Auth::user()->name)}}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <img src="{{asset('/bower_components/admin-lte/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
                <p>
                  {{ucfirst($name)}} 
                  <small> Member since {{ date('F d, Y', strtotime(Auth::user()->created_at))}}</small>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{url('/editUserDetails/'.Auth::user()->id)}}" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="{{ url('/logout') }}" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
