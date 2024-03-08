@extends('layouts.app')


@section('content')
{{--    <div id="main-content">--}}
{{--        <div class="block-header">--}}
{{--            <div class="row">--}}
{{--        <div class="col-lg-12 margin-tb">--}}
{{--            <div class="pull-left">--}}
{{--                <h2>Role Management</h2>--}}
{{--            </div>--}}
{{--            <div class="pull-right">--}}
{{--                @can('role-create')--}}
{{--                    <a class="btn btn-success" href="{{ route('roles.create') }}"> Create New Role</a>--}}
{{--                @endcan--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--        </div>--}}

{{--    @if ($message = Session::get('success'))--}}
{{--        <div class="alert alert-success">--}}
{{--            <p>{{ $message }}</p>--}}
{{--        </div>--}}
{{--    @endif--}}

{{--        <div class="container-fluid">--}}
{{--            <table class="table table-bordered">--}}
{{--        <tr>--}}
{{--            <th>No</th>--}}
{{--            <th>Name</th>--}}
{{--            <th width="280px">Action</th>--}}
{{--        </tr>--}}
{{--        @foreach ($roles as $key => $role)--}}
{{--            <tr>--}}
{{--                <td>{{ ++$i }}</td>--}}
{{--                <td>{{ $role->name }}</td>--}}
{{--                <td>--}}
{{--                    <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">Show</a>--}}
{{--                    @can('role-edit')--}}
{{--                        <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit</a>--}}
{{--                    @endcan--}}
{{--                    @can('role-delete')--}}
{{--                        {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}--}}
{{--                        {!! Form::submit('Delete', ['class' => 'btn btn-danger', 'action' => '']) !!}--}}
{{--                        {!! Form::close() !!}--}}
{{--                    @endcan--}}
{{--                </td>--}}
{{--            </tr>--}}
{{--        @endforeach--}}
{{--    </table>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    {!! $roles->render() !!}--}}





<div id="main-content">
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
                <h2>Role Management</h2>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item">People</li>
                    <li class="breadcrumb-item active"><a href="{{route('roles.index')}}">Roles & Permissions</a></li>
                </ul>
                <a href="{{route('roles.create')}}" class="btn btn-sm btn-primary" style="background: #446433; border: #0b2e13;" >Create Roles</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2>Role Management <small>All registered roles and permissions</small></h2>
                        <ul class="header-dropdown dropdown dropdown-animated scale-left">
                            <li> <a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i class="icon-refresh"></i></a></li>
                            <li><a href="javascript:void(0);" class="full-screen"><i class="icon-size-fullscreen"></i></a></li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover js-basic-example dataTable table-custom">
                                <thead>
                                <tr>
                                    <th>Sr.#</th>
                                    <th>name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Sr.#</th>
                                    <th>name</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($roles as $index => $role)
                                    <tr>
                                        <td> {{$index +1}} </td>
                                        <td>{{$role->name}}</td>
                                        <td>
                                            <a href="{{route('roles.edit',$role->id)}}"><button class="btn btn-primary" style="background: #0b2e13; border: none"><i class="fa fa-pencil primary"></i></button></a>
                                            <form class="inlineblock"  id="olo-{{$role->id}}" action="{{route('roles.destroy', [$role->id])}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="dropdown-item btn btn-sm" onclick="confirmDelete('method','{{$role->id}}', 'null' )" title="Delete">
                                                    <i class="dripicons-trash pe-1"></i> Delete
                                                </button>
                                            </form>
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
</div>

@endsection
