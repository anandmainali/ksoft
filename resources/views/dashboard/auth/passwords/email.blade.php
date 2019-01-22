@extends('dashboard.layouts.admin-auth')

@section('title','Password Reset')

@section('content')
  <div class="login-box-body">
      @if (session('status'))
      <div class="alert alert-success" role="alert">
          {{ session('status') }}
      </div>
  @endif
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <p>Enter email address to reset the password.</p>
      <div class="form-group has-feedback">
          
          <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Enter Email" required autofocus>
          @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('email') }}</strong>
            </span>
          @endif 
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
         
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