@extends('admin.Master')
@section('title')
{{ $title }}
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
                                <li class="breadcrumb-item">{{ $title }} </li>


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
                            <div class="item-title d-flex justify-content-between">
                                <h2>{{__('Blog List')}}</h2>
                                <a href="{{route('blog.create')}}" class="btn btn-success btn-sm"> <i class="fa fa-plus"></i> {{__('Agregar Blog')}} </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered display" id="advance-1">
                                    <thead>
                                        <tr>
                                            <th>{{__('Imagen')}}</th>
                                            <th>{{__('Título')}}</th>
                                            <th>{{__('Categoría')}}</th>
                                            {{-- <th>{{__('Status')}}</th> --}}
                                            <th>{{__('Nombre')}}</th>
                                            <th>{{__('Acción')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($blogs as $blog)
                                    <tr class="removable-item">
                                        <td>
                                            <div class="admin-dashboard-blog-list-img">
                                                <img src="{{getImageFile($blog->image_path)}}" alt="img">
                                            </div>
                                        </td>
                                        <td>
                                            {{$blog->title}}
                                        </td>
                                        <td>
                                            {{$blog->category ? $blog->category->name : '' }}
                                        </td>
                                        {{-- <td>
                                            @if($blog->status == 1)
                                                <span class="status bg-green">{{ __('Published') }}</span>
                                            @else
                                                <span class="status bg-red">{{ __('Unpublished') }}</span>
                                            @endif
                                        </td> --}}

                                        <td>
                                            {{ $blog->user ? $blog->user->name : '' }}
                                        </td>
                                        <td>
                                            <div class="action__buttons">
                                                <a href="{{route('blog.edit', [$blog->uuid])}}" title="Edit" class="btn btn-icon waves-effect waves-light btn-success m-b-5 m-r-5" data-toggle="tooltip"> <i class="fa fa-edit"></i>

                                                </a>
                                                <a href="{{route('blog.delete', [$blog->uuid])}}" class="btn btn-icon waves-effect waves-light btn-danger m-b-5" onclick="return confirm('{{trans('do you want to delete')}}')" data-toggle="tooltip" title="{{trans('remove')}}"> <i class="fa fa-remove"></i>

                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                    </tbody>
                                </table>
                                <div class="mt-3">
                                    {{@$blogs->links()}}
                                </div>
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
    <!-- Page content area end -->
@endsection


