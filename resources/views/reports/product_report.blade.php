@extends('layouts.app')

@section('content')

    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Products Report</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active">Products Report</li>
                    </ul>
                    @can('product-create')
                        <a href="{{route('product.create')}}"> <button class="btn btn-sm btn-primary" style="background: #446433; border: #0b2e13;">Create Product</button></a>
                    @endcan
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Products</h2>
                            <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                <li><a href="javascript:void(0);" class="full-screen"><i class="icon-size-fullscreen"></i></a></li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table id="product_table" class="table table-bordered table-hover product_table" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Serial Number</th>
                                        <th scope="col">Product Code</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Generic Name</th>
                                        <th scope="col">Strength</th>
                                        <th scope="col">fill Volume</th>
                                        <th scope="col">Batch Size liter</th>
                                        <th scope="col">Batch Size (No. of Vials)</th>
                                        <th scope="col">Route of Administration</th>
                                        <th scope="col">Secondary Packaging Format</th>
                                        <th scope="col">Prepared By</th>
                                        <th scope="col">Added By</th>
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
    </div>

@endsection

@push('scripts')

    <script>
        $(document).ready(function (){

            $('#product_table').dataTable({
                processData: true,
                serverSide: true,
                ajax: "{{route('product.Report')}}",
                columns: [
                    {
                        data: null,
                        name: 'No.',
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row, meta) {
                            return meta.row + 1; // Start index from 1
                        }
                    },
                    {data : 'serialNumber'},
                    {data : 'product_code'},
                    {data : 'product_name'},
                    {data : 'generic_name'},
                    {data : 'strength'},
                    {data : 'fill_volume'},
                    {data : 'batch_size_liter'},
                    {data : 'batch_size_vial'},
                    {
                        data : 'route_administration',
                        name: 'Route of Administration'
                    },
                    {
                        data : 'secondary_packaging_format',
                        name: 'Secondary Packaging Format'
                    },
                    {data : 'preparedBy'},
                    {data : 'addedBy'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script>

@endpush
