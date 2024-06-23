
@extends('layouts.app')

@section('content')

    <div id="main-content">
        {{--        @include('backend.vendor.includes.blockHeader')--}}
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Bill of Material (BMR)</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active">Add Bill of Material (BMR)</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12">

                    <div class="card planned_task">
                        <div class="header">
                            <h1 class="text-center">Bill of Material (BMR)</h1>
                            <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                <li><a href="javascript:void(0);" class="full-screen"><i
                                            class="icon-size-fullscreen"></i></a></li>
                            </ul>
                        </div>
                        <div class="body">
                            <form id="recipeForm" method="POST" action="{{route('billOfMaterialBMR.store')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mt-1">
                                        <div class="form-group">
                                            <label>Serial Number<span class="text-danger"> *</span></label>
                                            <input type="text" name="serialNumber" class="form-control autocomplete"
                                                   id="name" value="{{old('serialNumber')}}" required>
                                        </div>
                                        @error('serialNumber')
                                        <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mt-1">
                                        <div class="form-group">
                                            <label>BOM-BMR Code <span class="text-danger">*</span></label>
                                            <input type="text" name="bom_bmr_code" class="form-control"
                                                   value="{{old('bom_bmr_code')}}" required>
                                        </div>
                                        @error('bom_bmr_code')
                                        <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mt-1">
                                        <label>BMR Code</label>
                                        <input type="text" name="bmr_code" class="form-control"
                                               value="{{old('bmr_code')}}" required>
                                        @error('bmr_code')
                                        <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mt-1">
                                        <label>Product Code</label>
                                        <select class="form-control productCode" name="productCode" id="productCode"  >
                                            <option value="">Select Product Code</option>
                                        </select>
                                        @error('productCode')
                                        <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mt-1">
                                        <div class="form-group">
                                            <label>Product Name <span class="text-danger">*</span></label>
                                            <input type="text" name="productName" id="productName" class="form-control"
                                                   value="{{old('productName')}}" readonly>
                                        </div>
                                        @error('productName')
                                        <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mt-1">
                                        <div class="form-group">
                                            <label>Batch Number <span class="text-danger">*</span></label>
                                            <input type="text" name="batchNumber" id="batchNumber" class="form-control"
                                                   value="{{old('batchNumber')}}" >
                                        </div>
                                        @error('batchNumber')
                                        <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mt-1">
                                        <label>Batch Type</label>
                                        <select class="form-control batchType" name="batchType" id="batchtype"  >
                                            <option value="">Select Batch Type</option>
                                        </select>
                                        @error('batchType')
                                        <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mt-1">
                                        <div class="form-group">
                                            <label>Batch Size <span class="text-danger">*</span></label>
                                            <input type="text" name="batchSize" id="batchSize" class="form-control"
                                                   value="{{old('batchSize')}}">
                                        </div>
                                        @error('batchSize')
                                        <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mt-1">
                                        <div class="form-group">
                                            <label>Unit of Measurement <span class="text-danger">*</span></label>
                                            <select class="form-control" name="measuringUnit">
                                                <option>KG</option>
                                                <option>Liters</option>
                                                <option>Pieces</option>
                                            </select>
                                        </div>
                                        @error('measuringUnit')
                                        <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>


                                </div>

                                <Hr>

                                <div class="row text-right">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-primary" id = "addBtn" style="background: #0b2e13; border: none">
                                                Add Request Material
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="container-fluid">
                                    <div class="row clearfix">
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="header">
                                                    <h2>Recipe Items</h2>
                                                </div>
                                                <div class="body">
                                                    <div class="table-responsive">
                                                        <table id="recipe_table" class="table table-bordered table-hover product_table" style="width:100%">
                                                            <thead>
                                                            <tr>
                                                                <th scope="col">No.</th>
                                                                <th scope="col">Material Code</th>
                                                                <th scope="col">Material Description</th>
                                                                <th scope="col">Specification</th>
                                                                <th scope="col">Standard Quantity</th>
                                                                <th scope="col">Required Quantity</th>
                                                                <th scope="col">UoM</th>
                                                                <th scope="col">Action</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mt-1">
                                        <div class="form-group">
                                            <label>Remarks (if Any)</label>
                                            <textarea class="form-control" name="remarks" id="remarks" rows="4"
                                            >{{old('remarks')}}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class ="row">
                                    <div class="col-md-6 mt-1">
                                        <div class="form-group">
                                            <label>Prepared By <span class="text-danger">*</span></label>
                                            <input type="text" name="preparedBy" class="form-control"
                                                   value="{{old('preparedBy')}}" required>
                                        </div>
                                        @error('preparedBy')
                                        <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mt-1">
                                        <div class="form-group">
                                            <label>Prepared on <span class="text-danger">*</span></label>
                                            <input type="date" name="preparedOn" class="form-control"
                                                   value="{{old('preparedOn')}}" required>
                                        </div>
                                        @error('preparedOn')
                                        <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mt-1">
                                        <div class="form-group">
                                            <label>Approved by <span class="text-danger">*</span></label>
                                            <input type="text" name="approvedBy" class="form-control"
                                                   value="{{old('approvedBy')}}" required>
                                        </div>
                                        @error('approvedBy')
                                        <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mt-1">
                                        <div class="form-group">
                                            <label>Approved Date <span class="text-danger">*</span></label>
                                            <input type="date" name="approvedDate" class="form-control"
                                                   value="{{old('approvedDate')}}" required>
                                        </div>
                                        @error('approvedDate')
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
            let selectedMaterialCodes = [];
            let itemCount = 0;

            // Append new row to table
            $('#addBtn').click(function() {
                itemCount++;
                const newRow = `
            <tr>
                <td>${itemCount}</td>
                <td>
                    <select class="form-control materialCode" name="materialCode[]" id="materialCode${itemCount}">
                        <option value="">Select Material Code</option>
                    </select>
                </td>
                <td><input type="text" class="form-control materialDescription" name="materialDescription[]" id="materialDescription${itemCount}" required></td>
                <td>
                    <select class="form-control" name="specification[]">
                        <option>USP</option>
                        <option>BP</option>
                        <option>IP</option>
                        <option>Ph.EUR</option>
                        <option>In-House</option>
                        <option>Others</option>
                    </select>
                </td>
                <td><input type="number" class="form-control" name="standardQty[]" required></td>
                <td><input type="number" class="form-control" name="requiredQty[]" required></td>
                <td>
                    <select class="form-control" name="measuring[]">
                        <option>KG</option>
                        <option>Liters</option>
                        <option>Pieces</option>
                        <option>mg</option>
                        <option>ml</option>
                    </select>
                </td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm remove-item">Remove</button>
                </td>
            </tr>
        `;

                $('#recipe_table tbody').append(newRow);

                $('.materialCode').select2({
                    placeholder: 'Select an item code',
                    minimumInputLength: 2,
                    ajax: {
                        url: "{{ route('get.item.code.bmr') }}",
                        method: 'POST',
                        dataType: 'json',
                        delay: 250,
                        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                        data: function(params) { return { query: params.term }; },
                        processResults: function(data) {
                            return {
                                results: $.map(data, function(item) {
                                    return {
                                        id: item.material_record_id,
                                        text: item.itemCode,
                                        itemDescription: item.itemDescription
                                    };
                                })
                            };
                        },
                        cache: true
                    }
                }).on('select2:select', function(e) {
                    var itemCode = e.params.data.id;
                    var itemDescription = e.params.data.itemDescription;

                    if (selectedMaterialCodes.includes(itemCode)) {
                        alert('This item is already selected.');
                        $(this).val(null).trigger('change');
                    } else {
                        selectedMaterialCodes.push(itemCode);
                        $(this).closest('tr').find('.materialDescription').val(itemDescription);
                    }
                });
            });

            // Remove item from the table
            $(document).on('click', '.remove-item', function() {
                var itemCode = $(this).closest('tr').find('.materialCode').val();
                if (selectedMaterialCodes.includes(parseInt(itemCode))) {
                    const index = selectedMaterialCodes.indexOf(parseInt(itemCode));
                    if (index > -1) selectedMaterialCodes.splice(index, 1);
                }
                $(this).closest('tr').remove();
                itemCount--;
                $('#recipe_table tbody tr').each(function(index) {
                    $(this).find('td:first').text(index + 1);
                });
            });

            // Get product codes and ids
            $('.productCode').select2({
                placeholder: 'Select a Product Code',
                minimumInputLength: 2,
                ajax: {
                    url: "{{ route('get.product.codes.bmr') }}",
                    method: 'POST',
                    dataType: 'json',
                    delay: 250,
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    data: function(params) { return { query: params.term }; },
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    id: item.product_id,
                                    text: item.product_code,
                                    productName: item.product_name,
                                    genericName: item.generic_name,
                                    pStrength: item.strength,
                                    fillVolume: item.fill_volume,
                                    batchSizeLiter: item.batch_size_liter,
                                    batchSizeVials: item.batch_size_vial
                                };
                            })
                        };
                    },
                    cache: true
                }
            }).on('select2:select', function(e) {
                var productName = e.params.data.productName;
                var genericName = e.params.data.genericName;
                var strength = e.params.data.pStrength;
                var fillVolume = e.params.data.fillVolume;
                var batchLiter = e.params.data.batchSizeLiter;
                var batchVials = e.params.data.batchSizeVials;
                $('#productName').val(productName);
                $('#genericName').val(genericName);
                $('#strength').val(strength);
                $('#fillVolume').val(fillVolume);
                $('#batchLiter').val(batchLiter);
                $('#batchVials').val(batchVials);
            });



            // batch type

            $('.batchType').select2({
                placeholder: 'Select a Batch Type',
                minimumInputLength: 2,
                ajax: {
                    url: "{{ route('get.batch.type.bmr') }}",
                    method: 'POST',
                    dataType: 'json',
                    delay: 250,
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    data: function(params) { return { query: params.term }; },
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    id: item.batchType_id,
                                    text: item.batchType,
                                };
                            })
                        };
                    },
                    cache: true
                }
            });

            // Form submission validation
            $('#recipeForm').submit(function(e) {
                if ($('#recipe_table tbody tr').length === 0) {
                    e.preventDefault();
                    alert('Please add at least one recipe item.');
                }
            });
        });
    </script>

@endpush
