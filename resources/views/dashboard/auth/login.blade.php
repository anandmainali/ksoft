@extends('dashboard.layouts.admin-auth') 
@section('title','LogIn') 
@section('content')

<!-- /.login-logo -->
<div class="login-box-body">

  <form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
      <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
        placeholder="Enter Email" required autofocus> 
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>      
      @if ($errors->has('email'))
        <span class="help-block">{{ $errors->first('email') }}</span>
        @endif
    </div>
    <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
      <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' has-error' : '' }}" name="password"
        placeholder="Enter Password" required>
      <span class="glyphicon glyphicon-lock form-control-feedback"></span> 
      @if ($errors->has('password'))
      <span class="help-block">{{ $errors->first('password') }}</span>
       @endif
    </div>

    <div class="form-check">

    </div>


    <div class="row">
      <div class="col-xs-8">
        <div class="checkbox icheck">
          <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old( 'remember') ? 'checked' : '' }}>

          <label class="form-check-label" for="remember">
                  {{ __('Remember Me') }}
              </label>
        </div>
      </div>
      <!-- /.col -->
      <div class="col-xs-4">
        <button type="submit" class="btn btn-primary btn-block btn-flat">
                {{ __('Login') }}
            </button>
      </div>
      <!-- /.col -->
    </div>
  </form>
  <!-- /.social-auth-links -->
  @if (Route::has('password.request'))
  <a class="btn btn-link" href="{{ route('password.request') }}">
        {{ __('Forgot Your Password?') }}
      </a> @endif
  <a class="btn btn-link" href="{{ route('register') }}">
      Haven't created account yet?
    </a>

</div>
@endsection