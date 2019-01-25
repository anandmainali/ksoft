<header class="main-header">

  <!-- Logo -->
  <a href="{{route('admin')}}" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b></b>{{config('dashboard.name')}}</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg">{{config('dashboard.name')}}</span>
  </a>

  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
    <span class="sr-only">Toggle navigation</span>
  </a>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
          @if(Auth::user()->roles->name == 'Employee')
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="{{ route('admin.getCartItems') }}" >
              <i class="fa fa-shopping-cart"></i>
              <span class="label label-warning">{{ Session::has('cart') ? Session::get('cart')->totalQty : '' }}</span>
            </a>
          </li>
          <li class="dropdown notifications-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-bell-o"></i>
                @if(auth()->user()->unreadNotifications->count()>0)
                <span class="label label-warning">                  
                    {{auth()->user()->unreadNotifications->count()}}                  
                </span>   
                @endif             
              </a>
              <ul class="dropdown-menu" >                
               <li>
                  <!-- inner menu: contains the actual data -->
                  <ul class="menu" id="menu1">
                    @foreach(auth()->user()->unreadNotifications as $notification)
                      <li>
                          <a href="#">
                            <i class="fa fa-check text-aqua"></i> {{$notification->data['data']}}
                          </a>
                        </li>
                        @endforeach
                  </ul>
                  
                </li>
                @if(auth()->user()->unreadNotifications->count()>0)
                <li class="footer"><a href="{{route('admin.markAsRead')}}">Mark All as Read</a></li> 
                @endif
              </ul>
            </li>
          @endif

        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <img src="{{Auth::user()->image}}" class="user-image" alt="User Image">
          <span class="hidden-xs">{{ucfirst(auth::user()->name )}}</span>
        </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img src="{{Auth::user()->image}}" class="img-circle" alt="User Image">

              <p>
                {{auth::user()->name}} - {{ucfirst(auth::user()->utype)}}
                <small>Member since {{auth::user()->created_at->diffForHumans()}}</small>
              </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <a href="{{route('admin.profile')}}" class="btn btn-default btn-flat"><i class="fa fa-user"></i> Profile </a>
              </div>
              <div class="pull-right">
                <a href="{{route('admin.logout')}}" class="btn btn-default btn-flat"> <i class="fa fa-sign-out"></i> SignOut </a>
              </div>
            </li>
          </ul>
        </li>
        <!-- Control Sidebar Toggle Button -->
      </ul>
    </div>

  </nav>
</header>