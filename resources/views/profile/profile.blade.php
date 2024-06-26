@extends('layouts.app')

@section('content')
    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>My Profile</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item">Profile</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">

            <div class="row clearfix">
                <div class="col-lg-4 col-md-12">
                    <div class="card profile-header">
                        <div class="body text-center">
                            <div class="profile-image mb-3 ">
                                <img src="{{ Auth::user()->user_image ? asset(Auth::user()->user_image) : asset('assets/images/avatar.jpg') }}" class="rounded-circle border border-success" style="width: 200px; height: 200px;" alt="">
                            </div>
                            <div>
                                <h4 class="mb-0"><strong>{{Auth::user()->name}}</strong></h4>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="header">
                            <h2>Information</h2>
                            <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                <li><a href="javascript:void(0);" class="full-screen"><i
                                            class="icon-size-fullscreen"></i></a></li>
                            </ul>
                        </div>
                        <div class="body">
                            <small class="text-muted">E-mail: </small>
                            <p>{{Auth::user()->email}}</p>
                            <hr>
                            <small class="text-muted">Contact No.: </small>
                            <p>{{Auth::user()->phone ?? 'Not Found'}}</p>
                            <hr>
                            <small class="text-muted">Address: </small>
                            <p>{{Auth::user()->address ?? 'Not Found'}}</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 col-md-12">
                    <div class="card">
                        <div class="body">
                            <ul class="nav nav-tabs-new">
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile">Modify Profile</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#password">Reset Password
                                    </a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-content padding-0">


                        <div class="tab-pane active" id="profile">
                            <div class="card">
                                <div class="header bline">
                                    <h2>
                                        General Information
                                    </h2>
                                    <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                        <li><a href="javascript:void(0);" class="full-screen"><i
                                                    class="icon-size-fullscreen"></i></a></li>
                                    </ul>
                                </div>
                                <div class="body">
                                    <form method="POST" action="{{route('profile.update', ['id' => Auth::user()->id])}}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="name">User Name <span class="text-danger">*</span></label>
                                                    <input type="text" name="name" value="{{Auth::user()->name}}" class="form-control" placeholder="Nome di battesimo">
                                                    @error('name')
                                                    <span class="text-danger"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="text" name="email" value="{{Auth::user()->email}}" class="form-control" placeholder="Email" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="form-group">
                                                    <label for="phone">Contact No.</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                                        </div>
                                                        <input type="text" name="phone" value="{{Auth::user()->phone ?? ''}}" class="form-control" placeholder="03023434343">
                                                    </div>
                                                    @error('phone')
                                                    <span class="text-danger"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="form-group">
                                                    <label>Address:</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fa fa-address-card"></i></span>
                                                        </div>
                                                        <textarea class="form-control" name="address" id="address" rows="4">{{old('address', Auth::user()->address)}}</textarea>
                                                    </div>
                                                    @error('address')
                                                    <span class="text-danger"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label>User Image:</label>
                                                    <input type="file" id="dropify-event-profile" name="user_image" data-default-file="">
                                                    @error('user_image')
                                                    <span class="text-danger"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-primary" style="background: #446433; border: #0b2e13">Update</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="password">
                            <div class="card">
                                <div class="header bline">
                                    <h2>Update password</h2>
                                    <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                        <li><a href="javascript:void(0);" class="full-screen"><i
                                                    class="icon-size-fullscreen"></i></a></li>
                                    </ul>
                                </div>
                                <div class="body">
                                    <form method="POST" action="{{route('profile.updatePassword', ['id' => Auth::user()->id])}}">
                                        @csrf
                                        <div class="row clearfix">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="form-group">
                                                    <input type="password" name="oldPassword" class="form-control"
                                                           placeholder="Current password">
                                                    @error('oldPassword')
                                                    <span class="text-danger">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <input type="password" name="newPassword" class="form-control"
                                                           placeholder="New password">
                                                    @error('newPassword')
                                                    <span class="text-danger">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <input type="password" name="password_confirmation"
                                                           class="form-control" placeholder="Confirm password">
                                                    @error('password_confirmation')
                                                    <span class="text-danger">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                        <button type="submit" class="btn btn-primary " style="background: #446433; border: #0b2e13">Update</button>
                                        </div>
                                        &nbsp;&nbsp;
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('style')
    <link rel="stylesheet" href="{{asset('vendor/dropify/css/dropify.min.css')}}">
@endpush
@push('script')
    <script src="{{asset('vendor/dropify/js/dropify.min.js')}}"></script>
    <script src="{{asset('js/pages/forms/dropify.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('#dropify-event-profile').dropify();
        });
@endpush
