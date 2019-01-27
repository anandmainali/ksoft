@extends('dashboard.layouts.admin-auth') 
@section('title','Password Reset') 
@section('content')

<div class="login-box-body">
  <form method="POST" action="{{ route('password.update') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">

      <input id="email" type="email" class="form-control" name="email" value="{{ $email ?? old('email') }}"
        placeholder="Enter Email" required autofocus> 
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        @if ($errors->has('email'))
        <span class="help-block">{{ $errors->first('email') }}</span>
        @endif    
    </div>

    <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
      <input id="password" type="password" class="form-control" name="password"
        required placeholder="Password"> 
        @if ($errors->has('password'))
        <span class="help-block">{{ $errors->first('password') }}</span>
        @endif
      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
      <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Retype password">
      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>

    <div class="form-check">

    </div>


    <div class="row">
      <div class="col-xs-5">
        <a href="{{route('login')}}">Or Go back</a>
      </div>
      <!-- /.col -->
      <div class="col-xs-7">
        <button type="submit" class="btn btn-primary btn-block">
                Reset Password
            </button>
      </div>
      <!-- /.col -->

    </div>
  </form>
</div>
@endsection