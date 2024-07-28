@extends('master')
@section('title')
{{ __('Mis Proyectos Pendientes') }}
@endsection
@section('content')
<div class="page-body">

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">

            <div class="col-sm-12">
                <div class="card">
                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            <p>{{ Session::get('success') }}</p>
                        </div>
                    @endif
                    @if (Session::has('fail'))
                        <div class="alert alert-danger">
                            <p>{{ Session::get('fail') }}</p>
                        </div>
                    @endif
                    <div class="card-header">
                        <h5>{{ __('Lista de Proyectos Pendientes') }}  </h5>
                        <br>
                        <a class="btn btn-pill btn-primary btn-air-primary pull-right" href="{{ url('dashboard') }}"
                            data-toggle="tooltip" title="" role="button"
                            data-bs-original-title="btn btn-primary">{{ __('Volver') }}
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="advance-1">
                                <thead>
                                    <tr>
                                        <th class="">#</th>
                                        <!-- <th>id</th> -->

                                        <th> {{ __('Categoría') }} </th>
                                        <th>{{ __('Título') }}</th>
                                        <th> {{ __('Imagen') }} </th>

                                        <th>{{ __('Estado') }}</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($campaign as $row)
                                        @php
                                            $category = \App\Models\Category::find($row->category_id)->name;

                                        @endphp
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $category }}</td>
                                            <td>{{ $row->title }}</td>
                                            <td>
                                                @if (!empty($row->image))
                                                <img src="{{ $row->image ? asset($row->image) : '' }}" id="image_preview" style="max-width: 100%; max-height: 200px;" />
                                                @endif
                                            </td>

                                            <td style="color: {{ $row->status == '0' ? 'orange' : ($row->status == '1' ? 'green' : 'red') }}">
                                                {{ $row->status == '0' ? 'Pending' : ($row->status == '1' ? 'Approved' : 'Blocked') }}
                                            </td>





                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- DOM / jQuery  Ends-->


        </div>
    </div>
    <!-- Container-fluid Ends-->
    <!-- Container-fluid Ends-->
</div>
<br>
@endsection
