@extends('master')
@section('title')
    Services
@endsection
@section('content')
    <div class="bg-img">
        <img src="assets/img/bg/work-bg-03.png" alt="img" class="bgimg1">
        <img src="assets/img/bg/work-bg-03.png" alt="img" class="bgimg2">
        <img src="assets/img/bg/feature-bg-03.png" alt="img" class="bgimg3">
    </div>
    <div class="breadcrumb-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-12">
                    <h2 class="breadcrumb-title">Service Grid</h2>
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index-2.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Service Grid</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-sm-12 theiaStickySidebar">
                    <div class="filter-div">
                        <div class="filter-head">
                            <h5>Filter by</h5>
                            <a href="#" class="reset-link">Reset Filters</a>
                        </div>
                        <div class="filter-content">
                            <h2>Keyword</h2>
                            <input type="text" class="form-control" placeholder="What are you looking for?">
                        </div>
                        <div class="filter-content">
                            <h2>Categories <span><i class="feather-chevron-down"></i></span></h2>
                            <div class="filter-checkbox" id="fill-more">
                                <ul>
                                    <li>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span><i></i></span>
                                            <b class="check-content">All Categories</b>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span><i></i></span>
                                            <b class="check-content">Construction</b>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span><i></i></span>
                                            <b class="check-content">Car Wash</b>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span><i></i></span>
                                            <b class="check-content">Electrical</b>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span><i></i></span>
                                            <b class="check-content">Cleaning</b>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span><i></i></span>
                                            <b class="check-content">Interior</b>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="checkboxs">
                                            <input type="checkbox">
                                            <span><i></i></span>
                                            <b class="check-content">Computer</b>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                            <a href="javascript:void(0);" id="more" class="more-view">View More <i
                                    class="feather-arrow-down-circle ms-1"></i></a>
                        </div>
                        <div class="filter-content">
                            <h2>Sub Category</h2>
                            <select class="form-control select">
                                <option>All Sub Category</option>
                                <option>Computer</option>
                                <option>Construction</option>
                            </select>
                        </div>
                        <div class="filter-content">
                            <h2>Location</h2>
                            <div class="group-img">
                                <input type="text" class="form-control" placeholder="Select Location">
                                <i class="feather-map-pin"></i>
                            </div>
                        </div>
                        <div class="filter-content">
                            <h2 class="mb-4">Price Range</h2>
                            <div class="filter-range">
                                <input type="text" id="range_03">
                            </div>
                            <div class="filter-range-amount">
                                <h5>Price: <span>$5 - $210</span></h5>
                            </div>
                        </div>
                        <div class="filter-content">
                            <h2>By Rating <span><i class="feather-chevron-down"></i></span></h2>
                            <ul class="rating-set">
                                <li>
                                    <label class="checkboxs d-inline-flex">
                                        <input type="checkbox">
                                        <span><i></i></span>
                                    </label>
                                    <a class="rating" href="javascript:void(0);">
                                        <i class="fa-regular fa-star filled"></i>
                                        <i class="fa-regular fa-star filled"></i>
                                        <i class="fa-regular fa-star filled"></i>
                                        <i class="fa-regular fa-star filled"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <span class="d-inline-block average-rating float-end">(35)</span>
                                    </a>
                                </li>
                                <li>
                                    <label class="checkboxs d-inline-flex">
                                        <input type="checkbox">
                                        <span><i></i></span>
                                    </label>
                                    <a class="rating" href="javascript:void(0);">
                                        <i class="fa-regular fa-star filled"></i>
                                        <i class="fa-regular fa-star filled"></i>
                                        <i class="fa-regular fa-star filled"></i>
                                        <i class="fa-regular fa-star filled"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <span class="d-inline-block average-rating float-end">(40)</span>
                                    </a>
                                </li>
                                <li>
                                    <label class="checkboxs d-inline-flex">
                                        <input type="checkbox">
                                        <span><i></i></span>
                                    </label>
                                    <a class="rating" href="javascript:void(0);">
                                        <i class="fa-regular fa-star filled"></i>
                                        <i class="fa-regular fa-star filled"></i>
                                        <i class="fa-regular fa-star filled"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <span class="d-inline-block average-rating float-end">(40)</span>
                                    </a>
                                </li>
                                <li>
                                    <label class="checkboxs d-inline-flex">
                                        <input type="checkbox">
                                        <span><i></i></span>
                                    </label>
                                    <a class="rating" href="javascript:void(0);">
                                        <i class="fa-regular fa-star filled"></i>
                                        <i class="fa-regular fa-star filled"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <span class="d-inline-block average-rating float-end">(20)</span>
                                    </a>
                                </li>
                                <li>
                                    <label class="checkboxs d-inline-flex">
                                        <input type="checkbox">
                                        <span><i></i></span>
                                    </label>
                                    <a class="rating" href="javascript:void(0);">
                                        <i class="fa-regular fa-star filled"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <span class="d-inline-block average-rating float-end">(5)</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <button class="btn btn-primary">Search</button>
                    </div>
                </div>


                <div class="col-lg-9 col-sm-12">
                    <div class="row sorting-div">
                        <div class="col-lg-4 col-sm-12 ">
                            <div class="count-search">
                                <h6>Found 12 Services</h6>
                            </div>
                        </div>
                        <div class="col-lg-8 col-sm-12 d-flex justify-content-end ">
                            <div class="sortbyset">
                                <div class="sorting-select">
                                    <select class="form-control select">
                                        <option>Price Low to High</option>
                                        <option>Price High to Low</option>
                                    </select>
                                </div>
                            </div>
                            <div class="grid-listview">
                                <ul>
                                    <li>
                                        <a href="service-grid.html" class="active">
                                            <i class="feather-grid"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="service-list.html">
                                            <i class="feather-list"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-xl-4 col-md-6">
                            <div class="service-widget servicecontent">
                                <div class="service-img">
                                    <a href="{{url('service-details')}}">
                                        <img class="img-fluid serv-img" alt="Service Image"
                                            src="assets/img/services/service-04.jpg">
                                    </a>
                                    <div class="fav-item">
                                        <a href="categories.html"><span class="item-cat">Car Wash</span></a>
                                        <a href="javascript:void(0)" class="fav-icon">
                                            <i class="feather-heart"></i>
                                        </a>
                                    </div>
                                    <div class="item-info">
                                        <a href="providers.html"><span class="item-img"><img
                                                    src="assets/img/profiles/avatar-01.jpg" class="avatar"
                                                    alt="User"></span></a>
                                    </div>
                                </div>
                                <div class="service-content">
                                    <h3 class="title">
                                        <a href="{{url('service-details')}}">Car Repair Services</a>
                                    </h3>
                                    <p><i class="feather-map-pin"></i>Maryland City, USA<span class="rate"><i
                                                class="fas fa-star filled"></i>4.9</span></p>
                                    <div class="serv-info">
                                        <h6>$50.00</h6>
                                        <a href="booking.html" class="btn btn-book">Book Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-4 col-md-6">
                            <div class="service-widget servicecontent">
                                <div class="service-img">
                                    <a href="{{url('service-details')}}">
                                        <img class="img-fluid serv-img" alt="Service Image"
                                            src="assets/img/services/service-02.jpg">
                                    </a>
                                    <div class="fav-item">
                                        <a href="categories.html"><span class="item-cat">Construction</span></a>
                                        <a href="javascript:void(0)" class="fav-icon selected">
                                            <i class="feather-heart"></i>
                                        </a>
                                    </div>
                                    <div class="item-info">
                                        <a href="providers.html"><span class="item-img"><img
                                                    src="assets/img/profiles/avatar-01.jpg" class="avatar"
                                                    alt="User"></span></a>
                                    </div>
                                </div>
                                <div class="service-content">
                                    <h3 class="title">
                                        <a href="{{url('service-details')}}">Toughened Glass Fitting Services</a>
                                    </h3>
                                    <p><i class="feather-map-pin"></i>New Jersey, USA<span class="rate"><i
                                                class="fas fa-star filled"></i>4.9</span></p>
                                    <div class="serv-info">
                                        <h6>$25.00</h6>
                                        <a href="booking.html" class="btn btn-book">Book Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-4 col-md-6">
                            <div class="service-widget servicecontent">
                                <div class="service-img">
                                    <a href="{{url('service-details')}}">
                                        <img class="img-fluid serv-img" alt="Service Image"
                                            src="assets/img/services/service-06.jpg">
                                    </a>
                                    <div class="fav-item">
                                        <a href="categories.html"><span class="item-cat">Computer</span></a>
                                        <a href="javascript:void(0)" class="fav-icon">
                                            <i class="feather-heart"></i>
                                        </a>
                                    </div>
                                    <div class="item-info">
                                        <a href="providers.html"><span class="item-img"><img
                                                    src="assets/img/profiles/avatar-02.jpg" class="avatar"
                                                    alt="User"></span></a>
                                    </div>
                                </div>
                                <div class="service-content">
                                    <h3 class="title">
                                        <a href="{{url('service-details')}}">Computer &amp; Server AMC Service</a>
                                    </h3>
                                    <p><i class="feather-map-pin"></i>California, USA<span class="rate"><i
                                                class="fas fa-star filled"></i>4.9</span></p>
                                    <div class="serv-info">
                                        <h6>$20.00<span class="old-price">$35.00</span></h6>
                                        <a href="booking.html" class="btn btn-book">Book Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-4 col-md-6">
                            <div class="service-widget servicecontent">
                                <div class="service-img">
                                    <a href="{{url('service-details')}}">
                                        <img class="img-fluid serv-img" alt="Service Image"
                                            src="assets/img/services/service-07.jpg">
                                    </a>
                                    <div class="fav-item">
                                        <a href="categories.html"><span class="item-cat">Interior</span></a>
                                        <a href="javascript:void(0)" class="fav-icon selected">
                                            <i class="feather-heart"></i>
                                        </a>
                                    </div>
                                    <div class="item-info">
                                        <a href="providers.html"><span class="item-img"><img
                                                    src="assets/img/profiles/avatar-03.jpg" class="avatar"
                                                    alt="User"></span></a>
                                    </div>
                                </div>
                                <div class="service-content">
                                    <h3 class="title">
                                        <a href="{{url('service-details')}}">Interior Designing</a>
                                    </h3>
                                    <p><i class="feather-map-pin"></i>Maryland, USA<span class="rate"><i
                                                class="fas fa-star filled"></i>4.9</span></p>
                                    <div class="serv-info">
                                        <h6>$5.00<span class="old-price">$25.00</span></h6>
                                        <a href="booking.html" class="btn btn-book">Book Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-4 col-md-6">
                            <div class="service-widget servicecontent">
                                <div class="service-img">
                                    <a href="{{url('service-details')}}">
                                        <img class="img-fluid serv-img" alt="Service Image"
                                            src="assets/img/services/service-08.jpg">
                                    </a>
                                    <div class="fav-item">
                                        <a href="categories.html"><span class="item-cat">Car Wash</span></a>
                                        <a href="javascript:void(0)" class="fav-icon">
                                            <i class="feather-heart"></i>
                                        </a>
                                    </div>
                                    <div class="item-info">
                                        <a href="providers.html"><span class="item-img"><img
                                                    src="assets/img/profiles/avatar-04.jpg" class="avatar"
                                                    alt="User"></span></a>
                                    </div>
                                </div>
                                <div class="service-content">
                                    <h3 class="title">
                                        <a href="{{url('service-details')}}">Steam Car Wash</a>
                                    </h3>
                                    <p><i class="feather-map-pin"></i>Montana, USA<span class="rate"><i
                                                class="fas fa-star filled"></i>4.9</span></p>
                                    <div class="serv-info">
                                        <h6>$14.00</h6>
                                        <a href="booking.html" class="btn btn-book">Book Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-4 col-md-6">
                            <div class="service-widget servicecontent">
                                <div class="service-img">
                                    <a href="{{url('service-details')}}">
                                        <img class="img-fluid serv-img" alt="Service Image"
                                            src="assets/img/services/service-01.jpg">
                                    </a>
                                    <div class="fav-item">
                                        <a href="categories.html"><span class="item-cat">Electrical</span></a>
                                        <a href="javascript:void(0)" class="fav-icon">
                                            <i class="feather-heart"></i>
                                        </a>
                                    </div>
                                    <div class="item-info">
                                        <a href="providers.html"><span class="item-img"><img
                                                    src="assets/img/profiles/avatar-05.jpg" class="avatar"
                                                    alt="User"></span></a>
                                    </div>
                                </div>
                                <div class="service-content">
                                    <h3 class="title">
                                        <a href="{{url('service-details')}}">Electric Panel Repairing Service</a>
                                    </h3>
                                    <p><i class="feather-map-pin"></i>Texas, USA<span class="rate"><i
                                                class="fas fa-star filled"></i>4.9</span></p>
                                    <div class="serv-info">
                                        <h6>$45</h6>
                                        <a href="booking.html" class="btn btn-book">Book Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-4 col-md-6">
                            <div class="service-widget servicecontent">
                                <div class="service-img">
                                    <a href="{{url('service-details')}}">
                                        <img class="img-fluid serv-img" alt="Service Image"
                                            src="assets/img/services/service-09.jpg">
                                    </a>
                                    <div class="fav-item">
                                        <a href="categories.html"><span class="item-cat">Cleaning</span></a>
                                        <a href="javascript:void(0)" class="fav-icon">
                                            <i class="feather-heart"></i>
                                        </a>
                                    </div>
                                    <div class="item-info">
                                        <a href="providers.html"><span class="item-img"><img
                                                    src="assets/img/profiles/avatar-05.jpg" class="avatar"
                                                    alt="User"></span></a>
                                    </div>
                                </div>
                                <div class="service-content">
                                    <h3 class="title">
                                        <a href="{{url('service-details')}}">House Cleaning Services</a>
                                    </h3>
                                    <p><i class="feather-map-pin"></i>Georgia<span class="rate"><i
                                                class="fas fa-star filled"></i>4.9</span></p>
                                    <div class="serv-info">
                                        <h6>$10.00</h6>
                                        <a href="booking.html" class="btn btn-book">Book Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-4 col-md-6">
                            <div class="service-widget servicecontent">
                                <div class="service-img">
                                    <a href="{{url('service-details')}}">
                                        <img class="img-fluid serv-img" alt="Service Image"
                                            src="assets/img/services/service-05.jpg">
                                    </a>
                                    <div class="fav-item">
                                        <a href="categories.html"><span class="item-cat">Construction</span></a>
                                        <a href="javascript:void(0)" class="fav-icon">
                                            <i class="feather-heart"></i>
                                        </a>
                                    </div>
                                    <div class="item-info">
                                        <a href="providers.html"><span class="item-img"><img
                                                    src="assets/img/profiles/avatar-06.jpg" class="avatar"
                                                    alt="User"></span></a>
                                    </div>
                                </div>
                                <div class="service-content">
                                    <h3 class="title">
                                        <a href="{{url('service-details')}}">Commercial Painting Services</a>
                                    </h3>
                                    <p><i class="feather-map-pin"></i>Alabama, USA<span class="rate"><i
                                                class="fas fa-star filled"></i>4.9</span></p>
                                    <div class="serv-info">
                                        <h6>$10.00<span class="old-price">$15.00</span></h6>
                                        <a href="booking.html" class="btn btn-book">Book Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-4 col-md-6">
                            <div class="service-widget servicecontent">
                                <div class="service-img">
                                    <a href="{{url('service-details')}}">
                                        <img class="img-fluid serv-img" alt="Service Image"
                                            src="assets/img/services/service-10.jpg">
                                    </a>
                                    <div class="fav-item">
                                        <a href="categories.html"><span class="item-cat">Construction</span></a>
                                        <a href="javascript:void(0)" class="fav-icon">
                                            <i class="feather-heart"></i>
                                        </a>
                                    </div>
                                    <div class="item-info">
                                        <a href="providers.html"><span class="item-img"><img
                                                    src="assets/img/profiles/avatar-01.jpg" class="avatar"
                                                    alt="User"></span></a>
                                    </div>
                                </div>
                                <div class="service-content">
                                    <h3 class="title">
                                        <a href="{{url('service-details')}}">Building Construction Services</a>
                                    </h3>
                                    <p><i class="feather-map-pin"></i>Montana, USA<span class="rate"><i
                                                class="fas fa-star filled"></i>4.9</span></p>
                                    <div class="serv-info">
                                        <h6>$75</h6>
                                        <a href="booking.html" class="btn btn-book">Book Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-4 col-md-6">
                            <div class="service-widget servicecontent">
                                <div class="service-img">
                                    <a href="{{url('service-details')}}">
                                        <img class="img-fluid serv-img" alt="Service Image"
                                            src="assets/img/services/service-11.jpg">
                                    </a>
                                    <div class="fav-item">
                                        <a href="categories.html"><span class="item-cat">Plumbing</span></a>
                                        <a href="javascript:void(0)" class="fav-icon">
                                            <i class="feather-heart"></i>
                                        </a>
                                    </div>
                                    <div class="item-info">
                                        <a href="providers.html"><span class="item-img"><img
                                                    src="assets/img/profiles/avatar-07.jpg" class="avatar"
                                                    alt="User"></span></a>
                                    </div>
                                </div>
                                <div class="service-content">
                                    <h3 class="title">
                                        <a href="{{url('service-details')}}">Plumbing Services</a>
                                    </h3>
                                    <p><i class="feather-map-pin"></i>Virginia, USA<span class="rate"><i
                                                class="fas fa-star filled"></i>4.9</span></p>
                                    <div class="serv-info">
                                        <h6>$15.00<span class="old-price">$45.00</span></h6>
                                        <a href="booking.html" class="btn btn-book">Book Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-4 col-md-6">
                            <div class="service-widget servicecontent">
                                <div class="service-img">
                                    <a href="{{url('service-details')}}">
                                        <img class="img-fluid serv-img" alt="Service Image"
                                            src="assets/img/services/service-03.jpg">
                                    </a>
                                    <div class="fav-item">
                                        <a href="categories.html"><span class="item-cat">Carpentry</span></a>
                                        <a href="javascript:void(0)" class="fav-icon">
                                            <i class="feather-heart"></i>
                                        </a>
                                    </div>
                                    <div class="item-info">
                                        <a href="providers.html"><span class="item-img"><img
                                                    src="assets/img/profiles/avatar-01.jpg" class="avatar"
                                                    alt="User"></span></a>
                                    </div>
                                </div>
                                <div class="service-content">
                                    <h3 class="title">
                                        <a href="{{url('service-details')}}">Wooden Carpentry Work</a>
                                    </h3>
                                    <p><i class="feather-map-pin"></i>Alabama, USA<span class="rate"><i
                                                class="fas fa-star filled"></i>4.9</span></p>
                                    <div class="serv-info">
                                        <h6>$32.00<span class="old-price">$35.00</span></h6>
                                        <a href="booking.html" class="btn btn-book">Book Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-4 col-md-6">
                            <div class="service-widget servicecontent">
                                <div class="service-img">
                                    <a href="{{url('service-details')}}">
                                        <img class="img-fluid serv-img" alt="Service Image"
                                            src="assets/img/services/service-13.jpg">
                                    </a>
                                    <div class="fav-item">
                                        <a href="categories.html"><span class="item-cat">Construction</span></a>
                                        <a href="javascript:void(0)" class="fav-icon">
                                            <i class="feather-heart"></i>
                                        </a>
                                    </div>
                                    <div class="item-info">
                                        <a href="providers.html"><span class="item-img"><img
                                                    src="assets/img/profiles/avatar-07.jpg" class="avatar"
                                                    alt="User"></span></a>
                                    </div>
                                </div>
                                <div class="service-content">
                                    <h3 class="title">
                                        <a href="{{url('service-details')}}">Painting Services</a>
                                    </h3>
                                    <p><i class="feather-map-pin"></i>Virginia, USA</p>
                                    <div class="serv-info">
                                        <h6>$150.00</h6>
                                        <a href="booking.html" class="btn btn-book">Book Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="blog-pagination rev-page">
                                <nav>
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item disabled">
                                            <a class="page-link page-prev" href="javascript:void(0);" tabindex="-1"><i
                                                    class="fa-solid fa-arrow-left me-1"></i> PREV</a>
                                        </li>
                                        <li class="page-item active">
                                            <a class="page-link" href="javascript:void(0);">1</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="javascript:void(0);">2</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="javascript:void(0);">3</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link page-next" href="javascript:void(0);">NEXT <i
                                                    class="fa-solid fa-arrow-right ms-1"></i></a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
