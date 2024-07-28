@extends('master')
@section('title')
    Blog Details
@endsection
@section('content')
    <div class="breadcrumb-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-12">
                    <h2 class="breadcrumb-title">Our Blog</h2>
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index-2.html">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Blog</li>
                            <li class="breadcrumb-item active" aria-current="page">Blog Details</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 blog-details">
                    <div class="blog-head">
                        <div class="blog-category">
                            <ul>
                                <li><span class="cat-blog">Construction</span></li>
                            </ul>
                        </div>
                        <h3>Lorem ipsum dolor sit amet, eiusmod tempor ut labore et dolore
                            magna aliqua. </h3>
                        <div class="blog-category sin-post">
                            <ul>
                                <li><i class="feather-calendar me-1"></i>28 Sep 2023</li>
                                <li>
                                    <div class="post-author">
                                        <a href="#"><img src="assets/img/profiles/avatar-02.jpg"
                                                alt="Post Author"><span>Admin</span></a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="blog blog-list">
                        <div class="blog-image">
                            <a href="blog-details.html"><img class="img-fluid" src="assets/img/blog/blog-04.jpg"
                                    alt="Post Image"></a>
                        </div>
                        <div class="blog-content">
                            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                                laudantium, totam rem aperiam, eaque ipsa aspernatur aut odit aut fugit, sed quia
                                consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
                            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                                laudantium, totam rem aperiam, eaque ipsa aspernatur aut odit aut fugit, sed quia
                                consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
                            <p class="test-info">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                                doloremque laudantium, totam rem aperiam, eaque ipsa aspernatur aut odit aut fugit, sed quia
                                consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
                        </div>
                    </div>

                    <div class="social-widget blog-review">
                        <h4>Tags</h4>
                        <div class="ad-widget">
                            <ul>
                                <li>
                                    <a href="javascript:void(0);">Construction</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">Car Wash</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">Appliance</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">Interior</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">Carpentry</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="service-wrap blog-review">
                        <h4>Comments</h4>
                        <ul>
                            <li>
                                <div class="review-box">
                                    <div class="review-profile">
                                        <div class="review-img">
                                            <img src="assets/img/profiles/avatar-02.jpg" class="img-fluid" alt="img">
                                            <div class="review-name">
                                                <h6>Dennis</h6>
                                                <p>a week ago</p>
                                            </div>
                                        </div>
                                        <a href="javascript:void(0);" class="reply-box"><i class="fas fa-reply me-2"></i>
                                            Reply</a>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipicing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqa. Ut enim ad minim veniam, quis nostrud
                                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat</p>
                                    <div class="new-comment reply-com">
                                        <form>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Name*</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter Your Name">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Email*</label>
                                                        <input type="email" class="form-control"
                                                            placeholder="Enter Email Address">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Website</label>
                                                        <input type="email" class="form-control"
                                                            placeholder="Enter Your Website">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Message*</label>
                                                        <textarea rows="4" class="form-control" placeholder="Enter Your Comment Here...."></textarea>
                                                    </div>
                                                </div>
                                                <div class="submit-section">
                                                    <button class="btn btn-primary submit-btn" type="submit">Send
                                                        Message</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <ul class="comments-reply">
                                    <li>
                                        <div class="review-box">
                                            <div class="review-profile">
                                                <div class="review-img">
                                                    <img src="assets/img/profiles/avatar-02.jpg" class="img-fluid"
                                                        alt="img">
                                                    <div class="review-name">
                                                        <h6>Dennis</h6>
                                                        <p>a week ago</p>
                                                    </div>
                                                </div>
                                                <a href="javascript:void(0);" class="reply-box"><i
                                                        class="fas fa-reply me-2"></i> Reply</a>
                                            </div>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipicing elit, sed do eiusmod tempor
                                                incididunt ut labore et dolore magna aliqa. Ut enim ad minim veniam, quis
                                                nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat
                                            </p>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <div class="review-box">
                                    <div class="review-profile">
                                        <div class="review-img">
                                            <img src="assets/img/profiles/avatar-03.jpg" class="img-fluid" alt="img">
                                            <div class="review-name">
                                                <h6>Jaime</h6>
                                                <p>a week ago</p>
                                            </div>
                                        </div>
                                        <a href="javascript:void(0);" class="reply-box"><i class="fas fa-reply me-2"></i>
                                            Reply</a>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipicing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqa. Ut enim ad minim veniam, quis nostrud
                                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat</p>
                                    <div class="new-comment reply-com">
                                        <form>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Name*</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter Your Name">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Email*</label>
                                                        <input type="email" class="form-control"
                                                            placeholder="Enter Email Address">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Website</label>
                                                        <input type="email" class="form-control"
                                                            placeholder="Enter Your Website">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Message*</label>
                                                        <textarea rows="4" class="form-control" placeholder="Enter Your Comment Here...."></textarea>
                                                    </div>
                                                </div>
                                                <div class="submit-section">
                                                    <button class="btn btn-primary submit-btn" type="submit">Send
                                                        Message</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="review-box">
                                    <div class="review-profile">
                                        <div class="review-img">
                                            <img src="assets/img/profiles/avatar-07.jpg" class="img-fluid"
                                                alt="img">
                                            <div class="review-name">
                                                <h6>Joseph</h6>
                                                <p>a week ago</p>
                                            </div>
                                        </div>
                                        <a href="javascript:void(0);" class="reply-box"><i class="fas fa-reply me-2"></i>
                                            Reply</a>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipicing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqa. Ut enim ad minim veniam, quis nostrud
                                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat</p>
                                    <div class="new-comment reply-com">
                                        <form>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Name*</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter Your Name">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Email*</label>
                                                        <input type="email" class="form-control"
                                                            placeholder="Enter Email Address">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Website</label>
                                                        <input type="email" class="form-control"
                                                            placeholder="Enter Your Website">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Message*</label>
                                                        <textarea rows="4" class="form-control" placeholder="Enter Your Comment Here...."></textarea>
                                                    </div>
                                                </div>
                                                <div class="submit-section">
                                                    <button class="btn btn-primary submit-btn" type="submit">Send
                                                        Message</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>


                    <div class="new-comment">
                        <h4>Write a Comment</h4>
                        <form>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Name *</label>
                                        <input type="text" class="form-control" placeholder="Enter Your Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Email *</label>
                                        <input type="email" class="form-control" placeholder="Enter Email Address">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-form-label">Message *</label>
                                        <textarea rows="6" class="form-control" placeholder="Enter Your Comment Here...."></textarea>
                                    </div>
                                </div>
                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn" type="submit">Post Comment</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>

                <div class="col-lg-4 col-md-12 blog-sidebar theiaStickySidebar">

                    <div class="card search-widget">
                        <div class="card-body">
                            <form class="search-form">
                                <div class="input-group">
                                    <input type="text" placeholder="Search..." class="form-control">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>


                    <div class="card about-widget">
                        <div class="card-body">
                            <h4 class="side-title">About Me</h4>
                            <img src="assets/img/profile.jpg" alt="User">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                                labore et dolore magna aliqua. Ut enim ad minim veniam, </p>
                            <a href="#" class="btn btn-primary">About Author</a>
                        </div>
                    </div>


                    <div class="card category-widget">
                        <div class="card-body">
                            <h4 class="side-title">Categories</h4>
                            <ul class="categories">
                                <li><a href="categories.html">Car Wash</a></li>
                                <li><a href="categories.html">Plumbing</a></li>
                                <li><a href="categories.html">Carpenter</a></li>
                                <li><a href="categories.html">Computer Service</a></li>
                            </ul>
                        </div>
                    </div>


                    <div class="card post-widget">
                        <div class="card-body">
                            <h4 class="side-title">Latest News</h4>
                            <ul class="latest-posts">
                                <li>
                                    <div class="post-thumb">
                                        <a href="blog-details.html">
                                            <img class="img-fluid" src="assets/img/services/service-01.jpg"
                                                alt="Blog Image">
                                        </a>
                                    </div>
                                    <div class="post-info">
                                        <p>06 Nov 2023</p>
                                        <h4>
                                            <a href="blog-details.html">Lorem ipsum dolor amet, consectetur adipiscing
                                                elit. Amet.</a>
                                        </h4>
                                    </div>
                                </li>
                                <li>
                                    <div class="post-thumb">
                                        <a href="blog-details.html">
                                            <img class="img-fluid" src="assets/img/services/service-02.jpg"
                                                alt="Thumb Image">
                                        </a>
                                    </div>
                                    <div class="post-info">
                                        <p>06 Nov 2023</p>
                                        <h4>
                                            <a href="blog-details.html">Lorem ipsum dolor amet, consectetur adipiscing
                                                elit. Amet.</a>
                                        </h4>
                                    </div>
                                </li>
                                <li>
                                    <div class="post-thumb">
                                        <a href="blog-details.html">
                                            <img class="img-fluid" src="assets/img/services/service-03.jpg"
                                                alt="Thumb image">
                                        </a>
                                    </div>
                                    <div class="post-info">
                                        <p>06 Nov 2023</p>
                                        <h4>
                                            <a href="blog-details.html">Lorem ipsum dolor amet, consectetur adipiscing
                                                elit. Amet.</a>
                                        </h4>
                                    </div>
                                </li>
                                <li>
                                    <div class="post-thumb">
                                        <a href="blog-details.html">
                                            <img class="img-fluid" src="assets/img/services/service-04.jpg"
                                                alt="Thumb Image">
                                        </a>
                                    </div>
                                    <div class="post-info">
                                        <p>06 Nov 2023</p>
                                        <h4>
                                            <a href="blog-details.html">Lorem ipsum dolor amet, consectetur adipiscing
                                                elit. Amet.</a>
                                        </h4>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>


                    <div class="card tags-widget">
                        <div class="card-body">
                            <h4 class="side-title">Tags</h4>
                            <ul class="tags">
                                <li><a href="#" class="tag">Consulting</a></li>
                                <li><a href="#" class="tag">Design</a></li>
                            </ul>
                        </div>
                    </div>


                    <div class="card widget widget-archive mb-0">
                        <div class="card-body">
                            <h4 class="side-title">Archives</h4>
                            <ul>
                                <li><a href="javascript:void(0);">January 2023</a></li>
                            </ul>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
