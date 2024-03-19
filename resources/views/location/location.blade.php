@extends('layouts.app')

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('content')

    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Locations</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active">Location</li>
                    </ul>
                    <button class="btn btn-sm btn-primary" style="background: #446433; border: #0b2e13;" data-toggle="modal" data-target="#modalAddLocation" id="addNewLocation">Add Location</button>
                </div>
            </div>
            <!-- Vertically centered -->
            <div class="modal fade" id="modalAddLocation" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <form id="locationForm">
                                <div class="modal-header">
                                <h5 class="modal-title" id="modal-Title"></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                                <div class="modal-body">
                                <div class="row ">
                                    <div class="col-md-12 mt-1">
                                        <input type="hidden" name="locationId" id="locationId">
                                        <div class="form-group">
                                            <label for="location-name">Location<span class="text-danger"> *</span></label>
                                            <input type="text" name="location_name" class="form-control autocomplete"
                                                   id="location_name" value="{{old('location_name')}}" required>
                                        </div>
                                        <span class="text-danger errorMessages" id="nameError"></span>
                                    </div>
                                </div>
                            </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="saveBtn"  style="background: #0b2e13; border: none"></button>
                            </div>
                            </form>
                        </div>
                        </div>


                    </div>
            </div>
        <div class="container-fluid">

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Locations</h2>
                            <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                <li><a href="javascript:void(0);" class="full-screen"><i class="icon-size-fullscreen"></i></a></li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table id="location_table" class="table table-bordered table-hover location_table" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th scope="col">Sr. #</th>
                                        <th scope="col">Name</th>
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
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $('#addNewLocation').click(function (){
                $('#modal-Title').html('Add Location');
                $('#saveBtn').html('Save Location');
                $('#location_name').val("");
                $('#locationId').val("");
            });

            locationTable();
            $('#modal-Title').html('Add Location');
            $('#saveBtn').html('Save Location');
            $form = $('#locationForm')[0];
            $('#saveBtn').click(function(){
                var formData = new FormData($form);
                $('.errorMessages').html('');
                $.ajax({
                    url: '{{route("location.store")}}',
                    method: 'POST',
                    processData: false,
                    contentType: false,
                    data: formData ,
                    success: function(response){
                        $('#location_name').val("");
                        $('#locationId').val("");
                        console.log(response.success);
                        $('#modalAddLocation').modal('hide');
                        toastr["success"](response.success);
                        $('.location_table').DataTable().ajax.reload(
                            function(json) {
                                // Update the index column
                                var table = $('.location_table').DataTable();
                                table.column(0, {search:'applied', order:'applied'}).nodes().each(function(cell, i) {
                                    cell.innerHTML = i + 1;
                                });
                            });
                    },
                    error: function(error){
                        console.log(error);
                        if(error){
                            $('#nameError').html(error.responseJSON.errors.location_name);
                        }
                    },
                });
            });

            $('body').on('click', '.editBtn', function (){
                var id = $(this).data('id');
                $.ajax({
                    url: '{{ url("location", '') }}' + '/' + id + '/edit',
                    method: 'GET',
                    success: function (response){
                        $('#modalAddLocation').modal('show');
                        $('#modal-Title').html('Edit Location');
                        $('#saveBtn').html('Update');
                        $('#location_name').val(response.locationName);
                        $('#locationId').val(response.id);
                    },
                    error: function (error){
                        console.log(error);
                    }

                });

            });

            $('body').on('click', '.delBtn', function (e){
                e.preventDefault();
                var id = $(this).data('id');

                swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this imaginary file!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#dc3545",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel plx!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                }, function (isConfirm) {
                    if (isConfirm) {

                        $.ajax({
                            url: '{{ url("location", '') }}' + '/' + id + '/delete',
                            method: 'GET',
                            success: function (response){
                                swal.close(); // Close the SweetAlert dialog
                                toastr["success"](response.success);
                                $('.location_table').DataTable().ajax.reload(function(json) {
                                    // Update the index column
                                    var table = $('.location_table').DataTable();
                                    table.column(0, {search:'applied', order:'applied'}).nodes().each(function(cell, i) {
                                        cell.innerHTML = i + 1;
                                    });
                                });
                            },
                            error: function (error){
                                console.log(error);
                            }

                        });
                    } else {
                        swal("Cancelled", "Your imaginary file is safe :)", "error");
                    }
                });
            });
        });

        function locationTable(){
            $('.location_table').dataTable({
                processData: true,
                serverSide : true,
                ajax: "{{route('location')}}",
                columns: [
                    {
                        data: null,
                        name: 'index',
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row, meta) {
                            return meta.row + 1; // Start index from 1
                        }
                    },
                    {data : 'locationName'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        }

    </script>
@endpush
