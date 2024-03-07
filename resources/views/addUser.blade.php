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
                        <li class="breadcrumb-item"><a href="{{route('users')}}">Users</a></li>
                        <li class="breadcrumb-item active text-primary">{{$title}}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="card planned_task">
                <div class="header">
                    <H2>{{$title}}</H2>
                </div>
                <div class="body">
                    <form action="{{$url}}" method="POST">
                        @csrf
                        <div class="row clearfix">
                            <div class="col-md-6 mt-1">
                                <label for="name" >User Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" autocomplete ="name"
                                       id="name" value="{{old('name', $user->name)}}" required >
                                @error('name')
                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mt-1">
                                <label for="email">User Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control autocomplete"
                                       id="email" value="{{old('email', $user->email)}}" required>
                                @error('email')
                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mt-1">
                                <label for="number">Contact No.</label>
                                <input type="number" name="phone" class="form-control autocomplete"
                                       id="number" value="{{old('phone', $user->phone)}}" >
                            </div>
                            <div class="col-md-6 mt-1">
                                <label for="password">Password
                                    @if(request()->is('users/create'))
                                        <span class="text-danger">*</span>
                                    @endif
                                </label>
                                <input type="password" name="password" class="form-control autocomplete"
                                       id="password" value="{{old('password')}}" @if(request()->is('users/create')) required  @endif >
                                @error('password')
                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                @enderror
                            </div>
                            <div class="col-md-12 mt-1">
                                <label for="address">Address</label>
                                <textarea class="form-control" name="address" id="address" rows="4"
                                >{{old('address', $user->address)}}</textarea>
                            </div>
                        </div>
                        <hr>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary" style="background: #446433; border: #0b2e13"> Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
