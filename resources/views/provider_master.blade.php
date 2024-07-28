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

<body class="provider-body">
    <div class="main-wrapper">
        <div class="header">
            <div class="header-left">
                <div class="sidebar-logo">
                    <a href="{{ url('home') }}">
                        <img src="{{ asset('site_logo/') }}<?php echo '/' . $general_setting->site_logo; ?>" class="img-fluid logo" alt="Logo">
                    </a>
                    <a href="{{ url('home') }}">
                        <img src="{{ asset('site_logo/') }}<?php echo '/' . $general_setting->site_logo; ?>" class="img-fluid logo-small"
                            alt="Logo">
                    </a>
                </div>
                <div class="siderbar-toggle">
                    <label class="switch" id="toggle_btn">
                        <input type="checkbox">
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
            <a class="mobile_btns" id="mobile_btns" href="javascript:void(0);">
                <i class="fas fa-align-left"></i>
            </a>
            <div class="header-split">
                <div class="page-headers">
                    <div class="search-bar">
                        <span><i class="feather-search"></i></span>
                        <input type="text" placeholder="Search" class="form-control">
                    </div>
                </div>
                <ul class="nav user-menu noti-pop-detail">

                    <li class="nav-item">
                        <a href="{{ url('home') }}" class="viewsite" target="_blank"><i
                                class="fe fe-globe me-2"></i>View Site</a>

                    </li>

                    <li class="nav-item dropdown has-arrow dropdown-heads flag-nav">
                        <a class="nav-link" data-bs-toggle="dropdown" href="#" role="button">
                            <img src="{{ asset(selectedLanguage(session()->get('local'))->flag) }}" alt="Flag"
                                height="20">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            @foreach (appLanguages() as $app_lang)
                                <a class="dropdown-item" href="{{ url('admin/local/' . $app_lang->iso_code) }}">
                                    <img src="{{ asset($app_lang->flag) }}" class="me-2" alt="Flag"
                                        height="16">
                                    <span>{{ $app_lang->language }}</span>
                                </a>
                            @endforeach
                        </div>
                    </li>

                    <li class="nav-item has-arrow dropdown-heads">
                        <a href="#">
                            <i class="feather-moon"></i>
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


                    <li class="nav-item  has-arrow dropdown-heads ">
                        <a href="#" class="win-maximize">
                            <i class="feather-maximize"></i>
                        </a>
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
                            <a class="dropdown-item" href="{{ url('provider-dashboard') }}">
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
            </div>
        </div>

        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="active">
                            <a href="{{ url('provider-dashboard') }}"><i class="feather-grid"></i>
                                <span>Dashboard</span></a>
                        </li>
                        <li>
                            <a href="{{ url('provider-services') }}"><i class="feather-briefcase"></i> <span>My
                                    Services</span></a>
                        </li>
                        <li>
                            <a href="provider-booking.html"><i class="feather-calendar"></i> <span>Bookings
                                </span></a>
                        </li>
                        <li>
                            <a href="provider-payout.html"><i class="feather-credit-card"></i> <span>Payout</span></a>
                        </li>
                        <li>
                            <a href="provider-availability.html"><i class="feather-clock"></i>
                                <span>Availability</span></a>
                        </li>
                        <li>
                            <a href="provider-holiday.html"><i class="feather-calendar"></i> <span>Holidays &amp;
                                    Leave</span></a>
                        </li>
                        <li>
                            <a href="provider-coupons.html"><i class="feather-bookmark"></i> <span>Coupons</span></a>
                        </li>
                        <li>
                            <a href="provider-subscription.html"><i class="feather-dollar-sign"></i>
                                <span>Subscription</span></a>
                        </li>
                        <li>
                            <a href="provider-offers.html"><i class="feather-percent"></i> <span>Offers</span></a>
                        </li>
                        <li>
                            <a href="provider-reviews.html"><i class="feather-star"></i> <span>Reviews</span></a>
                        </li>
                        <li>
                            <a href="provider-earnings.html"><i class="feather-dollar-sign"></i>
                                <span>Earnings</span></a>
                        </li>
                        <li>
                            <a href="provider-chat.html"><i class="feather-message-circle"></i> <span>Chat</span></a>
                        </li>
                        <li class="submenu">
                            <a href="provider-settings.html"><i class="feather-settings"></i> <span>Settings</span>
                                <span class="menu-arrow"></span></a>
                            <ul>
                                <li>
                                    <a href="provider-appointment-settings.html">Appointment Settings</a>
                                </li>
                                <li>
                                    <a href="provider-profile-settings.html">Account Settings</a>
                                </li>
                                <li>
                                    <a href="provider-social-profile.html">Social Profiles</a>
                                </li>
                                <li>
                                    <a href="provider-security-settings.html">Security Setting</a>
                                </li>
                                <li>
                                    <a href="provider-plan.html">Plan &amp; Billings</a>
                                </li>
                                <li>
                                    <a href="payment-settings.html">Payment Settings</a>
                                </li>
                                <li>
                                    <a href="provider-notifcations.html">Notifications</a>
                                </li>
                                <li>
                                    <a href="provider-connected-apps.html">Connected Apps</a>
                                </li>
                                <li>
                                    <a href="verification.html">Profile Verification</a>
                                </li>
                                <li>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#del-account">Delete
                                        Account</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ url('home') }}"><i class="feather-log-out"></i> <span>Logout</span></a>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
        @yield('content')
    </div>
    <script data-cfasync="false" src="{{ asset('assets/js/email-decode.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-3.7.0.min.js') }}" type="61cbd6f16edbd9e673809f3d-text/javascript"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
         // Initialize Select2
         $('.select2').select2({
                placeholder: "Select days",
                allowClear: true
            });
    </script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}" type="61cbd6f16edbd9e673809f3d-text/javascript"></script>

    <script src="{{ asset('assets/js/feather.min.js') }}" type="61cbd6f16edbd9e673809f3d-text/javascript"></script>

    <script src="{{ asset('assets/js/owl.carousel.min.js') }}" type="61cbd6f16edbd9e673809f3d-text/javascript"></script>

    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}" type="61cbd6f16edbd9e673809f3d-text/javascript"></script>

    <script src="{{ asset('assets/plugins/aos/aos.js') }}" type="61cbd6f16edbd9e673809f3d-text/javascript"></script>

    <script src="{{ asset('assets/js/backToTop.js') }}" type="61cbd6f16edbd9e673809f3d-text/javascript"></script>

    <script src="{{ asset('assets/js/script.js') }}" type="61cbd6f16edbd9e673809f3d-text/javascript"></script>
    <script src="{{ asset('assets/js/rocket-loader.min.js') }}" data-cf-settings="61cbd6f16edbd9e673809f3d-|49" defer>
    </script>
</body>

</html>
