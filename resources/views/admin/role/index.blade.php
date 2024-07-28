@extends('admin.Master')
@section('title')
    {{ $title }}
@endsection
@section('content')
    <div class="page-body">
        <!-- Page content area start -->
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="breadcrumb__content">
                            <div class="breadcrumb__content__left">
                                <div class="breadcrumb__title">
                                    <h2>{{ __('Roles') }}</h2>
                                </div>
                            </div>
                            <div class="breadcrumb__content__right">
                                <nav aria-label="breadcrumb">
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a
                                                href="{{ url('admin\dashboard') }}">{{ __('Dashboard') }}</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">{{ __('Roles') }}</li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h2>{{ __('Roles') }}</h2>
                                <a href="{{ route('role.create') }}" class="btn btn-success btn-sm pull-right"> <i
                                        class="fa fa-plus"></i> {{ __('Add Role') }} </a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    @if(Session::has('success'))
                                    <div class="alert alert-success">
                                        <p>{{session::get('success')}}</p>
                                    </div>
                                    @endif
                                    @if(Session::has('fail'))
                                    <div class="alert alert-danger">
                                        <p>{{session::get('fail')}}</p>
                                    </div>
                                    @endif
                                    <table id="advance-1" class="row-border data-table-filter table-style">
                                        <thead>
                                            <tr>
                                                <td class="text-center">#</td>
                                                <th>{{ __('Name') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($roles as $role)
                                                <tr class="removable-item">
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td>
                                                        {{ $role->name }}
                                                    </td>
                                                    <td>
                                                        <div class="action__buttons">
                                                            <a href="{{ route('role.edit', [$role->id]) }}"
                                                                class="btn btn-icon waves-effect waves-light btn-success m-b-5 m-r-5"
                                                                data-toggle="tooltip"> <i class="fa fa-edit"></i>
                                                            </a>
                                                            <a href="javascript:void(0);"
                                                                data-url="{{ route('role.delete', [$role->id]) }}"
                                                                class="btn btn-icon waves-effect waves-light btn-danger m-b-5 delete-category"
                                                                data-toggle="tooltip" title="{{ trans('remove') }}"
                                                                data-url="{{ route('role.delete', [$role->id]) }}">
                                                                <i class="fa fa-remove"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="mt-3">
                                        {{ $roles->links() }}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- Page content area end -->
    </div>
@endsection
