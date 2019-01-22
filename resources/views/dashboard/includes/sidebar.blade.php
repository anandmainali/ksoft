<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{Auth::user()->image}}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>{{ucfirst(auth::user()->name)}}</p>
        <i class="fa fa-circle text-success"></i> Online
      </div>
    </div>

    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      <li>
        <a href="{{route('admin')}}">
                <i class="fa fa-home"></i> <span>Home</span>                
              </a>
      </li>

      <li>
        <a href="">
          <i class="fa fa-list-alt"></i> <span>Item Menu</span>                
        </a>
      </li>
      <li>
        <a href="">
          <i class="fa fa-bullhorn"></i> <span>Orders</span>                
        </a>
      </li>
      
      
      <li>
        <a href="{{route('admin.companyEmail.index')}}">
          <i class="fa fa-envelope-o"></i> <span> Private Emails</span>                
        </a>
      </li>
      <li>
        <a href="{{route('admin.users.index')}}">
          <i class="fa fa-users"></i> <span>Users</span>                
        </a>
      </li>
    


      <li>

  </section>
  <!-- /.sidebar -->
</aside>