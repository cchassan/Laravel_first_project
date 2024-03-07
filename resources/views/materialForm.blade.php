@extends('layouts.app')

@section('content')

    <div id="main-content">
{{--        @include('backend.vendor.includes.blockHeader')--}}
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Material Form 1</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active"><a href="{{route('material.form.1')}}">MaterialForm 1</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12">

                    <div class="card planned_task">
                        <div class="header">
                            <h2>Material Entry Record</h2>
                            <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                <li><a href="javascript:void(0);" class="full-screen"><i
                                            class="icon-size-fullscreen"></i></a></li>
                            </ul>
                        </div>
                        <div class="body">
                            <form method="POST" action="#" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mt-1">
                                        <label>Serial Number</label>
                                        <input type="text" name="serialNumber" class="form-control autocomplete"
                                               id="name" value="{{old('serialNumber')}}" required>
                                    </div>
                                    <div class="col-md-6 mt-1">
                                        <div class="form-group">
                                            <label>Item Code</label>
                                            <input type="text" name="itemCode" class="form-control"
                                                   value="{{old('itemCode')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-1">
                                        <div class="form-group">
                                            <label>Item Description</label>
                                            <textarea class="form-control" name="description" id="address" rows="2"
                                            >{{old('description')}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-1">
                                        <div class="form-group">
                                            <label>Manufacturer Name</label>
                                            <input type="text" name="manufacturerName" class="form-control"
                                                   value="{{old('manufacturerName')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-1">
                                        <div class="form-group">
                                            <label>Manufacturer Address</label>
                                            <textarea class="form-control" name="description" id="address" rows="2"
                                            >{{old('description')}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-1">
                                        <div class="form-group">
                                            <label>Prepared By</label>
                                            <input type="text" name="preparedBy" class="form-control"
                                                   value="{{old('preparedBy')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-1">
                                        <div class="form-group">
                                            <label>Date</label>
                                            <input type="text" name="date" class="form-control"
                                                   value="{{old('date')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-1">
                                        <div class="form-group">
                                            <label>Remarks (if Any)</label>
                                            <textarea class="form-control" name="description" id="address" rows="4"
                                            >{{old('description')}}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary" style="background: #0b2e13; border: none">
                                                Add
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

