@extends('dashboard.layouts.admin-auth') 
@section('title','Password Reset') 
@section('content')

<div class="login-box-body">
  <form method="POST" action="{{ route('password.update') }}">
    @csrf

    <input type="hidden" name="token" value="{{ $token }}">

    <div class="form-group has-feedback">

      <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}"
        placeholder="Enter Email" required autofocus> @if ($errors->has('email'))
      <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('email') }}</strong>
            </span> @endif
      <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

    </div>

    <div class="form-group has-feedback">
      <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
        required placeholder="Password"> @if ($errors->has('password'))
      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('password') }}</strong>
                                      </span> @endif

      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
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