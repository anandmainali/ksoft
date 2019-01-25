@extends('dashboard.layouts.admin-master') 
@section('title','Home') 
 
@section('content')

<!-- Main content -->
<section class="content">
  <!-- Info boxes -->
  <div class="row">

      @if(Auth::user()->roles->name == 'Admin')

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="fa fa-history"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Menus History</span>
          <span class="info-box-number">{{$menu_history}}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>

    <!-- fix for small devices only -->
    <div class="clearfix visible-sm-block"></div>

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-history"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Orders History</span>
          <span class="info-box-number">{{$order_history}}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->


    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-red"><i class="fa fa-envelope-o"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Private Emails</span>
          <span class="info-box-number">{{$emails}}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Total Users</span>
          <span class="info-box-number">{{$users}}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    @endif


    @if(Auth::user()->roles->name == 'Kitchen Staff')
    <!-- For Kitchen Staff  -->
    
    <!-- fix for small devices only -->
    <div class="clearfix visible-sm-block"></div>

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="fa fa-list-alt"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Categories</span>
          <span class="info-box-number">{{$categories}}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>

    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-red"><i class="fa fa-circle-o"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Food Items</span>
          <span class="info-box-number">{{$food_items}}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->

    
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>
  
          <div class="info-box-content">
            <span class="info-box-text">Orders</span>
            <span class="info-box-number">{{$orders}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
    @endif

    @if(Auth::user()->roles->name == 'Employee')
    <script>window.location = "/{{config('dashboard.prefix')}}/viewTodayMenu";</script>
    @endif

  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
@endsection