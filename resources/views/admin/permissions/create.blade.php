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
                                    <h2>{{ __('Create Permission') }}</h2>
                                </div>
                            </div>
                            <div class="breadcrumb__content__right">
                                <nav aria-label="breadcrumb">
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a
                                                href="{{ url('admin\dashboard') }}">{{ __('Dashboard') }}</a></li>
                                        <li class="breadcrumb-item"><a
                                                href="#">{{ __('Permission') }}</a></li>
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

                            <h5>{{ __('Create Permission') }}</h5>

                        </div>
                        <div class="card-body">

                            <h2>Create Permission</h2>
                            <form action="{{ route('permissions.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Permission Name</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="Enter permission name">
                                </div>
                                <div class="form-group">
                                    <label for="parent_id">Parent Permission</label>
                                    <select name="parent_id" id="parent_id" class="form-control">
                                        <option value="">Select Parent Permission</option>
                                        @foreach ($permissions as $permission)
                                            <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <!-- Page content area end -->
    </div>
@endsection
