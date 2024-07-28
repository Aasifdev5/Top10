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
                                    <h2>{{ __('Add Role') }}</h2>
                                </div>
                            </div>
                            <div class="breadcrumb__content__right">
                                <nav aria-label="breadcrumb">
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a
                                                href="{{ url('admin\dashboard') }}">{{ __('Dashboard') }}</a></li>
                                        <li class="breadcrumb-item"><a
                                                href="{{ url('admin\role') }}">{{ __('Roles') }}</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">{{ __($title) }}</li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="card card-absolute">
                        <div class="card-header bg-secondary">

                            <h5>{{ __('Add Role') }}</h5>

                        </div>
                        <div class="card-body">

                            <form action="{{ route('role.store') }}" method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="custom-form-group mb-3 row">
                                    <label for="name" class="col-lg-3 text-lg-right text-black"> {{ __('Name') }}
                                    </label>
                                    <div class="col-lg-9">
                                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                                            class="form-control flat-input" placeholder="{{ __('Name') }}">
                                        @if ($errors->has('name'))
                                            <span class="text-danger"><i class="fas fa-exclamation-triangle"></i>
                                                {{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="custom-form-group mb-3 row">
                                    <label for="name" class="col-lg-3 text-lg-right text-black">
                                        {{ __('Select Permission') }} </label>
                                    <div class="col-lg-9">
                                        <div class="row text-black">
                                            <div class="permissions-tree">
                                                @foreach ($permissions as $permission)
                                                <div class="permission">
                                                    <input class="form-check-input parent-permission" type="checkbox" name="permissions[]"
                                                        id="permission{{ $permission->id }}" value="{{ $permission->id }}">
                                                    <label class="form-check-label m-lg-1 mb-0 color-heading"
                                                        for="permission{{ $permission->id }}">{{ ucwords(str_ireplace('_', ' ', $permission->name)) }}</label>

                                                    <!-- Sub-permissions -->
                                                    <ul class="sub-permissions">
                                                        @foreach ($permission->children as $subPermission)
                                                        <li class="sub-permission">
                                                            <input class="form-check-input" type="checkbox" name="permissions[]"
                                                                id="permission{{ $subPermission->id }}" value="{{ $subPermission->id }}">
                                                            <label class="form-check-label m-lg-1 mb-0 color-heading"
                                                                for="permission{{ $subPermission->id }}">{{ ucwords(str_ireplace('_', ' ', $subPermission->name)) }}</label>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                @endforeach
                                            </div>

                                            <style>
                                                .permissions-tree {
                                                    font-family: Arial, sans-serif;
                                                }

                                                .permission {
                                                    margin-bottom: 10px;
                                                }

                                                .permission label {
                                                    display: inline-block;
                                                    margin-left: 10px;
                                                    vertical-align: middle;
                                                }

                                                .sub-permissions {
                                                    margin-left: 20px;
                                                    padding-left: 10px;
                                                    border-left: 1px solid #ccc;
                                                    list-style: none;
                                                }

                                                .sub-permissions .sub-permission {
                                                    margin-bottom: 5px;
                                                }

                                                .sub-permissions label {
                                                    margin-left: 5px;
                                                }
                                            </style>

                                            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                            <script>
                                                $(document).ready(function() {
                                                    // Toggle visibility of sub-permissions on parent permission click
                                                    $('.permission .parent-permission').change(function() {
                                                        $(this).siblings('.sub-permissions').toggle();
                                                    });

                                                    // Toggle visibility of sub-permissions on sub-permission click
                                                    $('.sub-permission input[type="checkbox"]').change(function() {
                                                        $(this).closest('.permission').find('.parent-permission').prop('checked', true);
                                                    });
                                                });
                                            </script>

                                        </div>
                                        @if ($errors->has('permissions'))
                                            <span class="text-danger"><i class="fas fa-exclamation-triangle"></i>
                                                {{ $errors->first('permissions') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12 text-right">
                                        <button class="btn btn-primary" type="submit">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <!-- Page content area end -->
    </div>
@endsection
