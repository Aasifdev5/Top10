@extends('admin.Master')
@section('title')
LISTA DE BANNERS
@endsection
@section('content')

<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <div class="page-header-left">
                        <h3>Social Citas</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard"><i data-feather="home"></i></a></li>

                            <li class="breadcrumb-item">Banner</li>

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
                    <div class="card-header">
                        <h5> LISTA DE BANNERS</h5>
                        <a class="btn btn-pill btn-primary btn-air-primary pull-right" href="{{ route('admin.banners.create') }}" data-toggle="tooltip" title="" role="button" data-bs-original-title="btn btn-primary">Agregar banner</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="advance-1">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th> Nombre</th>
                                        <th>Banner</th>
                                        <th>Acción</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    ?>
                                    @foreach ($banners as $row)
                                    <tr>
                                        <td class="text-center">{{ $count++ }}</td>
                                        <td>{{ $row->title }}</td>
                                        <td><img src="{{ asset('images/banners/' . $row->image) }}" alt="{{ $row->title }}" width="100" height="100"></td>
                                        <td>

                                            <a href="{{ route('admin.banners.edit', ['banner' => $row->id]) }}" class="btn btn-sm btn-success" type="submit">Editar</a>

                                            <a href="{{ route('admin.banners.destroy', ['banner' => $row->id]) }}" class="btn btn-sm btn btn-danger" type="submit" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $row->id }}').submit();">Eliminar</a>

                                            <!-- Delete Form -->
                                            <form id="delete-form-{{ $row->id }}" action="{{ route('admin.banners.destroy', ['banner' => $row->id]) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
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
