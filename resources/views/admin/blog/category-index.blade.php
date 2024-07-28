@extends('admin.Master')
@section('title')
    {{ $title }}
@endsection
@section('content')
    <!-- Page content area start -->
    <div class="page-body">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="breadcrumb__content">
                            <div class="breadcrumb__content__left">
                                <div class="breadcrumb__title">
                                    <h2>{{ __('Blogs') }}</h2>
                                </div>
                            </div>
                            <div class="breadcrumb__content__right">
                                <nav aria-label="breadcrumb">
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a
                                                href="{{ url('admin/dashboard') }}">{{ __('Panel') }}</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">{{ __('Blogs') }}</li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            @if (Session::has('success'))
                                <div class="alert alert-success">
                                    <p>{{ session::get('success') }}</p>
                                </div>
                            @endif
                            @if (Session::has('fail'))
                                <div class="alert alert-danger">
                                    <p>{{ session::get('fail') }}</p>
                                </div>
                            @endif
                            <div class="card-header">
                                <h2>{{ __('Blog Category') }}</h2>
                                <button class="btn btn-success btn-sm pull-right" type="button" data-bs-toggle="modal"
                                    data-bs-target="#add-todo-modal">
                                    <i class="fa fa-plus"></i> {{ __('Agregar Categoría de Blog') }}
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="advance-1" class="row-border data-table-filter table-style">
                                        <thead>
                                            <tr>
                                                <th>{{ __('Nombre') }}</th>
                                                <th>{{ __('Estado') }}</th>
                                                <th>{{ __('Acción') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($blogCategories as $category)
                                                <tr class="removable-item">
                                                    <td>
                                                        {{ $category->name }}
                                                    </td>
                                                    <td>
                                                        @if ($category->status == 1)
                                                            <span class="status bg-green">{{ __('Activo') }}</span>
                                                        @else
                                                            <span class="status bg-red">{{ __('Desactivado') }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="action__buttons">
                                                            {{-- <a data-item="{{ $category }}" href="#"
                                                            data-updateurl="{{ route('blog.blog-category.update', $category->uuid) }}"
                                                            data-toggle="tooltip" title="Edit"
                                                            class="edit btn btn-icon waves-effect waves-light btn-success m-b-5 m-r-5"
                                                            data-bs-toggle="modal" data-bs-target="#edit-blog-category-modal">
                                                            <i class="fa fa-edit"></i>
                                                        </a> --}}
                                                            <a href="{{ route('blog.blog-category.delete', [$category->uuid]) }}"
                                                                class="btn btn-icon waves-effect waves-light btn-danger m-b-5"
                                                                onclick="return confirm('{{ trans('do you want to delete') }}')"
                                                                data-toggle="tooltip" title="{{ trans('remove') }}"> <i
                                                                    class="fa fa-remove"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="mt-3">
                                        {{ $blogCategories->links() }}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- Page content area end -->

        <!-- Add Modal section start -->
        <div class="modal fade" id="add-todo-modal" aria-hidden="true" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Add Blog Category') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('blog.blog-category.store') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="input__group mb-30">
                                <label for="name">{{ __('Name') }}</label>
                                <input type="text" name="name" class="form-control" id="name"
                                    placeholder="{{ __('Type name') }}" value="" required>
                                @if ($errors->has('name'))
                                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i>
                                        {{ $errors->first('name') }}</span>
                                @endif
                            </div>

                            <div class="input__group mb-30">
                                <label for="status" class="text-lg-right text-black"> {{ __('Status') }} </label>
                                <select name="status" id="status" class="form-control">
                                    <option value="">--{{ __('Select Option') }}--</option>
                                    <option value="1">{{ __('Active') }}</option>
                                    <option value="0">{{ __('Deactivated') }}</option>
                                </select>
                            </div>
                            <br>
                            <div>
                                <button type="submit" class="btn btn-primary btn-purple">{{ __('Save') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Add Modal section end -->



        <!-- Edit Modal section start -->
        <div class="modal fade" id="edit-blog-category-modal" aria-hidden="true" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Edit Blog Category') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="updateEditModal" method="post">
                        @csrf
                        @method('patch')
                        <div class="modal-body">
                            <div class="input__group mb-30">
                                <label for="edit_name">{{ __('Name') }}</label>
                                <input type="text" name="name" class="form-control" id="edit_name" placeholder="{{ __('Type name') }}" value="" required>
                                @if ($errors->has('name'))
                                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i>
                                        {{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="input__group mb-30">
                                <label for="edit_status" class="text-lg-right text-black">{{ __('Status') }}</label>
                                <select name="status" id="edit_status" class="form-control">
                                    <option value="">--{{ __('Select Option') }}--</option>
                                    <option value="1">{{ __('Active') }}</option>
                                    <option value="0">{{ __('Deactivated') }}</option>
                                </select>
                            </div>
                            <br>
                            <div>
                                <button type="submit" class="btn btn-primary btn-purple">{{ __('Update') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Edit Modal section end -->



    </div>
@endsection



@push('script')
    <script>
       $(function() {
        'use strict';
        $('.edit').on('click', function(e) {
            e.preventDefault();
            const modal = $('#edit-blog-category-modal');
            const category = $(this).data('item');
            modal.find('input[name=name]').val(category.name);
            modal.find('select[name=status]').val(category.status);
            const route = $(this).data('updateurl');
            $('#updateEditModal').attr('action', route);
            modal.modal('show');
        });
    });
    </script>
@endpush
