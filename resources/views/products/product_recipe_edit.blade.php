
@extends('layouts.app')

@section('content')

    <script>
        let itemCount = 0;
        let selectedMaterialCodes = [];
    </script>

    <div id="main-content">
        {{--        @include('backend.vendor.includes.blockHeader')--}}
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Edit Product Recipe</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="icon-home"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12">

                    <div class="card planned_task">
                        <div class="header">
                            <h1 class="text-center">Edit Product Recipe</h1>
                            <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                <li><a href="javascript:void(0);" class="full-screen"><i
                                            class="icon-size-fullscreen"></i></a></li>
                            </ul>
                        </div>
                        <div class="body">
                            <form id="recipeForm" method="POST" action="{{route('product.Recipe.update', ['id' => $productRecipe->product_recipe_id])}}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mt-1">
                                        <div class="form-group">
                                            <label>Serial Number<span class="text-danger"> *</span></label>
                                            <input type="text" name="serialNumber" class="form-control autocomplete"
                                                   id="name" value="{{old('serialNumber',$productRecipe->serialNumber)}}" required>
                                        </div>
                                        @error('serialNumber')
                                        <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mt-1">
                                        <div class="form-group">
                                            <label>Product Recipe Code <span class="text-danger">*</span></label>
                                            <input type="text" name="productRecipeCode" class="form-control"
                                                   value="{{old('productRecipeCode', $productRecipe->product_recipe_code)}}" required>
                                        </div>
                                        @error('productRecipeCode')
                                        <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mt-1">
                                        <label>Product Code</label>
                                        <select class="form-control productCode" name="productCode" id="productCode"  >
{{--                                            <option value="">Select Product Code</option>--}}
                                            <option value="{{$productRecipe->getProduct->product_id}}">{{$productRecipe->getProduct->product_code}}</option>
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
                                                   value="{{old('productName',$productRecipe->getProduct->product_name)}}" readonly>
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
                                            <input type="text" name="genericName" id="genericName" class="form-control"
                                                   value="{{old('genericName', $productRecipe->getProduct->generic_name)}}" readonly>
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
                                            <input type="text" name="strength" id="strength" class="form-control autocomplete"
                                                   value="{{old('strength', $productRecipe->getProduct->strength)}}" readonly>
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
                                            <input type="text" name="fillVolume" id="fillVolume" class="form-control"
                                                   value="{{old('fillVolume', $productRecipe->getProduct->fill_volume)}}" readonly>
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
                                            <input type="number" name="batchSizeLiter" id="batchLiter" class="form-control autocomplete"
                                                   value="{{old('batchSizeLiter',  $productRecipe->getProduct->batch_size_liter)}}" readonly>
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
                                            <input type="number" name="batchSizeVials" id="batchVials" class="form-control"
                                                   value="{{old('batchSizeVials', $productRecipe->getProduct->batch_size_vial)}}" readonly>
                                        </div>
                                        @error('batchSizeVials')
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
                                                Add Recipe Items
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
                                                                <th scope="col">Material Type</th>
                                                                <th scope="col">Quantity</th>
                                                                <th scope="col">UoM</th>
                                                                <th scope="col">Action</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($productRecipe->getProductRecipeItems as $index => $product)
                                                                <script>
                                                                    selectedMaterialCodes.push({{$product->getMaterialItem->material_record_id}});
                                                                    itemCoun++;
                                                                    console.log("selectedMaterialCodes");
                                                                    console.log(selectedMaterialCodes);
                                                                    console.log("itemCount");
                                                                    console.log(itemCount);

                                                                </script>

                                                                <tr>
                                                                    <td class="">{{$index + 1}}</td>
                                                                    <td>
                                                                        <select class="form-control materialCode productCode" name="materialCode[]" >
                                                                            <option value="{{$product->getMaterialItem->material_record_id}}">{{$product->getMaterialItem->itemCode}}</option>
                                                                        </select>
                                                                    </td>
                                                                    <td><input type="text" class="form-control materialDescription" name="materialDescription[]" id="materialDescription${itemCount}" value="{{$product->getMaterialItem->itemDescription}}" required></td>
                                                                    <td>
                                                                        <select class="form-control" name="materialType[]">
                                                                            <option>{{$product->materialType}}</option>
                                                                            <option>API</option>
                                                                            <option>Excipient</option>
                                                                            <option>Chemical</option>
                                                                        </select>
                                                                    </td>
                                                                    <td><input type="number" class="form-control" name="quantity[]" value="{{$product->quantity}}" required></td>
                                                                    <td>
                                                                        <select class="form-control" name="measuring[]">
                                                                            <option>{{$product->unit_of_measuring}}</option>
                                                                            <option>KG</option>
                                                                            <option>Liters</option>
                                                                            <option>Pieces</option>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <button type="button" class="btn btn-danger btn-sm remove-item">Remove</button>
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

                                <div class ="row">
                                    <div class="col-md-6 mt-1">
                                        <div class="form-group">
                                            <label>Prepared By <span class="text-danger">*</span></label>
                                            <input type="text" name="preparedBy" class="form-control"
                                                   value="{{old('preparedBy', $productRecipe->preparedBy)}}" required>
                                        </div>
                                        @error('preparedBy')
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
                    <select class="form-control" name="materialType[]">
                        <option>API</option>
                        <option>Excipient</option>
                        <option>Chemical</option>
                    </select>
                </td>
                <td><input type="number" class="form-control" name="quantity[]" required></td>
                <td>
                    <select class="form-control" name="measuring[]">
                        <option>KG</option>
                        <option>Liters</option>
                        <option>Pieces</option>
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
                        url: "{{ route('get.item.codes.recipe') }}",
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
                    url: "{{ route('get.product.codes') }}",
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
