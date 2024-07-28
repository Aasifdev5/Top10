@extends('master')
@section('title')
    Blog
@endsection
@section('content')
    <div class="breadcrumb-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-12">
                    <h2 class="breadcrumb-title">Our Blog</h2>
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Blog</li>
                            <li class="breadcrumb-item active" aria-current="page">Grid</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 d-flex">

                            <div class="blog grid-blog flex-fill">
                                <div class="blog-image">
                                    <a href="{{url('blog-details')}}"><img class="img-fluid"
                                            src="assets/img/services/service-19.jpg" alt="Post Image"></a>
                                </div>
                                <div class="blog-content">
                                    <div class="blog-category">
                                        <ul>
                                            <li><span class="cat-blog">Computer</span></li>
                                            <li><i class="feather-calendar me-2"></i>28 Sep 2023</li>
                                            <li>
                                                <div class="post-author">
                                                    <a href="#"><img src="assets/img/profiles/avatar-02.jpg"
                                                            alt="Post Author"><span>Admin</span></a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <h3 class="blog-title">
                                        <a href="{{url('blog-details')}}">How to Fix a Computer in Just 3 Steps?</a>
                                    </h3>
                                    <p>Sed ut perspiciatis omnis natus error voluptatem architecto beatae vitae dicta sunt
                                        explicabo.</p>
                                    <a href="{{url('blog-details')}}" class="read-more">Read More <i
                                            class="feather-arrow-right-circle"></i></a>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-4 col-md-6 d-flex">

                            <div class="blog grid-blog flex-fill">
                                <div class="blog-image">
                                    <a href="{{url('blog-details')}}"><img class="img-fluid"
                                            src="assets/img/services/service-10.jpg" alt="Post Image"></a>
                                </div>
                                <div class="blog-content">
                                    <div class="blog-category">
                                        <ul>
                                            <li><span class="cat-blog">Construction</span></li>
                                            <li><i class="feather-calendar me-2"></i>28 Sep 2023</li>
                                            <li>
                                                <div class="post-author">
                                                    <a href="#"><img src="assets/img/profiles/avatar-02.jpg"
                                                            alt="Post Author"><span>Admin</span></a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <h3 class="blog-title">
                                        <a href="{{url('blog-details')}}">Construction Service Scams: How to Avoid Them</a>
                                    </h3>
                                    <p>Sed ut perspiciatis omnis natus error voluptatem architecto beatae vitae dicta sunt
                                        explicabo.</p>
                                    <a href="{{url('blog-details')}}" class="read-more">Read More <i
                                            class="feather-arrow-right-circle"></i></a>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-4 col-md-6 d-flex">

                            <div class="blog grid-blog flex-fill">
                                <div class="blog-image">
                                    <a href="{{url('blog-details')}}"><img class="img-fluid"
                                            src="assets/img/services/service-08.jpg" alt="Post Image"></a>
                                </div>
                                <div class="blog-content">
                                    <div class="blog-category">
                                        <ul>
                                            <li><span class="cat-blog">Car Wash</span></li>
                                            <li><i class="feather-calendar me-2"></i>28 Sep 2023</li>
                                            <li>
                                                <div class="post-author">
                                                    <a href="#"><img src="assets/img/profiles/avatar-02.jpg"
                                                            alt="Post Author"><span>Admin</span></a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <h3 class="blog-title">
                                        <a href="{{url('blog-details')}}">Lorem ipsum dolor sit amet, consectetur sed do</a>
                                    </h3>
                                    <p>Sed ut perspiciatis omnis natus error voluptatem architecto beatae vitae dicta sunt
                                        explicabo.</p>
                                    <a href="{{url('blog-details')}}" class="read-more">Read More <i
                                            class="feather-arrow-right-circle"></i></a>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-4 col-md-6 d-flex">

                            <div class="blog grid-blog flex-fill">
                                <div class="blog-image">
                                    <a href="{{url('blog-details')}}"><img class="img-fluid"
                                            src="assets/img/services/service-19.jpg" alt="Post Image"></a>
                                </div>
                                <div class="blog-content">
                                    <div class="blog-category">
                                        <ul>
                                            <li><span class="cat-blog">Electrical</span></li>
                                            <li><i class="feather-calendar me-2"></i>28 Sep 2023</li>
                                            <li>
                                                <div class="post-author">
                                                    <a href="#"><img src="assets/img/profiles/avatar-02.jpg"
                                                            alt="Post Author"><span>Admin</span></a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <h3 class="blog-title">
                                        <a href="{{url('blog-details')}}">Lorem ipsum dolor sit amet, consectetur sed do</a>
                                    </h3>
                                    <p>Sed ut perspiciatis omnis natus error voluptatem architecto beatae vitae dicta sunt
                                        explicabo.</p>
                                    <a href="{{url('blog-details')}}" class="read-more">Read More <i
                                            class="feather-arrow-right-circle"></i></a>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-4 col-md-6 d-flex">

                            <div class="blog grid-blog flex-fill">
                                <div class="blog-image">
                                    <a href="{{url('blog-details')}}"><img class="img-fluid"
                                            src="assets/img/services/service-09.jpg" alt="Post Image"></a>
                                </div>
                                <div class="blog-content">
                                    <div class="blog-category">
                                        <ul>
                                            <li><span class="cat-blog">Cleaning</span></li>
                                            <li><i class="feather-calendar me-2"></i>28 Sep 2023</li>
                                            <li>
                                                <div class="post-author">
                                                    <a href="#"><img src="assets/img/profiles/avatar-02.jpg"
                                                            alt="Post Author"><span>Admin</span></a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <h3 class="blog-title">
                                        <a href="{{url('blog-details')}}">Lorem ipsum dolor sit amet, consectetur sed do</a>
                                    </h3>
                                    <p>Sed ut perspiciatis omnis natus error voluptatem architecto beatae vitae dicta sunt
                                        explicabo.</p>
                                    <a href="{{url('blog-details')}}" class="read-more">Read More <i
                                            class="feather-arrow-right-circle"></i></a>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-4 col-md-6 d-flex">

                            <div class="blog grid-blog flex-fill">
                                <div class="blog-image">
                                    <a href="{{url('blog-details')}}"><img class="img-fluid"
                                            src="assets/img/services/service-07.jpg" alt="Post Image"></a>
                                </div>
                                <div class="blog-content">
                                    <div class="blog-category">
                                        <ul>
                                            <li><span class="cat-blog">Interior</span></li>
                                            <li><i class="feather-calendar me-2"></i>28 Sep 2023</li>
                                            <li>
                                                <div class="post-author">
                                                    <a href="#"><img src="assets/img/profiles/avatar-02.jpg"
                                                            alt="Post Author"><span>Admin</span></a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <h3 class="blog-title">
                                        <a href="{{url('blog-details')}}">Lorem ipsum dolor sit amet, consectetur sed do</a>
                                    </h3>
                                    <p>Sed ut perspiciatis omnis natus error voluptatem architecto beatae vitae dicta sunt
                                        explicabo.</p>
                                    <a href="{{url('blog-details')}}" class="read-more">Read More <i
                                            class="feather-arrow-right-circle"></i></a>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="blog-pagination">
                                <nav>
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item disabled">
                                            <a class="page-link page-prev" href="javascript:void(0);" tabindex="-1"><i
                                                    class="fa-solid fa-arrow-left me-2"></i> PREV</a>
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
                                                    class="fa-solid fa-arrow-right ms-2"></i></a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mouse-cursor cursor-outer"></div>
        <div class="mouse-cursor cursor-inner"></div>

    </div>
@endsection
