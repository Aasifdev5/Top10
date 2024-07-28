@extends('provider_master')
@section('title')
    My Service
@endsection
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row">
                    <div class="col-md-4">
                        <div class="provider-subtitle">
                            <h6>My Services</h6>
                        </div>
                    </div>
                    <div class="col-md-8 d-flex align-items-center justify-content-md-end flex-wrap">

                        <div class="grid-listview me-2">
                            <ul>
                                <li>
                                    <a href="javascript:void(0);">
                                        <i class="feather-filter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('provider-services') }}" class="active">
                                        <i class="feather-grid"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('provider-services-list') }}">
                                        <i class="feather-list"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <a href="{{ url('create-service') }}" class="btn btn-primary add-set"><i
                                class="feather-plus me-2"></i>Add
                            Service</a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="tab-list">
                        <ul class="nav">
                            <li>
                                <a href="#" class="active" data-bs-toggle="tab"
                                    data-bs-target="#active-service">Actice Services</a>
                            </li>
                            <li>
                                <a href="#" data-bs-toggle="tab" data-bs-target="#inactive-service">Inactive
                                    Services</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="tab-pane active" id="active-service">
                <div class="row">
                    <div class="col-md-12">
                        @foreach ($services as $row)
                            <div class="service-list">
                                <div class="service-cont">
                                    <div class="service-cont-img">
                                        <a href="service-details.html">
                                            <img class="img-fluid serv-img" alt="Service Image"
                                                src="assets/img/services/service-04.jpg">
                                        </a>
                                        <div class="fav-item">
                                            <a href="javascript:void(0)" class="fav-icon">
                                                <i class="feather-heart"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="service-cont-info">
                                        <div class="category-rating">
                                            <span class="item-cat">Car Wash</span>
                                            <span class="serv-rating"><i class="fa-solid fa-star"></i>4.9</span>
                                        </div>
                                        <h3 class="title">
                                            <a href="{{ url('service-details') }}">{{ $row->service_title }}</a>
                                        </h3>
                                        <p><i class="feather-map-pin"></i>{{ $row->address }} {{ $row->city }},
                                            {{ $row->state }}, {{ $row->country }}</p>
                                    </div>
                                </div>
                                <div class="service-action">
                                    <ul>
                                        <li>
                                            <a href="{{ url('provider-edit-service') }}{{ '/' . $row->id }}"><i
                                                    class="feather-edit"></i>Edit</a>
                                        </li>
                                        <li>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#in-active"><i
                                                    class="feather-alert-circle"></i>Inactive</a>
                                        </li>
                                    </ul>
                                    <a href="booking.html" class="btn btn-secondary">Apply Offer</a>
                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>
            </div>



        </div>
    </div>
@endsection
