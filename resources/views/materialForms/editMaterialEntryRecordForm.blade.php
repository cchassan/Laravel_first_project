@extends('layouts.app')

@section('content')

    <div id="main-content">
        {{--        @include('backend.vendor.includes.blockHeader')--}}
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Edit Material Entry Record</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active">Edit Material Entry Record</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12">

                    <div class="card planned_task">
                        <div class="header">
                            <h1 class="text-center">Edit Material Entry Record</h1>
                            <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                <li><a href="javascript:void(0);" class="full-screen"><i
                                            class="icon-size-fullscreen"></i></a></li>
                            </ul>
                        </div>
                        <div class="body">
                            <form method="POST" action="{{route('material.Entry.Record.update', ['id' => $materialRecordEntry->material_record_id])}}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mt-1">
                                        <div class="form-group">
                                            <label>Serial Number<span class="text-danger"> *</span></label>
                                            <input type="text" name="serialNumber" class="form-control autocomplete"
                                                   id="name" value="{{old('serialNumber',  $materialRecordEntry->serialNumber)}} " required>
                                        </div>
                                        @error('serialNumber')
                                        <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mt-1">
                                        <div class="form-group">
                                            <label>Item Code <span class="text-danger">*</span></label>
                                            <input type="text" name="itemCode" class="form-control"
                                                   value="{{old('itemCode',  $materialRecordEntry->itemCode)}}" required>
                                        </div>
                                        @error('itemCode')
                                        <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mt-1">
                                        <div class="form-group">
                                            <label>Item Description <span class="text-danger">*</span></label>
                                            <textarea class="form-control" name="itemDescription" id="address" rows="2" required
                                            >{{old('itemDescription',  $materialRecordEntry->itemDescription)}}</textarea>
                                        </div>
                                        @error('itemDescription')
                                        <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mt-1">
                                        <div class="form-group">
                                            <label>Manufacturer Name <span class="text-danger">*</span></label>
                                            <input type="text" name="manufacturerName" class="form-control"
                                                   value="{{old('manufacturerName',  $materialRecordEntry->manufacturerName)}}" required>
                                        </div>
                                        @error('manufacturerName')
                                        <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mt-1">
                                        <div class="form-group">
                                            <label>Manufacturer Address <span class="text-danger">*</span></label>
                                            <textarea class="form-control" name="manufacturerAddress" id="address" rows="2" required
                                            >{{old('manufacturerAddress',  $materialRecordEntry->manufacturerAddress)}}</textarea>
                                        </div>
                                        @error('manufacturerAddress')
                                        <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mt-1">
                                        <div class="form-group">
                                            <label>Prepared By <span class="text-danger">*</span></label>
                                            <input type="text" name="preparedBy" class="form-control"
                                                   value="{{old('preparedBy',  $materialRecordEntry->preparedBy)}}" required>
                                        </div>
                                        @error('preparedBy')
                                        <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mt-1">
                                        <div class="form-group">
                                            <label>Date <span class="text-danger">*</span></label>
                                            <input type="date" name="date" class="form-control"
                                                   value="{{old('date',  $materialRecordEntry->date)}}" required>
                                        </div>
                                        @error('date')
                                        <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mt-1">
                                        <div class="form-group">
                                            <label>Remarks (if Any)</label>
                                            <textarea class="form-control" name="remarks" id="address" rows="4"
                                            >{{old('remarks',  $materialRecordEntry->remarks)}}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row text-right">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary" style="background: #0b2e13; border: none">
                                                Update
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

