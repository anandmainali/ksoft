@extends('dashboard.layouts.admin-master') 
@section('title','Profile') 
@section('content')

<!-- Main content -->
<section class="content">
    <div class="col-md-12">
        <!-- Widget: user widget style 1 -->
        <div class="box box-widget widget-user">
          <!-- Add the bg color to the header using any of the bg-* classes -->
          <div class="widget-user-header bg-aqua-active">
            
          </div>
          <div class="widget-user-image">
            <img class="img-circle" src="{{Auth::user()->image}}" alt="User Avatar">
          </div>
          <div class="box-footer">
            <div class="row">
              <div class="col-sm-4 border-right">
                <div class="description-block">                
                  
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
              <div class="col-sm-4 border-right">
                <div class="description-block">
                  <h5 class="description-header">{{Auth::user()->name}}</h5>
                  <span class="description-text">{{Auth::user()->roles()->pluck('name')->implode(', ')}}</span>
                  <h5 class="widget-user-desc">{{Auth::user()->email}}</h5>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
              <div class="col-sm-4">
                <div class="description-block">
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
        </div>
        <!-- /.widget-user -->
        <br><br>
      </div>
      

      <h3>User Info.</h3>
      
      <div class="row">
      <div class="col-md-6">
    <!-- /.col -->
    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Update Profile</h3>
        </div>
        <!-- /.box-header -->
        {!! Form::model(Auth::user(),['method'=>'PATCH','route'=>['admin.updateUser',Auth::user()->id],'files'=>true])!!}
              <div class="box-body">
                <div class="form-group">
                  {!! Form::label('name','Name')!!} 
                  {!! Form::text('name',null,['class'=>'form-control'])!!}
                </div>

                <div class="form-group">
                  {!! Form::label('email','Email')!!} 
                  {!! Form::email('email',null,['class'=>'form-control'])!!}
                </div>

                <div class="form-group">
                  {!! Form::label('image','Profile Picture')!!} 
                  {!! Form::file('image',['class'=>'form-control'])!!}
                </div>

                <div class="box-footer">
                  {!! Form::button('<i class="fa fa-paper-plane"></i>Update Profile',['type'=>'submit','class'=>'btn btn-primary
                  pull-right'])!!}
                </div>
              </div>

              {!! Form::close()!!}
        <!-- form start -->

      </div>
    </div>
    
      <div class="col-md-6">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Update Password</h3>
              </div>
              <!-- /.box-header -->
              {!! Form::open(['method'=>'POST','route'=>['admin.updatePassword',Auth::user()->id]])!!}
              <div class="box-body">
              <div class="form-group">
                {!! Form::label('oldPassword','Old Password')!!} 
                {!! Form::password('oldPassword',['class'=>'form-control'])!!}
              </div>

              <div class="form-group">
                {!! Form::label('password','New Password')!!} 
                {!! Form::password('password',['class'=>'form-control'])!!}
              </div>

              <div class="form-group">
                {!! Form::label('password_confirmation','Confirm Password')!!} 
                {!! Form::password('password_confirmation',['class'=>'form-control'])!!}
              </div>

              <div class="box-footer">
                {!! Form::button('<i class="fa fa-paper-plane"></i>Update Password',['type'=>'submit','class'=>'btn btn-primary pull-right'])!!}
              </div>
              </div>


              {!! Form::close()!!}
              <!-- form start -->
      
            </div>
          </div>

  </div>
  <!-- /.row -->

</section>
<!-- /.content -->
@endsection