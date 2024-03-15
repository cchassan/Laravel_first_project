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
                            {{ $dataTable->table() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

@push('scripts')
    {{$dataTable -> scripts() }}
@endpush
