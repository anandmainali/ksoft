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
        <i class="fa fa-circle text-success"></i> {{Auth::user()->roles->name}}
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
      @if(Auth::user()->roles->name == 'Kitchen Staff')
      <li>
        <a href="{{route('admin.category.index')}}">
          <i class="fa fa-list-alt"></i> <span>Categories</span>                
        </a>
      </li>
      <li>
        <a href="{{route('admin.foodItem.index')}}">
          <i class="fa fa-circle-o"></i> <span>Food Items</span>                
        </a>
      </li>
      <li>
          <a href="{{route('admin.getItems')}}">
            <i class="fa fa-check"></i> <span>Set Today Menu</span>                
          </a>
        </li>
        <li>
            <a href="{{route('admin.orders.index')}}">
              <i class="fa fa-shopping-cart"></i> <span>Today Orders</span>                
            </a>
        </li>
        @endif
        @if(Auth::user()->roles->name == 'Employee')
        <li>
            <a href="{{route('admin.allOrders')}}">
              <i class="fa fa-eye"></i> <span>My Orders</span>                
            </a>
        </li>
          @endif
      
      @if(Auth::user()->roles->name == 'Admin')
      <li>
          <a href="{{route('admin.menusHistory')}}">
            <i class="fa  fa-history"></i> <span>Menus History</span>                
          </a>
        </li>
      <li>
      <li>
          <a href="{{route('admin.ordersHistory')}}">
            <i class="fa  fa-history"></i> <span>Orders History</span>                
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
      @endif
    


      <li>

  </section>
  <!-- /.sidebar -->
</aside>