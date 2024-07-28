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
                                    <h2>{{ __('Permission') }}</h2>
                                </div>
                            </div>
                            <div class="breadcrumb__content__right">
                                <nav aria-label="breadcrumb">
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a
                                                href="{{ url('admin\dashboard') }}">{{ __('Dashboard') }}</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">{{ __('Permission') }}</li>
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
                                <h2>{{ __('Permission') }}</h2>
                                <a href="{{ route('permissions.create') }}" class="btn btn-success btn-sm pull-right"> <i
                                        class="fa fa-plus"></i> {{ __('Add Permissions') }} </a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
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
                                    <table id="advance-1" class="row-border data-table-filter table-style">
                                        <thead>
                                            <tr>
                                                <td class="text-center">#</td>
                                                <th>{{ __('Name') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($permissions as $permission)
                                                <tr class="removable-item">
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td>
                                                        {{ $permission->name }}
                                                    </td>
                                                    <td>
                                                        <div class="action__buttons">
                                                            <a href="{{ route('permissions.edit', ['id' => $permission->id]) }}"
                                                                class="btn btn-icon waves-effect waves-light btn-success m-b-5 m-r-5"
                                                                data-toggle="tooltip" title="{{ __('Edit') }}">
                                                                <i class="fa fa-edit"></i>
                                                             </a>




                                                          <a href="#"
                                                          class="btn btn-icon waves-effect waves-light btn-danger m-b-5 delete-link"
                                                          data-id="{{ $permission->id }}" data-toggle="tooltip"
                                                          title="{{ trans('remove') }}">
                                                          <i class="fa fa-remove"></i>
                                                      </a>

                                                      <form id="delete-form-{{ $permission->id }}"
                                                          action="{{ route('permissions.delete', $permission->id) }}"
                                                          method="POST" style="display: none;">
                                                          @csrf
                                                          @method('DELETE')
                                                      </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="mt-3">

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
<script>
    // Initialize Toastr with options
toastr.options = {
    "timeOut": 5000, // Set the duration to 5 seconds (5000 milliseconds)
    "positionClass": "toast-bottom-right"
};

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.delete-link').forEach(function (element) {
        element.addEventListener('click', function (event) {
            event.preventDefault();

            if (confirm('{{ trans('do you want to delete') }}')) {
                const form = document.getElementById('delete-form-' + this.dataset.id);

                // Send AJAX request
                axios.post(form.action, new FormData(form))
                    .then(function (response) {
                        if (response.data.success) {
                            toastr.success(response.data.message);
                            // Wait for the Toastr message to be visible before reloading the page
                            setTimeout(function () {
                                window.location.reload();
                            }, 5000); // 5000 milliseconds = 5 seconds
                        }
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            }
        });
    });
});
</script>
@endsection
