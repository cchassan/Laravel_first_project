{{--@extends('layouts.app')--}}

{{--@section('content')--}}
{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Reset Password') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    <form method="POST" action="{{ route('password.update') }}">--}}
{{--                        @csrf--}}

{{--                        <input type="hidden" name="token" value="{{ $token }}">--}}

{{--                        <div class="row mb-3">--}}
{{--                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" >--}}

{{--                                @error('email')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row mb-3">--}}
{{--                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" autofocus>--}}

{{--                                @error('password')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row mb-3">--}}
{{--                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row mb-0">--}}
{{--                            <div class="col-md-6 offset-md-4">--}}
{{--                                <button type="submit" class="btn btn-primary">--}}
{{--                                    {{ __('Reset Password') }}--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--@endsection--}}



@extends('layouts.app')

@section('content')
    <style>
        .theme-green .auth-main:after,
        .theme-green .auth-main:before {
            background-image: url('{{asset('assets/images/image-gallery/Gulf-Biotech-Image.jpg')}}') !important;
            background-size: cover;
            background-position: center;
            position: fixed;
            z-index: 0;
        }
        .card .header {
            padding: 8px;
        }
        .card .body {
            padding-top: 8px;
        }
        .card{
            opacity: 0.8;
            z-index: 1;
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
    <div id="wrapper" class="auth-main">
        <div class="container">
            <div class="row clearfix">
                <div class="col-lg-4"></div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="header text-center">
                            <div><img src="{{asset('assets/images/image-gallery/GBC-Logo.png')}}" width="120px" height="120px" alt=""></div>
                            <br>
                            <img src="{{asset('assets/images/image-gallery/GulfConnect-Pro-Logo.png')}}" width="200px" height="50px"  alt="">
                        </div>
                            <div class="pl-4">{{ __('Reset Password') }}</div>
                        <div class="body">
                            <form class="form-auth-small" method="POST" action="{{ route('password.update') }}">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                                <div class="form-group">
                                    <label for="signin-email" class="control-label sr-only">Email</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password" class="control-label sr-only">Email</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" autofocus>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                         <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password-confirm" class="control-label sr-only">Email</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg btn-block">{{ __('Reset Password') }}</button>
                            </form>
                        </div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
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
