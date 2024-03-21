@extends('layouts.app')

@section('content')

<div id="main-content">
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h2>Material Entry Record Report</h2>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active">Material Entry Record Report</li>
                </ul>
                @can('material-record-Entry-create')
                <a href="{{route('material.Entry.Record')}}"> <button class="btn btn-sm btn-primary" style="background: #446433; border: #0b2e13;">Create Material Entry Record</button></a>
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
                            <table id="material_entry_record_table" class="table table-bordered table-hover material_entry_record_table" style="width:100%">
                                <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Serial Number</th>
                                    <th scope="col">Item Code</th>
                                    <th scope="col">Item Description</th>
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
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Material Entry Record Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body m-2">
                <div class="row"><h6 class="col-md-6">Serial Number:</h6> <h6 class="font-weight-normal col-md-6" id="serialNumber"></h6></div><br>
                <div class="row"><h6 class="col-md-6">Item Code:</h6><h6 class=" font-weight-normal col-md-6" id="itemCode"></h6></div><br>
                <div class="row"><h6 class="col-md-6">Item Description:</h6><h6 class=" font-weight-normal col-md-12" id="itemDescription"></h6></div><br>
                <div class="row"><h6 class="col-md-6">Manufacturer Name:</h6><h6 class=" font-weight-normal col-md-12" id="manufacturerName"></h6></div><br>
                <div class="row"><h6 class="col-md-6">Manufacturer Address:</h6><h6 class=" font-weight-normal col-md-12" id="manufacturerAddress"></h6></div><br>
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

            $('#material_entry_record_table').dataTable({
                processData: true,
                serverSide: true,
                ajax: "{{route('material.Entry.Record.Report')}}",
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
                    {data : 'itemCode'},
                    {data : 'itemDescription'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });

        $('body').on('click', '.viewBtn', function (){
            var id = $(this).data('id');
            var sr = $(this).data('sr');
            var itemCode = $(this).data('itemcode');
            var itemDescription = $(this).data('itemdescription');
            var manufacturerName = $(this).data('manufacturername');
            var manufacturerAddress = $(this).data('manufactureraddress');
            var preparedBy = $(this).data('preparedby');
            var date = $(this).data('date');
            var remarks = $(this).data('remarks');
            $('#materialEntryRecordDetail').modal('show');
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
