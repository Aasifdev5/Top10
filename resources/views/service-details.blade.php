@extends('master')
@section('title')
    Services Details
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
                    <h2 class="breadcrumb-title">Service Details</h2>
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index-2.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Service Details</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container">
            <div class="row">

                <div class="col-md-8">
                    <div class="serv-profile">
                        <h2>Car Repair Services</h2>
                        <ul>
                            <li>
                                <span class="badge">Car Wash</span>
                            </li>
                            <li class="service-map"><i class="feather-map-pin"></i> Alabama, USA</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="serv-action">
                        <ul>
                            <li>
                                <a href="#"><i class="feather-heart"></i></a>
                            </li>
                            <li>
                                <a href="#" data-bs-toggle="tooltip" title="Share"><i
                                        class="feather-share-2"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="feather-printer"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="feather-download"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="service-gal">
                        <div class="row gx-2">
                            <div class="col-md-9">
                                <div class="service-images big-gallery">
                                    <img src="assets/img/services/service-ban-01.jpg" class="img-fluid" alt="img">
                                    <a href="assets/img/services/service-ban-01.jpg" data-fancybox="gallery"
                                        class="btn btn-show"><i class="feather-image me-2"></i>Show all photos</a>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="service-images small-gallery">
                                    <a href="assets/img/services/service-ban-02.jpg" data-fancybox="gallery">
                                        <img src="assets/img/services/service-ban-02.jpg" class="img-fluid" alt="img">
                                        <span class="circle-icon"><i class="feather-plus"></i></span>
                                    </a>
                                </div>
                                <div class="service-images small-gallery">
                                    <a href="assets/img/services/service-ban-03.jpg" data-fancybox="gallery">
                                        <img src="assets/img/services/service-ban-03.jpg" class="img-fluid" alt="img">
                                        <span class="circle-icon"><i class="feather-plus"></i></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">

                <div class="col-lg-8">
                    <div class="service-wrap">
                        <h5>Service Details</h5>
                        <p>Car wash is a facility used to clean the exterior and, in some cases, the interior of motor
                            vehicles. Car washes can be self-serve, fully automated, or full-service with attendants who
                            wash the vehicle.</p>
                    </div>
                    <div class="service-wrap provide-service">
                        <h5>Service Provider</h5>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="provide-box">
                                    <img src="assets/img/profiles/avatar-02.jpg" class="img-fluid" alt="img">
                                    <div class="provide-info">
                                        <h6>Member Since</h6>
                                        <div class="serv-review"><i class="fa-solid fa-star"></i> <span>4.9 </span>(255
                                            reviews)</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="provide-box">
                                    <span><i class="feather-user"></i></span>
                                    <div class="provide-info">
                                        <h6>Member Since</h6>
                                        <p>Apr 2020</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="provide-box">
                                    <span><i class="feather-map-pin"></i></span>
                                    <div class="provide-info">
                                        <h6>Address</h6>
                                        <p>Hanover, Maryland</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="provide-box">
                                    <span><i class="feather-mail"></i></span>
                                    <div class="provide-info">
                                        <h6>Email</h6>
                                        <p><a href="https://truelysell.dreamstechnologies.com/cdn-cgi/l/email-protection"
                                                class="__cf_email__"
                                                data-cfemail="98ecf0f7f5f9ebf0d8fde0f9f5e8f4fdb6fbf7f5">[email&nbsp;protected]</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="provide-box">
                                    <span><i class="feather-phone"></i></span>
                                    <div class="provide-info">
                                        <h6>Phone</h6>
                                        <p>+1 888 888 8888</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="social-icon provide-social">
                                    <ul>
                                        <li>
                                            <a href="#" target="_blank"><i class="feather-instagram"></i> </a>
                                        </li>
                                        <li>
                                            <a href="#" target="_blank"><i class="feather-twitter"></i> </a>
                                        </li>
                                        <li>
                                            <a href="#" target="_blank"><i class="feather-youtube"></i></a>
                                        </li>
                                        <li>
                                            <a href="#" target="_blank"><i class="feather-linkedin"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="service-wrap">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Gallery</h5>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <div class="owl-nav mynav3"></div>
                            </div>
                        </div>
                        <div class="owl-carousel gallery-slider">
                            <div class="gallery-widget">
                                <a href="assets/img/gallery/gallery-big-01.jpg" data-fancybox="gallery">
                                    <img class="img-fluid" alt="Image" src="assets/img/gallery/gallery-01.jpg">
                                </a>
                            </div>
                            <div class="gallery-widget">
                                <a href="assets/img/gallery/gallery-big-02.jpg" data-fancybox="gallery">
                                    <img class="img-fluid" alt="Image" src="assets/img/gallery/gallery-02.jpg">
                                </a>
                            </div>
                            <div class="gallery-widget">
                                <a href="assets/img/gallery/gallery-big-03.jpg" data-fancybox="gallery">
                                    <img class="img-fluid" alt="Image" src="assets/img/gallery/gallery-03.jpg">
                                </a>
                            </div>
                            <div class="gallery-widget">
                                <a href="assets/img/gallery/gallery-02.jpg" data-fancybox="gallery">
                                    <img class="img-fluid" alt="Image" src="assets/img/gallery/gallery-02.jpg">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="service-wrap">
                        <h5>Video</h5>
                        <div id="background-video">
                            <a class="play-btn" data-fancybox="" href="https://www.youtube.com/watch?v=Vdp6x7Bibtk"><i
                                    class="fa-solid fa-play"></i></a>
                        </div>
                    </div>
                    <div class="service-wrap">
                        <h5>Reviews</h5>
                        <ul>
                            <li class="review-box">
                                <div class="review-profile">
                                    <div class="review-img">
                                        <img src="assets/img/profiles/avatar-02.jpg" class="img-fluid" alt="img">
                                        <div class="review-name">
                                            <h6>Dennis</h6>
                                            <p>a week ago</p>
                                        </div>
                                    </div>
                                    <div class="rating">
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                    </div>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipicing elit, sed do eiusmod tempor incididunt
                                    ut labore et dolore magna aliqa. Ut enim ad minim veniam, quis nostrud exercitation
                                    ullamco laboris nisi ut aliquip ex ea commodo consequat</p>
                                <div class="recommend-item">
                                    <a href="#"><img alt="Image" src="assets/img/icons/reply-icon.svg"
                                            class="me-2"> Reply</a>
                                    <div class="recommend-info">
                                        <p>Recommend?</p>
                                        <a href="#"><i class="feather-thumbs-up"></i> Yes</a>
                                        <a href="#"><i class="feather-thumbs-down"></i> No</a>
                                    </div>
                                </div>
                            </li>
                            <li class="review-box">
                                <div class="review-profile">
                                    <div class="review-img">
                                        <img src="assets/img/profiles/avatar-03.jpg" class="img-fluid" alt="img">
                                        <div class="review-name">
                                            <h6>Jaime</h6>
                                            <p>yesterday | 10:35AM </p>
                                        </div>
                                    </div>
                                    <div class="rating">
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                    </div>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipicing elit, sed do eiusmod tempor incididunt
                                    ut labore et dolore magna aliqa. Ut enim ad minim veniam, quis nostrud exercitation
                                    ullamco laboris nisi ut aliquip ex ea commodo consequat</p>
                                <div class="recommend-item">
                                    <a href="#"><img alt="Image" src="assets/img/icons/reply-icon.svg"
                                            class="me-2"> Reply</a>
                                    <div class="recommend-info">
                                        <p>Recommend?</p>
                                        <a href="#"><i class="feather-thumbs-up"></i> Yes</a>
                                        <a href="#"><i class="feather-thumbs-down"></i> No</a>
                                    </div>
                                </div>
                            </li>
                            <li class="review-box">
                                <div class="review-profile">
                                    <div class="review-img">
                                        <img src="assets/img/profiles/avatar-07.jpg" class="img-fluid" alt="img">
                                        <div class="review-name">
                                            <h6>Martinez</h6>
                                            <p>2 days ago | 14:35PM </p>
                                        </div>
                                    </div>
                                    <div class="rating">
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                    </div>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipicing elit, sed do eiusmod tempor incididunt
                                    ut labore et dolore magna aliqa. Ut enim ad minim veniam, quis nostrud exercitation
                                    ullamco laboris nisi ut aliquip ex ea commodo consequat</p>
                                <div class="recommend-item">
                                    <a href="#"><img alt="Image" src="assets/img/icons/reply-icon.svg"
                                            class="me-2"> Reply</a>
                                    <div class="recommend-info">
                                        <p>Recommend?</p>
                                        <a href="#"><i class="feather-thumbs-up"></i> Yes</a>
                                        <a href="#"><i class="feather-thumbs-down"></i> No</a>
                                    </div>
                                </div>
                                <div class="reply-area">
                                    <textarea class="form-control mb-0" rows="3" placeholder="Type your response....."></textarea>
                                </div>
                            </li>
                            <li class="review-box">
                                <div class="review-profile">
                                    <div class="review-img">
                                        <img src="assets/img/profiles/avatar-05.jpg" class="img-fluid" alt="img">
                                        <div class="review-name">
                                            <h6>Bradley</h6>
                                            <p>1 month ago | 17:35PM </p>
                                        </div>
                                    </div>
                                    <div class="rating">
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                    </div>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipicing elit, sed do eiusmod tempor incididunt
                                    ut labore et dolore magna aliqa. Ut enim ad minim veniam, quis nostrud exercitation
                                    ullamco laboris nisi ut aliquip ex ea commodo consequat</p>
                                <div class="recommend-item">
                                    <a href="#"><img alt="Image" src="assets/img/icons/reply-icon.svg"
                                            class="me-2"> Reply</a>
                                    <div class="recommend-info">
                                        <p>Recommend?</p>
                                        <a href="#"><i class="feather-thumbs-up"></i> Yes</a>
                                        <a href="#"><i class="feather-thumbs-down"></i> No</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="text-center">
                            <a href="customer-reviews.html" class="btn btn-primary btn-review">View All Reviews</a>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="service-wrap">
                                <h5>Related Services</h5>
                            </div>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <div class="owl-nav mynav"></div>
                        </div>
                    </div>
                    <div class="owl-carousel related-slider">
                        <div class="service-widget mb-0">
                            <div class="service-img">
                                <a href="service-details.html">
                                    <img class="img-fluid serv-img" alt="Service Image"
                                        src="assets/img/services/service-01.jpg">
                                </a>
                                <div class="fav-item">
                                    <a href="categories.html"><span class="item-cat">Cleaning</span></a>
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
                                    <a href="service-details.html">Electric Panel Repairing Service</a>
                                </h3>
                                <p><i class="feather-map-pin"></i>Montana, USA<span class="rate"><i
                                            class="fas fa-star filled"></i>4.9</span></p>
                                <div class="serv-info">
                                    <h6>$25.00<span class="old-price">$35.00</span></h6>
                                    <a href="booking.html" class="btn btn-book">Book Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="service-widget mb-0">
                            <div class="service-img">
                                <a href="service-details.html">
                                    <img class="img-fluid serv-img" alt="Service Image"
                                        src="assets/img/services/service-02.jpg">
                                </a>
                                <div class="fav-item">
                                    <a href="categories.html"><span class="item-cat">Construction</span></a>
                                    <a href="javascript:void(0)" class="fav-icon">
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
                                    <a href="service-details.html">Toughened Glass Fitting Services</a>
                                </h3>
                                <p><i class="feather-map-pin"></i>Montana, USA</p>
                                <div class="serv-info">
                                    <h6>$45.00</h6>
                                    <a href="booking.html" class="btn btn-book">Book Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="service-widget mb-0">
                            <div class="service-img">
                                <a href="service-details.html">
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
                                                src="assets/img/profiles/avatar-02.jpg" class="avatar"
                                                alt="User"></span></a>
                                </div>
                            </div>
                            <div class="service-content">
                                <h3 class="title">
                                    <a href="service-details.html">Wooden Carpentry Work</a>
                                </h3>
                                <p><i class="feather-map-pin"></i>Montana, USA</p>
                                <div class="serv-info">
                                    <h6>$45.00</h6>
                                    <a href="booking.html" class="btn btn-book">Book Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 theiaStickySidebar">

                    <div class="card card-provide mb-0">
                        <div class="card-body">
                            <div class="provide-widget">
                                <div class="service-amount">
                                    <h5>$150<span>$170</span></h5>
                                    <p class="serv-review"><i class="fa-solid fa-star"></i> <span>4.9 </span>(255 reviews)
                                    </p>
                                </div>
                                <div class="serv-proimg">
                                    <img src="assets/img/profiles/avatar-02.jpg" class="img-fluid" alt="img">
                                    <span><i class="fa-solid fa-circle-check"></i></span>
                                </div>
                            </div>
                            <div class="package-widget">
                                <h5>Available Service Packages</h5>
                                <ul>
                                    <li>Full car wash and clean</li>
                                    <li>Auto Electrical</li>
                                    <li>Pre Purchase Inspection</li>
                                    <li>Pre Purchase Inspection</li>
                                </ul>
                            </div>
                            <div class="package-widget pack-service">
                                <h5>Additional Service</h5>
                                <ul>
                                    <li>
                                        <div class="add-serving">
                                            <label class="custom_check">
                                                <input type="checkbox" name="rememberme">
                                                <span class="checkmark"></span>
                                            </label>
                                            <div class="add-serv-item">
                                                <div class="add-serv-img">
                                                    <img src="assets/img/services/service-09.jpg" alt="image">
                                                </div>
                                                <div class="add-serv-info">
                                                    <h6>House Cleaning</h6>
                                                    <p><i class="feather-map-pin"></i> Alabama, USA</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="add-serv-amt">
                                            <h6>$500.75</h6>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="add-serving">
                                            <label class="custom_check">
                                                <input type="checkbox" name="rememberme">
                                                <span class="checkmark"></span>
                                            </label>
                                            <div class="add-serv-item">
                                                <div class="add-serv-img">
                                                    <img src="assets/img/services/service-16.jpg" alt="image">
                                                </div>
                                                <div class="add-serv-info">
                                                    <h6>Air Conditioner Service</h6>
                                                    <p><i class="feather-map-pin"></i> Illinois, USA</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="add-serv-amt">
                                            <h6>$500.75</h6>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="add-serving">
                                            <label class="custom_check">
                                                <input type="checkbox" name="rememberme">
                                                <span class="checkmark"></span>
                                            </label>
                                            <div class="add-serv-item">
                                                <div class="add-serv-img">
                                                    <img src="assets/img/services/service-07.jpg" alt="Service">
                                                </div>
                                                <div class="add-serv-info">
                                                    <h6>Interior Designing</h6>
                                                    <p><i class="feather-map-pin"></i> California, USA</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="add-serv-amt">
                                            <h6>$500.75</h6>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="add-serving">
                                            <label class="custom_check">
                                                <input type="checkbox" name="rememberme">
                                                <span class="checkmark"></span>
                                            </label>
                                            <div class="add-serv-item">
                                                <div class="add-serv-img">
                                                    <img src="assets/img/services/service-03.jpg" alt="Service Image">
                                                </div>
                                                <div class="add-serv-info">
                                                    <h6>Wooden Carpentry Work</h6>
                                                    <p><i class="feather-map-pin"></i> Alabama, USA</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="add-serv-amt">
                                            <h6>$354.45</h6>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="card card-available">
                                <div class="card-body">
                                    <div class="available-widget">
                                        <div class="available-info">
                                            <h5>Service Availability</h5>
                                            <ul>
                                                <li>Monday <span>9:30 AM - 7:00 PM</span> </li>
                                                <li>Tuesday <span>9:30 AM - 7:00 PM</span> </li>
                                                <li>Wednesday <span>9:30 AM - 7:00 PM</span> </li>
                                                <li>Thursday <span>9:30 AM - 7:00 PM</span> </li>
                                                <li>Friday <span>9:30 AM - 7:00 PM</span> </li>
                                                <li>Saturday <span>9:30 AM - 7:00 PM</span> </li>
                                                <li>Sunday <span class="text-danger">Closed</span> </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="map-grid">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6509170.989457427!2d-123.80081967108484!3d37.192957227641294!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808fb9fe5f285e3d%3A0x8b5109a227086f55!2sCalifornia%2C%20USA!5e0!3m2!1sen!2sin!4v1669181581381!5m2!1sen!2sin"
                                    style="border:0;" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade" class="contact-map"></iframe>
                            </div>
                            <a href="booking.html" class="btn btn-primary">Book Service</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
