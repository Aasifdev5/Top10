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
            <div class="tab-content pt-0">
                <div class="tab-pane active" id="active-service">
                    <div class="row">
                        @foreach ($services as $row)
                            <div class="col-xl-4 col-md-6">
                                <div class="service-widget pro-service">
                                    <div class="service-img">
                                        <a href="service-details.html">
                                            <img class="img-fluid serv-img" alt="Service Image"
                                                src="assets/img/services/service-04.jpg">
                                        </a>
                                        <div class="fav-item">
                                            <div class="item-info">
                                                <a href="categories"><span class="item-cat">Car Wash</span></a>
                                            </div>
                                            <span class="serv-rating"><i class="fa-solid fa-star"></i>4.9</span>
                                        </div>
                                    </div>
                                    <div class="service-content">
                                        <h3 class="title">
                                            <a href="{{ url('service-details') }}">{{ $row->service_title }}</a>
                                        </h3>
                                        <div class="addrs-item">
                                            <p><i class="feather-map-pin"></i>{{ $row->address }} {{ $row->city }}, {{ $row->state }}, {{ $row->country }}</p>
                                            <h6 class="price">${{ $row->price }}<span class="old-price">$35.00</span><span
                                                    class="price-hr">/hr</span></h6>
                                        </div>
                                        <div class="serv-info">
                                            <div>
                                                <a href="{{ url('provider-edit-service') }}{{ '/'.$row->id }}" class="serv-edit"><i
                                                        class="feather-edit"></i> Edit</a>
                                                <a href="javascript:void(0);" data-bs-toggle="modal"
                                                    data-bs-target="#in-active"><span><i class="feather-alert-circle"></i>
                                                        Active</span></a>
                                            </div>
                                            <a href="provider-offers.html" class="btn btn-book">Apply Offer</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach







                    </div>
                </div>
                <div class="tab-pane fade" id="inactive-service">
                    <div class="row">

                        <div class="col-xl-4 col-md-6">
                            <div class="service-widget pro-service">
                                <div class="service-img">
                                    <a href="service-details.html">
                                        <img class="img-fluid serv-img" alt="Service Image"
                                            src="assets/img/services/service-02.jpg">
                                    </a>
                                    <div class="fav-item">
                                        <div class="item-info">
                                            <a href="categories.html"><span class="item-cat">Construction</span></a>
                                        </div>
                                        <span class="serv-rating"><i class="fa-solid fa-star"></i>4.9</span>
                                    </div>
                                </div>
                                <div class="service-content">
                                    <h3 class="title">
                                        <a href="service-details.html">Toughened Glass Fitting Services</a>
                                    </h3>
                                    <div class="addrs-item">
                                        <p><i class="feather-map-pin"></i>New Jersey, USA</p>
                                        <h6 class="price">$20.00<span class="old-price">$35.00</span><span
                                                class="price-hr">/hr</span></h6>
                                    </div>
                                    <div class="serv-info">
                                        <div>
                                            <a href="#" class="serv-edit" data-bs-toggle="modal"
                                                data-bs-target="#del-service"><i class="feather-trash-2"></i>Delete</a>
                                            <a href="javascript:void(0);" data-bs-toggle="modal"
                                                data-bs-target="#active"><span><i class="feather-alert-circle"></i>
                                                    Inactive</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-4 col-md-6">
                            <div class="service-widget pro-service">
                                <div class="service-img">
                                    <a href="service-details.html">
                                        <img class="img-fluid serv-img" alt="Service Image"
                                            src="assets/img/services/service-04.jpg">
                                    </a>
                                    <div class="fav-item">
                                        <div class="item-info">
                                            <a href="categories.html"><span class="item-cat">Car Wash</span></a>
                                        </div>
                                        <span class="serv-rating"><i class="fa-solid fa-star"></i>4.9</span>
                                    </div>
                                </div>
                                <div class="service-content">
                                    <h3 class="title">
                                        <a href="service-details.html">Car Repair Services</a>
                                    </h3>
                                    <div class="addrs-item">
                                        <p><i class="feather-map-pin"></i>Maryland, USA</p>
                                        <h6 class="price">$20.00<span class="old-price">$35.00</span><span
                                                class="price-hr">/hr</span></h6>
                                    </div>
                                    <div class="serv-info">
                                        <div>
                                            <a href="#" class="serv-edit" data-bs-toggle="modal"
                                                data-bs-target="#del-service"><i class="feather-trash-2"></i>Delete</a>
                                            <a href="javascript:void(0);" data-bs-toggle="modal"
                                                data-bs-target="#active"><span><i class="feather-alert-circle"></i>
                                                    Inactive</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-4 col-md-6">
                            <div class="service-widget pro-service">
                                <div class="service-img">
                                    <a href="service-details.html">
                                        <img class="img-fluid serv-img" alt="Service Image"
                                            src="assets/img/services/service-07.jpg">
                                    </a>
                                    <div class="fav-item">
                                        <div class="item-info">
                                            <a href="categories.html"><span class="item-cat">Interior</span></a>
                                        </div>
                                        <span class="serv-rating"><i class="fa-solid fa-star"></i>4.9</span>
                                    </div>
                                </div>
                                <div class="service-content">
                                    <h3 class="title">
                                        <a href="service-details.html">Interior Designing</a>
                                    </h3>
                                    <div class="addrs-item">
                                        <p><i class="feather-map-pin"></i>Maryland, USA</p>
                                        <h6 class="price">$23.00<span class="old-price">$34.00</span><span
                                                class="price-hr">/hr</span></h6>
                                    </div>
                                    <div class="serv-info">
                                        <div>
                                            <a href="#" class="serv-edit" data-bs-toggle="modal"
                                                data-bs-target="#del-service"><i class="feather-trash-2"></i>Delete</a>
                                            <a href="javascript:void(0);" data-bs-toggle="modal"
                                                data-bs-target="#active"><span><i class="feather-alert-circle"></i>
                                                    Inactive</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-4 col-md-6">
                            <div class="service-widget pro-service">
                                <div class="service-img">
                                    <a href="service-details.html">
                                        <img class="img-fluid serv-img" alt="Service Image"
                                            src="assets/img/services/service-06.jpg">
                                    </a>
                                    <div class="fav-item">
                                        <div class="item-info">
                                            <a href="categories.html"><span class="item-cat">Computer</span></a>
                                        </div>
                                        <span class="serv-rating"><i class="fa-solid fa-star"></i>4.9</span>
                                    </div>
                                </div>
                                <div class="service-content">
                                    <h3 class="title">
                                        <a href="service-details.html">Computer & Server AMC Service</a>
                                    </h3>
                                    <div class="addrs-item">
                                        <p><i class="feather-map-pin"></i>California, USA</p>
                                        <h6 class="price">$22.00<span class="old-price">$32.00</span><span
                                                class="price-hr">/hr</span></h6>
                                    </div>
                                    <div class="serv-info">
                                        <div>
                                            <a href="#" class="serv-edit" data-bs-toggle="modal"
                                                data-bs-target="#del-service"><i class="feather-trash-2"></i>Delete</a>
                                            <a href="javascript:void(0);" data-bs-toggle="modal"
                                                data-bs-target="#active"><span><i class="feather-alert-circle"></i>
                                                    Inactive</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-4 col-md-6">
                            <div class="service-widget pro-service">
                                <div class="service-img">
                                    <a href="service-details.html">
                                        <img class="img-fluid serv-img" alt="Service Image"
                                            src="assets/img/services/service-01.jpg">
                                    </a>
                                    <div class="fav-item">
                                        <div class="item-info">
                                            <a href="categories.html"><span class="item-cat">Electrical</span></a>
                                        </div>
                                        <span class="serv-rating"><i class="fa-solid fa-star"></i>4.9</span>
                                    </div>
                                </div>
                                <div class="service-content">
                                    <h3 class="title">
                                        <a href="service-details.html">Electric Panel Repairing Service</a>
                                    </h3>
                                    <div class="addrs-item">
                                        <p><i class="feather-map-pin"></i>Texas, USA</p>
                                        <h6 class="price">$22.00<span class="old-price">$25.00</span><span
                                                class="price-hr">/hr</span></h6>
                                    </div>
                                    <div class="serv-info">
                                        <div>
                                            <a href="#" class="serv-edit" data-bs-toggle="modal"
                                                data-bs-target="#del-service"><i class="feather-trash-2"></i>Delete</a>
                                            <a href="javascript:void(0);" data-bs-toggle="modal"
                                                data-bs-target="#active"><span><i class="feather-alert-circle"></i>
                                                    Inactive</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-4 col-md-6">
                            <div class="service-widget pro-service">
                                <div class="service-img">
                                    <a href="service-details.html">
                                        <img class="img-fluid serv-img" alt="Service Image"
                                            src="assets/img/services/service-08.jpg">
                                    </a>
                                    <div class="fav-item">
                                        <div class="item-info">
                                            <a href="categories.html"><span class="item-cat">Car Wash</span></a>
                                        </div>
                                        <span class="serv-rating"><i class="fa-solid fa-star"></i>4.9</span>
                                    </div>
                                </div>
                                <div class="service-content">
                                    <h3 class="title">
                                        <a href="service-details.html">Steam Car Wash</a>
                                    </h3>
                                    <div class="addrs-item">
                                        <p><i class="feather-map-pin"></i>Montana, USA</p>
                                        <h6 class="price">$20.00<span class="old-price">$30.00</span><span
                                                class="price-hr">/hr</span></h6>
                                    </div>
                                    <div class="serv-info">
                                        <div>
                                            <a href="#" class="serv-edit" data-bs-toggle="modal"
                                                data-bs-target="#del-service"><i class="feather-trash-2"></i>Delete</a>
                                            <a href="javascript:void(0);" data-bs-toggle="modal"
                                                data-bs-target="#active"><span><i class="feather-alert-circle"></i>
                                                    Inactive</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-4 col-md-6">
                            <div class="service-widget pro-service">
                                <div class="service-img">
                                    <a href="service-details.html">
                                        <img class="img-fluid serv-img" alt="Service Image"
                                            src="assets/img/services/service-05.jpg">
                                    </a>
                                    <div class="fav-item">
                                        <div class="item-info">
                                            <a href="categories.html"><span class="item-cat">Construction</span></a>
                                        </div>
                                        <span class="serv-rating"><i class="fa-solid fa-star"></i>4.9</span>
                                    </div>
                                </div>
                                <div class="service-content">
                                    <h3 class="title">
                                        <a href="service-details.html">Commercial Painting Services</a>
                                    </h3>
                                    <div class="addrs-item">
                                        <p><i class="feather-map-pin"></i>Alabama, USA</p>
                                        <h6 class="price">$22.00<span class="old-price">$32.00</span><span
                                                class="price-hr">/hr</span></h6>
                                    </div>
                                    <div class="serv-info">
                                        <div>
                                            <a href="#" class="serv-edit" data-bs-toggle="modal"
                                                data-bs-target="#del-service"><i class="feather-trash-2"></i>Delete</a>
                                            <a href="javascript:void(0);" data-bs-toggle="modal"
                                                data-bs-target="#active"><span><i class="feather-alert-circle"></i>
                                                    Inactive</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-4 col-md-6">
                            <div class="service-widget pro-service">
                                <div class="service-img">
                                    <a href="service-details.html">
                                        <img class="img-fluid serv-img" alt="Service Image"
                                            src="assets/img/services/service-09.jpg">
                                    </a>
                                    <div class="fav-item">
                                        <div class="item-info">
                                            <a href="categories.html"><span class="item-cat">Cleaning</span></a>
                                        </div>
                                        <span class="serv-rating"><i class="fa-solid fa-star"></i>4.9</span>
                                    </div>
                                </div>
                                <div class="service-content">
                                    <h3 class="title">
                                        <a href="service-details.html">House Cleaning Services</a>
                                    </h3>
                                    <div class="addrs-item">
                                        <p><i class="feather-map-pin"></i>Georgia</p>
                                        <h6 class="price">$18.00<span class="old-price">$25.00</span><span
                                                class="price-hr">/hr</span></h6>
                                    </div>
                                    <div class="serv-info">
                                        <div>
                                            <a href="#" class="serv-edit" data-bs-toggle="modal"
                                                data-bs-target="#del-service"><i class="feather-trash-2"></i>Delete</a>
                                            <a href="javascript:void(0);" data-bs-toggle="modal"
                                                data-bs-target="#active"><span><i class="feather-alert-circle"></i>
                                                    Inactive</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-4 col-md-6">
                            <div class="service-widget pro-service">
                                <div class="service-img">
                                    <a href="service-details.html">
                                        <img class="img-fluid serv-img" alt="Service Image"
                                            src="assets/img/services/service-10.jpg">
                                    </a>
                                    <div class="fav-item">
                                        <div class="item-info">
                                            <a href="categories.html"><span class="item-cat">Construction</span></a>
                                        </div>
                                        <span class="serv-rating"><i class="fa-solid fa-star"></i>4.9</span>
                                    </div>
                                </div>
                                <div class="service-content">
                                    <h3 class="title">
                                        <a href="service-details.html">Building Construction Services</a>
                                    </h3>
                                    <div class="addrs-item">
                                        <p><i class="feather-map-pin"></i>Montana, USA</p>
                                        <h6 class="price">$25.00<span class="old-price">$30.00</span><span
                                                class="price-hr">/hr</span></h6>
                                    </div>
                                    <div class="serv-info">
                                        <div>
                                            <a href="#" class="serv-edit" data-bs-toggle="modal"
                                                data-bs-target="#del-service"><i class="feather-trash-2"></i>Delete</a>
                                            <a href="javascript:void(0);" data-bs-toggle="modal"
                                                data-bs-target="#active"><span><i class="feather-alert-circle"></i>
                                                    Inactive</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="review-entries">
                        <span>Show</span>
                        <select>
                            <option>07</option>
                            <option>08</option>
                        </select>
                        <span>entries</span>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="review-pagination">
                        <p>1 - 09 of 09</p>
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="javascript:void(0);">1</a>
                            </li>
                            <li class="page-item active">
                                <a class="page-link" href="javascript:void(0);">2 <span
                                        class="visually-hidden">(current)</span></a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="javascript:void(0);">3</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
