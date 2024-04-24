@extends('layouts.app')

@section('content')

    <div id="main-content">
        {{--        @include('backend.vendor.includes.blockHeader')--}}
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Edit Product</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active">Edit Product</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12">

                    <div class="card planned_task">
                        <div class="header">
                            <h1 class="text-center">Edit Product</h1>
                            <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                <li><a href="javascript:void(0);" class="full-screen"><i
                                            class="icon-size-fullscreen"></i></a></li>
                            </ul>
                        </div>
                        <div class="body">
                            <form method="POST" action="{{route('product.update', ['id' => $product->product_id])}}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mt-1">
                                        <div class="form-group">
                                            <label>Serial Number<span class="text-danger"> *</span></label>
                                            <input type="text" name="serialNumber" class="form-control autocomplete"
                                                   id="name" value="{{old('serialNumber', $product->serialNumber)}}" required>
                                        </div>
                                        @error('serialNumber')
                                        <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mt-1">
                                        <div class="form-group">
                                            <label>Product Code <span class="text-danger">*</span></label>
                                            <input type="text" name="productCode" class="form-control"
                                                   value="{{old('productCode', $product->product_code)}}" required>
                                        </div>
                                        @error('productCode')
                                        <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 mt-1">
                                        <div class="form-group">
                                            <label>Product Name <span class="text-danger">*</span></label>
                                            <input type="text" name="productName" class="form-control"
                                                   value="{{old('productName', $product->product_name)}}" required>
                                        </div>
                                        @error('productName')
                                        <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 mt-1">
                                        <div class="form-group">
                                            <label>Generic Name <span class="text-danger">*</span></label>
                                            <input type="text" name="genericName" class="form-control"
                                                   value="{{old('genericName', $product->generic_name)}}" required>
                                        </div>
                                        @error('genericName')
                                        <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mt-1">
                                        <div class="form-group">
                                            <label>Strength<span class="text-danger"> *</span></label>
                                            <input type="text" name="strength" class="form-control autocomplete"
                                                   value="{{old('strength', $product->strength)}}" required>
                                        </div>
                                        @error('strength')
                                        <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mt-1">
                                        <div class="form-group">
                                            <label>Fill Volume/Vial <span class="text-danger">*</span></label>
                                            <input type="text" name="fillVolume" class="form-control"
                                                   value="{{old('fillVolume', $product->fill_volume)}}" required>
                                        </div>
                                        @error('fillVolume')
                                        <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mt-1">
                                        <div class="form-group">
                                            <label>Batch Size (Liter)<span class="text-danger"> *</span></label>
                                            <input type="number" name="batchSizeLiter" class="form-control autocomplete"
                                                   value="{{old('batchSizeLiter', $product->batch_size_liter)}}" required>
                                        </div>
                                        @error(' batchSizeLiter')
                                        <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mt-1">
                                        <div class="form-group">
                                            <label>Batch Size (No. of Vials) <span class="text-danger">*</span></label>
                                            <input type="number" name="batchSizeVials" class="form-control"
                                                   value="{{old('batchSizeVials', $product->batch_size_vial)}}" required>
                                        </div>
                                        @error('batchSizeVials')
                                        <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mt-1">
                                        <div class="form-group">
                                            <label>Route of Administration</label>
                                            <select class="form-control" name="routeAdministration" id="routeAdministration"  >
                                                <option value="{{$product->getRouteAdministration->routeAdministration_id}}">{{$product->getRouteAdministration->routeAdministrationName}}</option>
                                            </select>
                                        </div>
                                        @error('Route Administration')
                                        <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mt-1">
                                        <div class="form-group">
                                            <label>Secondary Packaging Format</label>
                                            <select class="form-control" name="secondaryPackageFormat" id="secondaryPackagingFormat"  >
                                                <option value="{{$product->getSecondaryPackagingFormat->secondaryPackagingFormat_id}}">{{$product->getSecondaryPackagingFormat->secondaryPackagingFormatName}}</option>
                                            </select>
                                        </div>
                                        @error('secondaryPackagingFormat')
                                        <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mt-1">
                                        <div class="form-group">
                                            <label>Prepared By <span class="text-danger">*</span></label>
                                            <input type="text" name="preparedBy" class="form-control"
                                                   value="{{old('preparedBy', $product->preparedBy)}}" required>
                                        </div>
                                        @error('preparedBy')
                                        <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mt-1">
                                        <div class="form-group">
                                            <label>Product Added by <span class="text-danger">*</span></label>
                                            <input type="text" name="addedBy" class="form-control" readonly
                                                   value="{{Auth::user()->name}}" required>
                                        </div>
                                        @error('addedBy')
                                        <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row text-right">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary" style="background: #0b2e13; border: none">
                                                submit
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

@push('scripts')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#routeAdministration').select2({
                placeholder: 'Select an Route of Administration',
                minimumInputLength: 2, // Adjust as per your requirement
                ajax: {
                    url: "{{ route('get.route.administration') }}",
                    method: 'POST',
                    dataType: 'json',
                    delay: 250, // Delay in milliseconds before the request is sent
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: function (params) {
                        return {
                            query: params.term
                        };
                    },

                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    id: item.routeAdministration_id,
                                    text: item.routeAdministrationName,
                                };
                            })
                        };
                    },
                    cache: true // Cache AJAX requests to reduce server load
                }
            });

            $('#secondaryPackagingFormat').select2({
                placeholder: 'Select an Secondary Packaging Format',
                minimumInputLength: 2, // Adjust as per your requirement
                ajax: {
                    url: "{{ route('get.secondary.packaging.format') }}",
                    method: 'POST',
                    dataType: 'json',
                    delay: 250, // Delay in milliseconds before the request is sent
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: function (params) {
                        return {
                            query: params.term
                        };
                    },

                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    id: item.secondaryPackagingFormat_id,
                                    text: item.secondaryPackagingFormatName,
                                };
                            })
                        };
                    },
                    cache: true // Cache AJAX requests to reduce server load
                }
            });
        });

    </script>
@endpush
