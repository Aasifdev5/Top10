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
                                    <h2>{{ __('Settings') }}</h2>
                                </div>
                            </div>
                            <div class="breadcrumb__content__right">
                                <nav aria-label="breadcrumb">
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a
                                                href="{{ url('admin\dashboard') }}">{{ __('Dashboard') }}</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">{{ __('Language Settings') }}
                                        </li>
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
                                <h2>{{ __('Language Settings') }}</h2>
                                <a href="{{ route('language.create') }}" class="btn btn-success btn-sm pull-right"> <i
                                        class="fa fa-plus"></i> {{ __('Add Language') }} </a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="advance-1" class="row-border data-table-filter table-style">
                                        <thead>
                                            <tr>
                                                <th>{{ __('Flag') }}</th>
                                                <th>{{ __('Language') }}</th>
                                                <th>{{ __('ISO Code') }}</th>
                                                <th>{{ __('RTL') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($languages as $key => $language)
                                                <tr class="removable-item">
                                                    <td>
                                                        <img src="{{ getImageFile($language->flag) }}" height="50">
                                                    </td>
                                                    <td>{{ $language->language }}</td>
                                                    <td>{{ $language->iso_code }}</td>
                                                    <td>{{ $language->rtl == 1 ? 'Yes' : 'No' }}</td>
                                                    <td>
                                                        <div class="action__buttons">
                                                            <a href="{{ route('language.edit', [$language->id, $language->iso_code]) }}"
                                                                 title="Edit"class="btn btn-icon waves-effect waves-light btn-success m-b-5 m-r-5" data-toggle="tooltip"> <i class="fa fa-edit"></i>
                                                            </a>
                                                            @if ($language->id != 1)
                                                                <a href="javascript:void(0);"
                                                                    data-url="{{ url('admin/language/delete', [$language->id]) }}"
                                                                     title="Delete" class="btn btn-icon waves-effect waves-light btn-danger m-b-5" onclick="return confirm('{{trans('do you want to delete')}}')" data-toggle="tooltip" title="{{trans('remove')}}"> <i class="fa fa-remove"></i>
                                                                </a>
                                                            @endif
                                                            <a href="{{ route('language.translate', [$language->id]) }}"
                                                                 title="Edit" class="btn btn-icon waves-effect waves-light btn-success m-b-5 m-r-5" data-toggle="tooltip"> Translate
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="mt-3">
                                        {{ $languages->links() }}
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
@endsection
