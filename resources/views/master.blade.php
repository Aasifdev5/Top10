<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    @php
        $general_setting = getApplicationsettings();
        $category = getCategory();
        $adminNotifications = userNotifications();

    @endphp
    <title> {{ $general_setting->site_name }} || @yield('title') </title>
    <!-- favicons Icons -->
    <link rel="icon" href="{{ asset('site_favicon/') }}<?php echo '/' . $general_setting->site_favicon; ?>" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('site_favicon/') }}<?php echo '/' . $general_setting->site_favicon; ?>" type="image/x-icon">
    <meta name="description" content="{{ $general_setting->site_description }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Ensure jQuery is loaded first -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/feather.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/plugins/aos/aos.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">


</head>

<body class="body-one">
    <div class="main-wrapper">

        <header class="header header-one">
            <div class="container">
                <nav class="navbar navbar-expand-lg header-nav">
                    <div class="navbar-header">
                        <a id="mobile_btn" href="javascript:void(0);">
                            <span class="bar-icon">
                                <span></span>
                                <span></span>
                                <span></span>
                            </span>
                        </a>
                        <a href="{{ url('home') }}" class="navbar-brand logo">
                            <img src="{{ asset('site_logo/') }}<?php echo '/' . $general_setting->site_logo; ?>" class="img-fluid" alt="Logo">
                        </a>
                        <a href="{{ url('home') }}" class="navbar-brand logo-small">
                            <img src="{{ asset('site_logo/') }}<?php echo '/' . $general_setting->site_logo; ?>" class="img-fluid" alt="Logo">
                        </a>
                    </div>
                    <div class="main-menu-wrapper">
                        <div class="menu-header">
                            <a href="{{ url('home') }}" class="menu-logo">
                                <img src="{{ asset('site_logo/') }}<?php echo '/' . $general_setting->site_logo; ?>" class="img-fluid" alt="Logo">
                            </a>
                            <a id="menu_close" class="menu-close" href="javascript:void(0);"> <i
                                    class="fas fa-times"></i></a>
                        </div>
                        <ul class="main-nav">
                            <li class="has-submenu megamenu active">
                                <a href="{{ url('home') }}">Home</a>

                            </li>

                            <li><a href="{{ url('about') }}">About</a></li>
                            <li class="has-submenu">
                                <a href="{{ url('services') }}">Services</a>

                            </li>

                            <li class="has-submenu">
                                <a href="{{ url('blog') }}">Blog</a>

                            </li>
                            <li><a href="{{ url('contact') }}">Contact</a></li>
                            <li class="login-link">
                                <a href="{{ url('choose-signup') }}">Register</a>
                            </li>
                            <li class="login-link">
                                <a href="{{ url('Userlogin') }}">Login</a>
                            </li>
                        </ul>
                    </div>

                    @if (!empty($user_session))
                    <ul class="nav header-navbar-rht noti-pop-detail">

                        <li class="nav-item flag-nav dropdown">
                            <div class="flag-dropdown">
                                <a class="dropdown-toggle nav-link" data-bs-toggle="dropdown" href="#" role="button">
                                    <img src="{{ asset(selectedLanguage(session()->get('local'))->flag) }}" class="rounded-circle me-1" height="35" width="35" alt="Flag">
                                    {{-- <span>{{ selectedLanguage(session()->get('local'))->iso_code }}</span> --}}
                                </a>
                                <div class="dropdown-menu">
                                    @foreach (appLanguages() as $app_lang)
                                        <a class="dropdown-item" href="{{ url('admin/local/' . $app_lang->iso_code) }}">
                                            <img src="{{ asset($app_lang->flag) }}" alt="Flag" height="16">
                                            <span>{{ $app_lang->language }}</span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </li>






                        <li class="nav-item logged-item msg-nav">
                            <a href="customer-chat.html" class="nav-link">
                                <img src="assets/img/icons/message-icon.svg" alt="Message Icon">
                            </a>
                        </li>


                        <li class="nav-item has-arrow dropdown-heads dropdown logged-item noti-nav noti-wrapper">
                            <a href="#" class="dropdown-toggled nav-link notify-link" data-bs-toggle="dropdown">
                                <span class="noti-message">
                                    @if ($adminNotifications)
                                        {{ count($adminNotifications) }}
                                    @else
                                        0
                                    @endif
                                </span>
                                <img src="{{ asset('assets/img/icons/bell-icon.svg') }}" alt="Bell">
                            </a>
                            <div class="dropdown-menu notify-blk notifications">
                                <div class="topnav-dropdown-header">
                                    <div>
                                        <p class="notification-title">Notifications
                                            <span>{{ $adminNotifications ? count($adminNotifications) : 0 }}</span>
                                        </p>
                                    </div>
                                    <a href="javascript:void(0)" class="clear-noti">
                                        <i class="fa-regular fa-circle-check"></i> Mark all as read
                                    </a>
                                </div>
                                <div class="noti-content">
                                    <ul class="notification-list">
                                        @isset($adminNotifications)
                                            @forelse($adminNotifications as $notification)
                                                @if ($notification->sender)
                                                    <li class="notification-message">
                                                        <a href="{{ route('notification.url', [$notification->uuid]) }}">
                                                            <div class="media noti-img d-flex">
                                                                <span class="avatar avatar-sm flex-shrink-0">
                                                                    @if (!empty(\App\Models\User::getUserInfo($notification->sender_id)->profile_photo))
                                                                        <img class="avatar-img rounded-circle img-fluid"
                                                                            alt="user"
                                                                            src="{{ asset('profile_photo/') . '/' . \App\Models\User::getUserInfo($notification->sender_id)->profile_photo }}"
                                                                            style="width: 50px; height: 50px;">
                                                                    @else
                                                                        <img class="avatar-img rounded-circle img-fluid"
                                                                            alt="dummy-avatar"
                                                                            src="{{ asset('149071.png') }}"
                                                                            style="width: 50px; height: 50px;">
                                                                    @endif
                                                                </span>
                                                                <div class="media-body flex-grow-1">
                                                                    <p class="noti-details">
                                                                        <span
                                                                            class="noti-title">{{ $notification->sender->name }}</span>
                                                                    </p>
                                                                    <p class="font-13 mb-0">{{ __($notification->text) }}</p>
                                                                    <p class="noti-time">
                                                                        <span
                                                                            class="notification-time">{{ $notification->created_at->diffForHumans() }}</span>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                @endif
                                            @empty
                                                <li class="notification-message">
                                                    <p class="text-center">{{ __('No Data Found') }}</p>
                                                </li>
                                            @endforelse
                                        @else
                                            <li class="notification-message">
                                                <p class="text-center">{{ __('No Notifications Found') }}</p>
                                            </li>
                                        @endisset
                                    </ul>
                                </div>
                                @if ($adminNotifications && count($adminNotifications) > 0)
                                    <div class="topnav-dropdown-footer">
                                        <form action="{{ route('notification.all-read') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-link dropdown-footer">
                                                {{ __('Mark all as read') }}
                                            </button>
                                        </form>
                                    </div>
                                @endif
                                <div class="topnav-dropdown-footer">
                                    <a href="{{ url('notification.index') }}">
                                        View all Notifications <img src="assets/img/icons/arrow-right-01.svg"
                                            alt="Arrow">
                                    </a>
                                </div>
                            </div>
                        </li>


                        <li class="nav-item dropdown has-arrow account-item">
                            <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                                <div class="user-infos">
                                    <span class="user-img">
                                        @if (!empty($user_session->profile_photo))
                                        <img src="{{ asset('profile_photo/') }}<?php echo '/' . $user_session->profile_photo; ?>"
                                            class="rounded-circle" width="40" alt="Provider">
                                        <span class="animate-circle"></span>
                                    @else
                                        <img src="{{ asset('profile_photo/149071.png') }}" width="40"
                                            class="rounded-circle" alt="Provider">
                                        <span class="animate-circle"></span>
                                    @endif
                                    </span>
                                    <div class="user-info">
                                        <h6>{{ $user_session->name }}</h6>
                                        <p></p>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end emp">
                                <a class="dropdown-item" href="{{ url('dashboard') }}">
                                    <i class="feather-user me-2"></i> Dashboard
                                </a>
                                <a class="dropdown-item" href="{{ url('edit_profile') }}">
                                    <i class="feather-user me-2"></i> Profile
                                </a>
                                <a class="dropdown-item" href="{{ url('logout') }}">
                                    <i class="feather-log-out me-2"></i> Logout
                                </a>
                            </div>
                        </li>

                    </ul>
                    @else
                    <ul class="nav header-navbar-rht">
                        <li class="nav-item">
                            <a class="nav-link header-reg" href="{{ url('choose-signup') }}">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link header-login" href="{{ url('Userlogin') }}"><i
                                    class="fa-regular fa-circle-user me-2"></i>Login</a>
                        </li>
                    </ul>
                    @endif

                </nav>
            </div>
        </header>


        @yield('content')


        <footer class="footer">

            <div class="footer-top aos" data-aos="fade-up">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-6">

                            <div class="footer-widget">
                                <div class="footer-logo">
                                    <a href="{{ url('home') }}"><img
                                            src="{{ asset('site_logo/') }}<?php echo '/' . $general_setting->site_logo; ?>" alt="logo"></a>
                                </div>
                                <div class="footer-content">
                                    <p>Lorem ipsum dolor sit consectetur adipiscing elit, sed do eiusmod tempor commodo
                                        consequat. </p>
                                </div>

                            </div>

                        </div>
                        <div class="col-lg-2 col-md-6">

                            <div class="footer-widget footer-menu">
                                <h2 class="footer-title">Quick Links</h2>
                                <ul>
                                    <li>
                                        <a href="{{ url('about') }}">About Us</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('blog') }}">Blogs</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('contact') }}">Contact Us</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('provider-signup') }}">Become a Professional</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('user-signup') }}">Become a User</a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                        <div class="col-lg-3 col-md-6">

                            <div class="footer-widget footer-contact">
                                <h2 class="footer-title">Contact Us</h2>
                                <div class="footer-contact-info">
                                    <div class="footer-address">
                                        <p><span><i class="feather-map-pin"></i></span> 367 Hillcrest Lane, Irvine,
                                            California, United States</p>
                                    </div>
                                    <p><span><i class="feather-phone"></i></span> 321 546 8764</p>
                                    <p class="mb-0"><span><i class="feather-mail"></i></span> <a
                                            href="https://truelysell.dreamstechnologies.com/cdn-cgi/l/email-protection"
                                            class="__cf_email__"
                                            data-cfemail="1d696f687871646e7871715d78657c706d7178337e7270">[email&#160;protected]</a>
                                    </p>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-3 col-md-6">

                            <div class="footer-widget">
                                <h2 class="footer-title">Follow Us</h2>
                                <div class="social-icon">
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0);"><i class="fa-brands fa-facebook"></i> </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><i class="fab fa-twitter"></i> </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><i class="fa-brands fa-instagram"></i></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><i class="fa-brands fa-linkedin"></i></a>
                                        </li>
                                    </ul>
                                </div>
                                <h2 class="footer-subtitle">Newsletter Signup</h2>
                                <div class="subscribe-form">
                                    <input type="email" class="form-control" placeholder="Enter Email Address">
                                    <button type="submit" class="btn footer-btn">
                                        <i class="feather-send"></i>
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


            <div class="footer-bottom">
                <div class="container">

                    <div class="copyright">
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <div class="copyright-text">
                                    <p class="mb-0">Copyright &copy; {{ date('Y') }}. All Rights Reserved.</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="payment-image">
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0);"><img src="assets/img/payment/visa.png"
                                                    alt="img"></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><img src="assets/img/payment/mastercard.png"
                                                    alt="img"></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><img src="assets/img/payment/stripe.png"
                                                    alt="img"></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><img src="assets/img/payment/discover.png"
                                                    alt="img"></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4">

                                <div class="copyright-menu">
                                    <ul class="policy-menu">
                                        <li>
                                            <a href="privacy-policy.html">Privacy Policy</a>
                                        </li>
                                        <li>
                                            <a href="terms-condition.html">Terms & Conditions</a>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </footer>
        <div class="mouse-cursor cursor-outer"></div>
        <div class="mouse-cursor cursor-inner"></div>

    </div>




    <div class="progress-wrap active-progress">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"
                style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919px, 307.919px; stroke-dashoffset: 228.265px;">
            </path>
        </svg>
    </div>


    <script data-cfasync="false" src="{{ asset('assets/js/email-decode.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-3.7.0.min.js') }}" type="5cd0f04137fab20f355a2a1a-text/javascript"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
         // Initialize Select2
         $('.select2').select2({
                placeholder: "Select days",
                allowClear: true
            });
    </script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}" type="5cd0f04137fab20f355a2a1a-text/javascript"></script>

    <script src="{{ asset('assets/js/feather.min.js') }}" type="5cd0f04137fab20f355a2a1a-text/javascript"></script>

    <script src="{{ asset('assets/js/owl.carousel.min.js') }}" type="5cd0f04137fab20f355a2a1a-text/javascript"></script>

    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}" type="5cd0f04137fab20f355a2a1a-text/javascript"></script>

    <script src="{{ asset('assets/plugins/aos/aos.js') }}" type="5cd0f04137fab20f355a2a1a-text/javascript"></script>

    <script src="{{ asset('assets/js/backToTop.js') }}" type="5cd0f04137fab20f355a2a1a-text/javascript"></script>

    <script src="{{ asset('assets/js/script.js') }}" type="5cd0f04137fab20f355a2a1a-text/javascript"></script>
    <script src="{{ asset('assets/js/rocket-loader.min.js') }}" data-cf-settings="5cd0f04137fab20f355a2a1a-|49" defer>
    </script>
</body>

</html>
