<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'UKM Citra System') }}</title>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
          integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="hold-transition login-page"
      style="background: url({{ asset('images/bg.png') }});background-repeat: no-repeat;background-size: 100% 100%;">
<div class="login-box">
    <div class="login-logo">
        <b>UKM</b>Citra
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="input-group mb-3">
                    <input name="matric_no" type="text" class="form-control @error('matric_no') is-invalid @enderror"
                           value="{{ old('matric_no') }}" placeholder="UKMper/No.Matrik" required/>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>

                    @error('matric_no')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <input name="password" type="password" class="form-control @error('password') is-invalid @enderror"
                           placeholder="Kata Laluan" required/>

                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="row">
                    <div class="offset-8 col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                </div>
            </form>

            @if(\Illuminate\Support\Facades\App::environment('local'))
                <div class="social-auth-links text-center mb-3">
                    <p>- DEVELOPER ACTION -</p>
                    <a href="{{ route('dev_login', 'student') }}" class="btn btn-block btn-primary">
                        <i class="fas fa-user mr-2"></i> Sign in as Student
                    </a>
                    <a href="{{ route('dev_login', 'lecturer') }}" class="btn btn-block btn-info">
                        <i class="fas fa-chalkboard-teacher mr-2"></i> Sign in as Lecturer
                    </a>
                    <a href="{{ route('dev_login', 'admin') }}" class="btn btn-block btn-danger">
                        <i class="fas fa-user-shield mr-2"></i> Sign in as Admin
                    </a>
                </div>
            @endif
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

</body>
</html>
