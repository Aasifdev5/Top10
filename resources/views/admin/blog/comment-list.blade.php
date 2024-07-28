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
                                    <h2>{{ __('Comentario de Blog') }}</h2>
                                </div>
                            </div>
                            <div class="breadcrumb__content__right">
                                <nav aria-label="breadcrumb">
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{url('admin.dashboard')}}">{{__('Panel')}}</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">{{ __('Comentario de Blog') }}</li>
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
                                <h2>{{ __('Lista de Comentarios de Blog') }}</h2>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="advance-1" class="row-border data-table-filter table-style">
                                        <thead>
                                        <tr>
                                            <th>{{ __('Blog') }}</th>
                                            <th>{{ __('Usuario') }}</th>
                                            <th>{{ __('Comentario') }}</th>
                                            <th>{{ __('Estado') }}</th>
                                            <th>{{__('Acción')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($comments as $comment)
                                            <tr class="removable-item">
                                                <td>
                                                    {{@$comment->blog->title}}
                                                </td>
                                                <td>
                                                    <div class="admin-dashboard-blog-list-img">
                                                        <img src="{{asset(@$comment->user->image_path)}}" class="radius-3">
                                                    </div>
                                                    <div class="mt-1">{{ @$comment->user->name }}</div>
                                                </td>

                                                <td>{{ $comment->comment }}</td>
                                                <td>
                                                    <span id="hidden_id" style="display: none">{{$comment->id}}</span>
                                                    <select name="status" class="status label-inline font-weight-bolder mb-1 badge badge-info">
                                                        <option value="1" @if($comment->status == 1) selected @endif>{{ __('Activo') }}</option>
                                                        <option value="0" @if($comment->status != 1) selected @endif>{{ __('Desactivado') }}</option>
                                                    </select>
                                                </td>

                                                <td>
                                                    <div class="action__buttons">
                                                        <a href="javascript:void(0);" data-url="{{route('blog.blogComment.delete', [$comment->id])}}" title="Delete" class="btn-action delete">
                                                            <img src="{{asset('admin/images/icons/trash-2.svg')}}" alt="trash">
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="mt-3">
                                        {{@$comments->links()}}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Page content area end -->
@endsection



@push('script')

    <script>
        'use strict'
        $(".status").change(function () {
            var id = $(this).closest('tr').find('#hidden_id').html();
            var status_value = $(this).closest('tr').find('.status option:selected').val();
            console.log(id, status_value)
            Swal.fire({
                title: "{{ __('Are you sure to change status?') }}",
                text: "{{ __('You won`t be able to revert this!') }}",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "{{__('Yes, Change it!')}}",
                cancelButtonText: "{{__('No, cancel!')}}",
                reverseButtons: true
            }).then(function (result) {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: "{{route('blog.changeBlogCommentStatus')}}",
                        data: {"status": status_value, "id": id, "_token": "{{ csrf_token() }}",},
                        datatype: "json",
                        success: function (data) {
                            console.log(data);
                            toastr.success('', "{{ __('Blog Comment status has been updated') }}");
                        },
                        error: function () {
                            alert("Error!");
                        },
                    });
                } else if (result.dismiss === "cancel") {
                }
            });
        });
    </script>
@endpush
