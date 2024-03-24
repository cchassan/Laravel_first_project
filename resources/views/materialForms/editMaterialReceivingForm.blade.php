@extends('layouts.app')

@section('css')
    <style>
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #444;
            line-height: 32px;
        }
        .select2-selection__arrow {
            height: 36px;
            position: absolute;
            top: 1px;
            right: 1px;
            width: 20px;
        }
        .select2-container .select2-selection--single {
            box-sizing: border-box;
            cursor: pointer;
            display: block;
            height: 36px;
            user-select: none;
            -webkit-user-select: none;
        }
    </style>

@endsection

@section('content')

    <div id="main-content">
        {{--        @include('backend.vendor.includes.blockHeader')--}}
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Edit Material Receiving Form</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active">Edit Material Receiving Form</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12">

                    <div class="card planned_task">
                        <div class="header">
                            <h1 class="text-center">Edit Material Receiving Form</h1>
                            <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                <li><a href="javascript:void(0);" class="full-screen"><i
                                            class="icon-size-fullscreen"></i></a></li>
                            </ul>
                        </div>
                        <div class="body">
                            <form method="POST" action="{{route('material.Receiving.Form.update', ['id' => $materialReceive->material_receive_id])}}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3 mt-1">
                                        <div class="form-group">
                                            <label>Serial Number<span class="text-danger"> *</span></label>
                                            <input type="text" name="serialNumber" class="form-control autocomplete"
                                                   id="name" value="{{old('serialNumber' , $materialReceive->serialNumber)}}" >
                                        </div>
                                        @error('serialNumber')
                                        <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 mt-1">
                                        <div class="form-group">
                                            <label>MRR Code</label>
                                            <input type="text" name="mrrCode" class="form-control"
                                                   value="{{old('mrrCode', $materialReceive->mrrCode )}}">
                                        </div>
                                        @error('mrrCode')
                                        <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 mt-1">
                                        <div class="form-group">
                                            <label>PO Number</label>
                                            <input type="text" name="poNumber" class="form-control autocomplete"
                                                   id="name" value="{{old('poNumber',  $materialReceive->poNumber)}}" >
                                        </div>
                                        @error('poNumber')
                                        <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 mt-1">
                                        <div class="form-group">
                                            <label>Vendor Number</label>
                                            <input type="text" name="vendorNumber" class="form-control"
                                                   value="{{old('vendorNumber',  $materialReceive->vendorNumber)}}">
                                        </div>
                                        @error('vendorNumber')
                                        <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 mt-1">
                                        <label>Item Code</label>
                                        <select class="form-control" name="itemCode" id="itemCode"  >
                                            <option value="{{$materialReceive->getMaterialItem->id}}">{{$materialReceive->getMaterialItem->itemCode}}</option>
                                        </select>
                                        @error('itemCode')
                                        <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>
                                    {{--                                <div class="col-md-3 mt-1">--}}
                                    {{--                                    <label>Item Code</label>--}}
                                    {{--                                    <input type="text" name="itemCode" class="form-control autocomplete"--}}
                                    {{--                                           id="itemCode" value="{{old('itemCode')}}" required>--}}
                                    {{--                                    <!-- Suggestion list -->--}}
                                    {{--                                    <div class="dropdown" id="dropdown">--}}
                                    {{--                                        <div class="suggestion-itemCode-list dropdown-ItemCode" aria-labelledby="dropdownItemCodeButton"></div>--}}
                                    {{--                                    </div>--}}
                                    {{--                                </div>--}}
                                    <div class="col-md-6 mt-1">
                                        <div class="form-group">
                                            <label>Item Description</label>
                                            <textarea class="form-control"  id="itemDescription" rows="2" readonly
                                            >{{$materialReceive->getMaterialItem->itemDescription}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-1">
                                        <div class="form-group">
                                            <label for="measuring">Unit of Measuring</label>
                                            <select class="form-control" name="measuring">
                                                <option value="KG" @if($materialReceive->unitOfMeasuring === 'KG') selected @endif>KG</option>
                                                <option value="Litters" @if($materialReceive->unitOfMeasuring  === 'Litters') selected @endif>Litters</option>
                                                <option value="Pieces" @if($materialReceive->unitOfMeasuring   === 'Pieces') selected @endif>Pieces</option>
                                            </select>
                                        </div>
                                        @error('measuring')
                                        <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mt-1">
                                        <div class="form-group">
                                            <label>Manufacturer Name</label>
                                            <input type="text" id="manufacturerName" class="form-control"
                                                   value="{{old('manufacturerName',  $materialReceive->getMaterialItem->manufacturerName)}}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-1">
                                        <div class="form-group">
                                            <label>Supplier</label>
                                            <input type="text" name="supplier" class="form-control"
                                                   value="{{old('supplier', $materialReceive->supplier)}}">
                                        </div>
                                        @error('supplier')
                                        <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mt-1">
                                        <div class="form-group">
                                            <label>Manufacturing Lot / Batch No.</label>
                                            <input type="text" name="batchNo" class="form-control"
                                                   value="{{old('batchNo', $materialReceive->batchNo)}}">
                                        </div>
                                        @error('batchNo')
                                        <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 mt-1">
                                        <div class="form-group">
                                            <label>MFG Date</label>
                                            <input type="date" name="mfgDate" class="form-control"
                                                   value="{{old('mfgDate',$materialReceive->mfgDate )}}">
                                        </div>
                                        @error('mfgDate')
                                        <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 mt-1">
                                        <div class="form-group">
                                            <label>EXP Date</label>
                                            <input type="date" name="expDate" class="form-control"
                                                   value="{{old('expDate' , $materialReceive->expDate)}}">
                                        </div>
                                        @error('expDate')
                                        <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mt-1">
                                        <div class="form-group">
                                            <label for="locationName">Warehouse Location</label>
                                            <select class="form-control" name="locationName">
                                                <option value="" @if(old('locationName') == null) selected @endif>Select Location</option>
                                                @foreach($locations as $location)
                                                    <option value="{{ $location->location_id }}" @if(old('locationName', $materialReceive->location_id) == $location->location_id) selected @endif>{{ $location->locationName }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('locationName')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mt-1"></div>
                                    <div class="col-md-6 mt-1">
                                        <div class="form-group">
                                            <label>Total Quantity</label>
                                            <input type="number" name="totalQuantity" class="form-control"
                                                   value="{{old('totalQuantity', $materialReceive->totalQuantity)}}">
                                        </div>
                                        @error('totalQuantity')
                                        <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mt-1">
                                        <div class="form-group">
                                            <label>Number of Container / Package</label>
                                            <input type="number" name="numberOfPackage" class="form-control"
                                                   value="{{old('numberOfPackage', $materialReceive->numberOfPackage)}}">
                                        </div>
                                        @error('numberOfPackage')
                                        <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mt-1">
                                        <div class="form-group">
                                            <label>Delivery Challan Number</label>
                                            <input type="text" name="deliveryChallanNumber" class="form-control"
                                                   value="{{old('deliveryChallanNumber',  $materialReceive->deliveryChallanNumber)}}">
                                        </div>
                                        @error('deliveryChallanNumber')
                                        <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mt-1">
                                        <label for="coaAttached">COA Attached</label>
                                        <select class="form-control" name="coaAttached">
                                            <option value="KG" @if($materialReceive->coaAttached === 'Attached') selected @endif>Attached</option>
                                            <option value="KG" @if($materialReceive->coaAttached === 'Not Attache') selected @endif>Not Attached</option>
                                        </select>
                                        @error('coaAttached')
                                        <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mt-1">
                                        <div class="form-group">
                                            <label>Material Control Number</label>
                                            <input type="number" name="materialControlNumber" class="form-control"
                                                   value="{{old('materialControlNumber',  $materialReceive->materialControlNumber)}}">
                                        </div>
                                        @error('materialControlNumber')
                                        <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mt-1">
                                        <div class="form-group">
                                            <label>Quantity Received</label>
                                            <input type="number" name="quantityReceived" class="form-control"
                                                   value="{{old('quantityReceived',  $materialReceive->quantityReceived)}}">
                                        </div>
                                        @error('quantityReceived')
                                        <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mt-1">
                                        <div class="form-group">
                                            <label>Quantity Rejected</label>
                                            <input type="number" name="quantityRejected" class="form-control"
                                                   value="{{old('quantityRejected', $materialReceive->quantityRejected)}}">
                                        </div>
                                        @error('quantityRejected')
                                        <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mt-1">
                                        <div class="form-group">
                                            <label>Damaged Quantity (if any)</label>
                                            <input type="number" name="damagedQuantity" class="form-control"
                                                   value="{{old('damagedQuantity', $materialReceive->damagedQuantity)}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-1">
                                        <div class="form-group">
                                            <label>Prepared By</label>
                                            <input type="text" name="preparedBy" class="form-control"
                                                   value="{{old('preparedBy', $materialReceive->preparedBy)}}">
                                        </div>
                                        @error('preparedBy')
                                        <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mt-1">
                                        <div class="form-group">
                                            <label>Date</label>
                                            <input type="date" name="date" class="form-control"
                                                   value="{{old('date', $materialReceive->date)}}">
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
                                            >{{old('remarks', $materialReceive->remarks)}}</textarea>
                                        </div>
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
            $('#itemCode').select2({
                minimumInputLength: 2, // Adjust as per your requirement
                ajax: {
                    url: "{{ route('get.item.codes') }}",
                    method: 'POST',
                    dataType: 'json',
                    delay: 250, // Delay in milliseconds before the request is sent
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    id: item.material_record_id,
                                    text: item.itemCode,
                                    itemDescription: item.itemDescription,
                                    manufacturer: item.manufacturerName,
                                };
                            })
                        };
                    },
                    cache: true // Cache AJAX requests to reduce server load
                }
            }).on('select2:select', function (e) {
                var itemDescription = e.params.data.itemDescription;
                var manufacturer = e.params.data.manufacturer;
                $('#itemDescription').val(itemDescription);
                $('#manufacturerName').val(manufacturer);
            });
        });

    </script>
@endpush
