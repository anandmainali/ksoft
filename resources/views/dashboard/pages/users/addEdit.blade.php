@extends('dashboard.layouts.admin-master') 
@if(isset($user))
@section('title','Update User') 
@else
@section('title','Create User') 
@endif
@section('content')

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title"></h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
      <div class="box-body">
           @if(isset($user))  
           {!! Form::model($user,['method'=>'PATCH','route'=>['admin.users.update',$user->id],'files'=>true]) !!}
           @else
          {!! Form::open(['route'=>'admin.users.store','files'=>true]) !!}
          @endif
          <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">          
          {!! Form::label('name', 'Name') !!}          
          {!! Form::text('name', null, ['class'=>'form-control','placeholder'=>'Enter name']) !!}
          @if ($errors->has('name'))
                  <span class="help-block">{{ $errors->first('name') }}</span>
                  @endif
        </div>
        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
          {!! Form::label('email', 'Email') !!}        
          {!! Form::email('email', null, ['class'=>'form-control','placeholder'=>'Enter email']) !!}
          @if ($errors->has('email'))
                <span class="help-block">{{ $errors->first('email') }}</span>
              @endif
        </div>
        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
            {!! Form::label('password', 'Password') !!}       
            {!! Form::password('password', ['class'=>'form-control','placeholder'=>'Password']) !!}
            @if ($errors->has('password'))
                <span class="help-block">{{ $errors->first('password') }}</span>
              @endif
            @if(isset($user))
            <small style="color: red">* Leave empty to keep the same password</small> 
            @endif          
          </div>
          <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
              {{ Form::label('password_confirmation', 'Confirm Password') }}
              {{ Form::password('password_confirmation', ['class' => 'form-control','placeholder'=>'Confirm Password']) }}
              @if ($errors->has('password_confirmation'))
                <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
              @endif   
          </div>
          <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
            
              {!! Form::label('image', 'Upload Image') !!} <br>
              @if(isset($user))
              <img src="{{$user->image}}" alt="User Image" height='60' width="60"> <br> 
              @endif      
              {!! Form::file('image', ['class'=>'form-control']) !!}
              @if ($errors->has('image'))
                <span class="help-block">{{ $errors->first('image') }}</span>
              @endif               
            </div>
            <div class="row">
              <div class="col-sm-6">
                  <div class="form-group {{ $errors->has('role_id') ? ' has-error' : '' }}">
                      {{ Form::label('role', 'Assign Role') }}                   
                      {!! Form::select('role_id', $roles, null, ['class'=>'form-control']) !!}
                      @if ($errors->has('role_id'))
                      <span class="help-block">{{ $errors->first('role_id') }}</span>
                      @endif                        
                  </div>
              </div>
              <div class="col-sm-4 col-sm-offset-1">
                  <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                    {!! Form::checkbox('status', null, null, []) !!}
                      {!! Form::label('status', 'Active') !!}  
                      @if ($errors->has('status'))
                      <span class="help-block">{{ $errors->first('status') }}</span>
                      @endif
                  </div>
              </div>
            </div>
            
        <div class="box-footer">                 
            {!! link_to_route('admin.users.index', 'Cancel', [], ['class'=>'btn btn-default']) !!}    
            {!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
        </div>         
          {!! Form::close() !!}
        </div>        
      </div>
      <!-- /.box-body -->
  </div>
    </div>
  </div>
</section>
  @endsection