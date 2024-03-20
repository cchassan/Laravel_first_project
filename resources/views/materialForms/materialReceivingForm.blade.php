@extends('layouts.app')

@section('css')

@endsection

@section('content')

<div id="main-content">
    {{--        @include('backend.vendor.includes.blockHeader')--}}
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h2>Material Receiving Form</h2>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active">Material Receiving Form</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">

                <div class="card planned_task">
                    <div class="header">
                        <h1 class="text-center">Material Receiving Form</h1>
                        <ul class="header-dropdown dropdown dropdown-animated scale-left">
                            <li><a href="javascript:void(0);" class="full-screen"><i
                                        class="icon-size-fullscreen"></i></a></li>
                        </ul>
                    </div>
                    <div class="body">
                        <form method="POST" action="#" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-3 mt-1">
                                    <label>Serial Number</label>
                                    <input type="text" name="serialNumber" class="form-control autocomplete"
                                           id="name" value="{{old('serialNumber')}}" required>
                                </div>
                                <div class="col-md-3 mt-1">
                                    <div class="form-group">
                                        <label>MRR Code</label>
                                        <input type="text" name="mrrCode" class="form-control"
                                               value="{{old('mrrCode')}}">
                                    </div>
                                </div>
                                <div class="col-md-3 mt-1">
                                    <label>PO Number</label>
                                    <input type="text" name="poNumber" class="form-control autocomplete"
                                           id="name" value="{{old('poNumber')}}" required>
                                </div>
                                <div class="col-md-3 mt-1">
                                    <div class="form-group">
                                        <label>Vendor Number</label>
                                        <input type="text" name="vendorNumber" class="form-control"
                                               value="{{old('vendorNumber')}}">
                                    </div>
                                </div>
                                <div class="col-md-3 mt-1">
                                    <label>Item Code</label>
                                    <select class="form-control" name="itemCode" id="itemCode" required>
                                        <option value="">Select Item Code</option>
                                    </select>
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
                                        <textarea class="form-control" name="itemDescription" id="itemDescription" rows="2" readonly
                                        >{{old('itemDescription')}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-3 mt-1">
                                    <label for="measuring">Unit of Measuring</label>
                                    <select class="form-control" name="measuring">
                                        <option>KG</option>
                                        <option>Litters</option>
                                        <option>Pieces</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mt-1">
                                    <div class="form-group">
                                        <label>Manufacturer Name</label>
                                        <input type="text" name="manufacturerName" id="manufacturerName" class="form-control"
                                               value="{{old('manufacturerName')}}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-1">
                                    <div class="form-group">
                                        <label>Supplier</label>
                                        <input type="text" name="supplier" class="form-control"
                                               value="{{old('supplier')}}">
                                    </div>
                                </div>
                                <div class="col-md-6 mt-1">
                                    <div class="form-group">
                                        <label>Manufacturing Lot / Batch No.</label>
                                        <input type="text" name="manufacturingLot" class="form-control"
                                               value="{{old('manufacturingLot')}}">
                                    </div>
                                </div>
                                <div class="col-md-3 mt-1">
                                    <div class="form-group">
                                        <label>MFG Date</label>
                                        <input type="date" name="mfgDate" class="form-control"
                                               value="{{old('mfgDate')}}">
                                    </div>
                                </div>
                                <div class="col-md-3 mt-1">
                                    <div class="form-group">
                                        <label>EXP Date</label>
                                        <input type="date" name="expDate" class="form-control"
                                               value="{{old('expDate')}}">
                                    </div>
                                </div>
                                <div class="col-md-6 mt-1">
                                    <label for="measuring">Warehouse Location</label>
                                    <select class="form-control" name="warehouseLocation">
                                        <option value="" selected>Select Location</option>
                                        @foreach($locations as $location )
                                            <option value="{{ $location->id }}">{{ $location->locationName}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mt-1"></div>
                                <div class="col-md-6 mt-1">
                                    <div class="form-group">
                                        <label>Total Quantity</label>
                                        <input type="text" name="totalQuantity" class="form-control"
                                               value="{{old('totalQuantity')}}">
                                    </div>
                                </div>
                                <div class="col-md-6 mt-1">
                                    <div class="form-group">
                                        <label>Number of Container / Package</label>
                                        <input type="text" name="package" class="form-control"
                                               value="{{old('package')}}">
                                    </div>
                                </div>
                                <div class="col-md-6 mt-1">
                                    <div class="form-group">
                                        <label>Delivery Challan Number</label>
                                        <input type="text" name="deliveryChallanNumber" class="form-control"
                                               value="{{old('deliverChallanNumber')}}">
                                    </div>
                                </div>
                                <div class="col-md-6 mt-1">
                                    <label for="coaAttached">COA Attached</label>
                                    <select class="form-control" name="coaAttached">
                                        <option>Attached</option>
                                        <option>Not Attached</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mt-1">
                                    <div class="form-group">
                                        <label>Material Control Number</label>
                                        <input type="text" name="materialControlNumber" class="form-control"
                                               value="{{old('materialControlNumber')}}">
                                    </div>
                                </div>
                                <div class="col-md-6 mt-1">
                                    <div class="form-group">
                                        <label>Quantity Received</label>
                                        <input type="text" name="quantityReceived" class="form-control"
                                               value="{{old('quantityReceived')}}">
                                    </div>
                                </div>
                                <div class="col-md-6 mt-1">
                                    <div class="form-group">
                                        <label>Quantity Rejected</label>
                                        <input type="text" name="quantityRejected" class="form-control"
                                               value="{{old('quantityRejected')}}">
                                    </div>
                                </div>
                                <div class="col-md-6 mt-1">
                                    <div class="form-group">
                                        <label>Damaged Quantity (if any)</label>
                                        <input type="text" name="damagedQuantity" class="form-control"
                                               value="{{old('damagedQuantity')}}">
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
                                        <input type="date" name="date" class="form-control"
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
{{--    <script>--}}
{{--        $(document).ready(function() {--}}
{{--            $('#itemCode').on('input', function() {--}}
{{--                var inputVal = $(this).val();--}}
{{--                if (inputVal.length >= 2) { // Adjust as per your requirement--}}
{{--                    $.ajax({--}}
{{--                        url: "{{ route('get.item.codes') }}",--}}
{{--                        method: 'POST',--}}
{{--                        data: {--}}
{{--                            query: inputVal ,--}}
{{--                            _token: '{{ csrf_token() }}'--}}
{{--                        },--}}
{{--                        success: function(response) {--}}
{{--                            var suggestionList = $('.suggestion-itemCode-list');--}}
{{--                            suggestionList.empty();--}}
{{--                            if (response.length > 0) {--}}
{{--                                $.each(response, function(index, item) {--}}
{{--                                    var dropdownItem = $('<a class="dropdown-ItemCode"  data-item-id="' + item.id + '">' + item.itemCode + '</a>');--}}
{{--                                    dropdownItem.click(function() {--}}
{{--                                        var itemId = $(this).data('item-id');--}}
{{--                                        var itemCode = $(this).text();--}}
{{--                                        $('#itemCode').val(itemCode);--}}
{{--                                        $('#itemId').val(itemId); // Set the value of hidden input field--}}
{{--                                    });--}}
{{--                                    suggestionList.append(dropdownItem);--}}
{{--                                });--}}
{{--                                suggestionList.parent().addClass('show');--}}
{{--                            } else {--}}
{{--                                suggestionList.parent().removeClass('show');--}}
{{--                            }--}}
{{--                        }--}}
{{--                    });--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}


<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#itemCode').select2({
            placeholder: 'Select an item code',
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
                                id: item.id,
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
