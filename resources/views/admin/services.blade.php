@extends('admin.Master')
@section('title')
    Lista de Proyectos
@endsection
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <div class="page-header-left">
                            <h3>ACELERA</h3>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item">Gestión de Proyectos</li>
                                <li class="breadcrumb-item">Lista de Proyectos</li>

                            </ol>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
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
                            <h5> Lista de Proyectos </h5>
                            {{-- <a class="btn btn-pill btn-primary btn-air-primary pull-right" href="Add_Course_list"
                                data-toggle="tooltip" title="" role="button"
                                data-bs-original-title="btn btn-primary">Agregar Proyecto
                            </a> --}}
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display" id="advance-1">
                                    <thead>
                                        <tr>
                                            <th class="">#</th>
                                            <!-- <th>id</th> -->
                                            <th> Categoría </th>
                                            <th>Título</th>
                                            <th> Imagen </th>

                                            <th>Estado</th>

                                            <th>Acción </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($courses as $row)
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



                                                <td>
                                                    <a href="{{ route('edit_courses', ['id' => $row->id]) }}"
                                                        class="btn btn-sm btn-success" type="submit">Editar </a>
                                                    <a href="{{ route('Delete_course', ['id' => $row->id]) }}"
                                                        class="btn btn-sm btn btn-danger" type="submit">Eliminar</a>
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


@endsection
