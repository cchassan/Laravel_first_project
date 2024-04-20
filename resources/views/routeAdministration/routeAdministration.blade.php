@extends('layouts.app')

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('content')

    <div id="main-content">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h2>Route Administration</h2>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active">Route Administration</li>
                    </ul>
                    @can('routeAdministration-create')
                        <button class="btn btn-sm btn-primary" style="background: #446433; border: #0b2e13;" data-toggle="modal" data-target="#modalAddRouteAdministration" id="addNewRouteAdministration">Add Route Administration</button>
                    @endcan
                </div>
            </div>
            <!-- Vertically centered -->
            <div class="modal fade" id="modalAddRouteAdministration" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form id="routeAdministrationForm">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-Title"></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row ">
                                    <div class="col-md-12 mt-1">
                                        <input type="hidden" name="routeAdministrationId" id="routeAdministrationId">
                                        <div class="form-group">
                                            <label for="routeAdministration-name">Route Administration<span class="text-danger"> *</span></label>
                                            <input type="text" name="routeAdministration_name" class="form-control autocomplete"
                                                   id="routeAdministration_name" value="{{old('routeAdministration_name')}}" required>
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
                            <h2>Route Administration</h2>
                            <ul class="header-dropdown dropdown dropdown-animated scale-left">
                                <li><a href="javascript:void(0);" class="full-screen"><i class="icon-size-fullscreen"></i></a></li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table id="routeAdministration_table" class="table table-bordered table-hover routeAdministration_table" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th scope="col">Sr. #</th>
                                        <th scope="col">Route Administration Name</th>
                                        @if (Gate::check('routeAdministration-edit') || Gate::check('routeAdministration-delete'))
                                            <th scope="col">Action</th>
                                        @endif
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


            $('#addNewRouteAdministration').click(function (){
                $('#modal-Title').html('Add Route Administration');
                $('#saveBtn').html('Save Route Administration');
                $('#routeAdministration_name').val("");
                $('#routeAdministrationId').val("");
            });

            routeAdministrationTable();
            $('#modal-Title').html('Add Route Administration');
            $('#saveBtn').html('Save Route Administration');
            $form = $('#routeAdministrationForm')[0];
            $('#saveBtn').click(function(){
                var formData = new FormData($form);
                $('.errorMessages').html('');
                $.ajax({
                    url: '{{route("routeAdministration.store")}}',
                    method: 'POST',
                    processData: false,
                    contentType: false,
                    data: formData ,
                    success: function(response){
                        $('#routeAdministration_name').val("");
                        $('#routeAdministrationId').val("");
                        console.log(response.success);
                        $('#modalAddRouteAdministration').modal('hide');
                        toastr["success"](response.success);
                        $('.routeAdministration_table').DataTable().ajax.reload(
                            function(json) {
                                // Update the index column
                                var table = $('.routeAdministration_table').DataTable();
                                table.column(0, {search:'applied', order:'applied'}).nodes().each(function(cell, i) {
                                    cell.innerHTML = i + 1;
                                });
                            });
                    },
                    error: function(error){
                        console.log(error);
                        if(error){
                            $('#nameError').html(error.responseJSON.errors.routeAdministration_name);
                        }
                    },
                });
            });

            $('body').on('click', '.editBtn', function (){
                var id = $(this).data('id');
                $.ajax({
                    url: '{{ url("routeAdministration", '') }}' + '/' + id + '/edit',
                    method: 'GET',
                    success: function (response){
                        $('#modalAddRouteAdministration').modal('show');
                        $('#modal-Title').html('Edit Route Administration');
                        $('#saveBtn').html('Update');
                        $('#routeAdministration_name').val(response.routeAdministrationName);
                        $('#routeAdministrationId').val(response.routeAdministration_id);
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
                            url: '{{ url("routeAdministration", '') }}' + '/' + id + '/delete',
                            method: 'GET',
                            success: function (response){
                                swal.close(); // Close the SweetAlert dialog
                                toastr["success"](response.success);
                                $('.routeAdministration_table').DataTable().ajax.reload(function(json) {
                                    // Update the index column
                                    var table = $('.routeAdministration_table').DataTable();
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

        function routeAdministrationTable(){
            $('.routeAdministration_table').dataTable({
                processData: true,
                serverSide : true,
                ajax: "{{route('routeAdministration')}}",
                columns: [
                    {data : 'routeAdministration_id', name:'action', orderable: false,searchable: false},
                    {data : 'routeAdministrationName'},
                        @if (Gate::check('routeAdministration-edit') || Gate::check('routeAdministration-delete'))
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                    @endif
                ]
            });
        }

    </script>
@endpush
