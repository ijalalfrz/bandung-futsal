<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="Login Admin - Bandung Futsal">
        <meta name="author" content="Rizal Alfarizi">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="assets/img/logo-fav.png">
        <title>{{ config('app.name', 'Login Admin') }}</title>

        <link href="{{ asset('lib/perfect-scrollbar/css/perfect-scrollbar.min.css') }}" rel="stylesheet">
        <link href="{{ asset('lib/material-design-icons/css/material-design-iconic-font.min.css') }}" rel="stylesheet">

        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    </head>
    <body class="be-splash-screen">
        <div class="be-wrapper be-login">
          <div class="be-content">
            <div class="main-content container-fluid">
              <div class="splash-container">
                <div class="panel panel-default panel-border-color panel-border-color-primary">
                  <div class="panel-heading">
                    {{-- <img src="assets/img/logo-xx.png" alt="logo" width="102" height="27" class="logo-img"> --}}
                    <h2>Hi, Admin </h2>

                    <span class="splash-description">Please enter your user information.</span>
                  </div>
                  <div class="panel-body">
                    <form method="POST" action="{{ route('admin.login') }}">
                      @csrf

                      <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                        <input placeholder="Email" id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                      </div>


                      <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                        <input placeholder="Password" id="password" type="password" class="form-control" name="password" value="{{ old('password') }}" required autofocus>

                        @if ($errors->has('password'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                      </div>

                      <div class="form-group row login-tools">
                        <div class="col-xs-6 login-remember">
                          <div class="be-checkbox">
                            <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label for="remember">Remember Me</label>
                          </div>
                        </div>
                        <div class="col-xs-6 login-forgot-password"><a href="#">Forgot Password?</a></div>
                      </div>
                      <div class="form-group login-submit">
                        <button type="submit" class="btn btn-primary btn-xl">
                          {{ __('Login Admin') }}
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <script src="{{ asset('lib/jquery/jquery.min.js') }}" defer></script>
        <script src="{{ asset('lib/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js') }}" defer></script>
        <script src="{{ asset('js/main.js') }}" defer></script>
        <script src="{{ asset('lib/bootstrap/dist/js/bootstrap.min.js') }}" defer></script>
        <script type="text/javascript">
          $(document).ready(function(){
            //initialize the javascript
            App.init();
          });

        </script>

    </body>
</html>

