@extends('layouts.app')
{{--@section('css')--}}
{{--    <style>--}}
{{--        thead tr{--}}
{{--            background-color: red;--}}
{{--            color: white;--}}
{{--        }--}}
{{--    </style>--}}
{{--    @endsection--}}
@section('content')

    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Users</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">People</li>
                        <li class="breadcrumb-item active"><a href="{{route('users')}}">Users</a></li>
                    </ul>
                    <a href="{{route('users.create')}}" class="btn btn-sm btn-primary" style="background: #446433; border: #0b2e13;" >Create New User</a>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Users <small>All registered users</small></h2>
                            <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                <li> <a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i class="icon-refresh"></i></a></li>
                                <li><a href="javascript:void(0);" class="full-screen"><i class="icon-size-fullscreen"></i></a></li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                {{$dataTable->table()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
