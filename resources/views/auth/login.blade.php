@extends('layouts.app')
@section('css')
    <style>
        .theme-green .auth-main:after,
        .theme-green .auth-main:before {
            background-image: url('{{asset('assets/images/image-gallery/Gulf-Biotech-Image.jpg')}}') !important;
            background-size: cover;
            background-position: center;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            content: '';
            z-index: -1;
        }
        .card .header {
            padding: 8px;
        }
        .card .body {
            padding-top: 8px;
        }
        .card {
            opacity: 0.8;
        }
        .footer {
            background-color: rgb(255, 255, 255);
            color: #333;
            padding: 10px 0;
            text-align: center;
            vertical-align: middle;
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            z-index: 1000;
            opacity: 0.8;
        }
    </style>
@endsection
@section('content')

<div id="wrapper" class="auth-main">
    <div class="container">
        <div class="row clearfix">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
                <div class="card shadow-lg">
                    <div class="header text-center">
                        <div><img src="{{asset('assets/images/image-gallery/GBC-Logo.png')}}" width="120px" height="120px" alt=""></div>
                        <br>
                        <img src="{{asset('assets/images/image-gallery/GulfConnect-Pro-Logo.png')}}" width="200px" height="50px"  alt="">
                    </div>
                    <div class="body">
                        <form class="form-auth-small" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label for="signin-email" class="control-label sr-only">Email</label>
                                <input type="email" id="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus >
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="signin-password" class="control-label sr-only">Password</label>
                                <input type="password" id="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
{{--                            <div class="form-group clearfix">--}}
{{--                                <label class="fancy-checkbox element-left">--}}
{{--                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>--}}
{{--                                    <span>Remember me</span>--}}
{{--                                </label>--}}
{{--                            </div>--}}
                            <button type="submit" class="btn btn-primary btn-lg btn-block">LOGIN</button>
                            <div class="bottom">
                                @if (Route::has('password.request'))
                                <span class="helper-text m-b-10"><i class="fa fa-lock"></i> <a href="{{ route('password.request') }}">Forgot password?</a></span>
                                @endif

{{--                                <span>Don't have an account? <a href="page-register.html">Register</a></span>--}}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4"></div>
        </div>
    </div>
</div>
    <footer class="footer text-center">
        &copy; Copyright @ 2024 Gulf Biotech | IT Department | <span style="color: #698F2D">Gulf Biotech Website | Support</span>
    </footer>
@endsection
