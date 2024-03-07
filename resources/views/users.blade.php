@extends('layouts.app')

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
                                <table class="table table-bordered table-hover js-basic-example dataTable table-custom">
                                    <thead>
                                    <tr>
                                        <th>Sr.#</th>
                                        <th>name</th>
                                        <th>email</th>
                                        <th>phone</th>
                                        <th>Address</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Sr.#</th>
                                        <th>name</th>
                                        <th>email</th>
                                        <th>phone</th>
                                        <th>Address</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($users as $index => $user)
                                    <tr>
                                        <td> {{$index +1}} </td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>@if($user->phone == null) null @else {{$user->phone}}@endif</td>
                                        <td>@if($user->address == null) Empty @else {{$user->address}}@endif</td>
                                        <td><a href="{{route('users.edit', ['id' => $user->id ])}}"><button class="btn btn-primary" style="background: #0b2e13; border: none"><i class="fa fa-pencil primary"></i></button></a>
                                            <a href="{{route('users.delete' , ['id'=>$user->id])}}"
                                               id="delete" class="btn btn-sm btn-danger"
                                               data-toggle="tooltip" title="edit">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


@endsection
