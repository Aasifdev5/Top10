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
                                    <h2>{{ __('Application Setting') }}</h2>
                                </div>
                            </div>
                            <div class="breadcrumb__content__right">
                                <nav aria-label="breadcrumb">
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{url('admin\dashboard')}}">{{__('Dashboard')}}</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">{{ __(@$title) }}</li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="card col-lg-3 col-md-4">
                        @include('admin.application_settings.sidebar')
                    </div>
                    <div class="col-lg-9 col-md-8">
                        <div class="card">
                            <div class="card-header"><h2>{{ __(@$title) }}</h2></div>
                            <div class="bg-dark-primary-soft-varient p-4 border-1">
                                <h2>{{ __('Instructions') }}: </h2>
                                <p>{{ __('If device control on it will restrict user to login more than the limited devices') }}</p>
                            </div>
                            <br>
                            <div class="card-body">
                                <form action="{{route('settings.device_control.change')}}" method="post" class="form-horizontal">
                                    @csrf

                                    <div class="form-group text-black row mb-3">
                                        <label class="col-lg-3">{{ __('Device Control') }} <span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <div class="col-lg-9">
                                                <select name="device_control" required class="form-control device_control">
                                                    <option value="0" @if(get_option('device_control') != 1) selected @endif>{{ __('No') }}</option>
                                                    <option value="1" @if(get_option('device_control') == 1) selected @endif>{{ __('Yes') }}</option>
                                                </select>
                                                @if ($errors->has('device_control'))
                                                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('device_control') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group text-black row mb-3">
                                        <label class="col-lg-3">{{ __('Device limit') }} </label>
                                        <div class="col-lg-9">
                                            <input type="number" min=1 required name="device_limit" value="{{ get_option('device_limit') }}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="input__group general-settings-btn">
                                                <button type="submit" class="btn btn-primary btn-sm float-right">{{ __('Update') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Page content area end -->
@endsection

