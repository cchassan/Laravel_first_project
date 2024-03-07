<!doctype html>
<html lang="en">
<head>
    <title>:: HexaBit :: Home</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="description" content="HexaBit Bootstrap 4x Admin Template">
    <meta name="author" content="WrapTheme, www.thememakker.com">

    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/font-awesome/css/font-awesome.min.css')}}">

{{--    <link rel="stylesheet" href="{{asset('assets/vendor/charts-c3/plugin.css')}}"/>--}}
    <link rel="stylesheet" href="{{asset('assets/vendor/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}">
{{--    <link rel="stylesheet" href="{{asset('assets/vendor/chartist/css/chartist.min.css')}}">--}}
{{--    <link rel="stylesheet" href="{{'assets/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css'}}">--}}
    <link rel="stylesheet" href="{{asset('assets/vendor/toastr/toastr.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/sweetalert/sweetalert.css')}}"/>


    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/color_skins.css')}}">
</head>
<body class="theme-green">

<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img src="{{asset('assets/images/icon-light.svg')}}" width="48" height="48" alt="HexaBit"></div>
        <p>Please wait...</p>
    </div>
</div>
<!-- Overlay For Sidebars -->
<div class="overlay"></div>

<div id="wrapper">
    @if(!request()->is('login')  && !request()->is('password/reset'))
    @include('layouts/layouts_includes/tob_bar')

    @include('layouts/layouts_includes/right_bar')

    @include('layouts/layouts_includes/side_bar')
   @endif






