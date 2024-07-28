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
                                    <h2>{{ __('Edit Permission') }}</h2>
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
                            <div class="item-top mb-30">
                                <h5>{{ __('Edit Permission') }}</h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-horizontal__item bg-style">

                                <form action="{{ route('permissions.update', $permission->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="name">Permission Name</label>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter permission name" value="{{ $permission->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="parent_id">Parent Permission</label>
                                        <select name="parent_id" id="parent_id" class="form-control">
                                            <option value="">Select Parent Permission</option>
                                            @foreach($permissions as $parent)
                                                <option value="{{ $parent->id }}" @if($permission->parent_id == $parent->id) selected @endif>
                                                    {{ $parent->name }}
                                                </option>
                                                @if($parent->children->isNotEmpty())
                                                    @include('admin.partials.child_options', ['children' => $parent->children, 'selectedId' => $permission->parent_id ?? null])
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <br>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- Page content area end -->
    </div>
@endsection
