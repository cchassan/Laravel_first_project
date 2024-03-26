@extends('layouts.app')

@section('content')

    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Material Receiving Report</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active">Material Receiving Report</li>
                    </ul>
                    @can('material-record-Entry-create')
                        <a href="{{route('material.Receiving.Form')}}"> <button class="btn btn-sm btn-primary" style="background: #446433; border: #0b2e13;">Create Material Receive Report</button></a>
                    @endcan
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Material Entry Records</h2>
                            <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                <li><a href="javascript:void(0);" class="full-screen"><i class="icon-size-fullscreen"></i></a></li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table id="material_Receive_table" class="table table-bordered table-hover material_Receive_table" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Serial Number</th>
                                        <th scope="col">MRR Code</th>
                                        <th scope="col">PO Number</th>
                                        <th scope="col">Vendor Number</th>
                                        <th scope="col">Item Code</th>
                                        <th scope="col">Unit</th>
                                        <th scope="col">Supplier</th>
                                        <th scope="col">Batch No.</th>
                                        <th scope="col">MFG Date</th>
                                        <th scope="col">EXP Date</th>
                                        <th scope="col">Warehouse</th>
                                        <th scope="col">Total Quantity</th>
                                        <th scope="col">No. of Package</th>
                                        <th scope="col">Delivery Challan Number</th>
                                        <th scope="col">COA Attached</th>
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

    <div class="modal fade" id="materialEntryRecordDetail" tabindex="-1" role="dialog" aria-labelledby="materialEntryRecordDetail" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Material Receiving Report</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body m-2">
                    <div class="col-md-12">
                        <h6> Serial Number: </h6>
                        <h6 class="font-weight-normal" id="serialNumber"></h6>
                        <h6> Mrr Code: </h6>
                        <h6 class="font-weight-normal" id="mrrCode"></h6>
                        <h6> PO Number: </h6>
                        <h6 class="font-weight-normal" id="poNumber"></h6>
                        <h6> Vendor Number: </h6>
                        <h6 class="font-weight-normal" id="vendorNumber"></h6>
                        <h6> Item Code: </h6>
                        <h6 class="font-weight-normal" id="itemCode"></h6>
                        <h6> Item Description: </h6>
                        <h6 class="font-weight-normal" id="itemDescription"></h6>
                        <h6> Manufacturer Name: </h6>
                        <h6 class="font-weight-normal" id="manufacturerName"></h6>
                        <h6> Manufacturer Name: </h6>
                        <h6 class="font-weight-normal" id="manufacturerName"></h6>
                    </div>
                    <div class="row"><h6 class="col-md-6">Prepared By:</h6><h6 class=" font-weight-normal col-md-12" id="preparedBy"></h6></div><br>
                    <div class="row"><h6 class="col-md-6">Date:</h6><h6 class=" font-weight-normal col-md-6" id="date"></h6></div><br>
                    <div class="row"><h6 class="col-md-6">Remarks:</h6><h6 class="font-weight-normal col-md-12" id="remarks"></h6></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')

    <script>
        $(document).ready(function (){

            $('#material_Receive_table').dataTable({
                processData: true,
                serverSide: true,
                ajax: "{{route('material.Receiving.Report')}}",
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
                    {data : 'mrrCode'},
                    {data : 'poNumber'},
                    {data : 'vendorNumber'},
                    {
                        data : 'material_item',
                        name: 'Item Code'
                    },
                    {data : 'unitOfMeasuring'},
                    {data : 'supplier'},
                    {data : 'batchNo'},
                    {data : 'mfgDate'},
                    {data : 'expDate'},
                    {
                        data : 'warehouse_location',
                        name: 'Warehouse'
                    },
                    {data : 'totalQuantity'},
                    {data : 'numberOfPackage'},
                    {data : 'deliveryChallanNumber'},
                    {data : 'coaAttached'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });

        $('body').on('click', '.viewBtn', function (){
            var id = $(this).data('id');
            var sr = $(this).data('sr');
            var mrr = $(this).data('mrrcode');
            var po = $(this).data('ponumber');
            var vn = $(this).data('vendornumber');
            var itemCode = $(this).data('itemcode');
            var itemDescription = $(this).data('itemdescription');
            var manufacturerName = $(this).data('manufacturername');
            var manufacturerAddress = $(this).data('manufactureraddress');
            var preparedBy = $(this).data('preparedby');
            var date = $(this).data('date');
            var remarks = $(this).data('remarks');
            $('#materialEntryRecordDetail').modal('show');
            $('#mrrCode').html(mrr);
            $('#poNumber').html(po);
            $('#vendorNumber').html(vn);
            $('#serialNumber').html(sr);
            $('#itemCode').html(itemCode);
            $('#itemDescription').html(itemDescription);
            $('#manufacturerName').html(manufacturerName);
            $('#manufacturerAddress').html(manufacturerAddress);
            $('#preparedBy').html(preparedBy);
            $('#date').html(date);
            $('#remarks').html(remarks);


        });
    </script>

@endpush
