<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    @php
        $general_setting = getApplicationsettings();
        $adminNotifications = adminNotifications();
    @endphp

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('site_favicon/') }}<?php echo '/' . $general_setting->site_favicon; ?>" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('site_favicon/') }}<?php echo '/' . $general_setting->site_favicon; ?>" type="image/x-icon">
    <title>{{ $general_setting->site_name }} || @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('admin/assets/css/select2.min.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/fontawesome/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/jvectormap/jquery-jvectormap-2.0.3.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/assets/css/dataTables.bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/feather/feather.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/assets/css/admin.css') }}">
</head>

<body>
    <div class="main-wrapper">

        <div class="header">
            <div class="header-left">
                <a href="{{ url('home') }}" class="logo">
                    <img src="{{ asset('site_logo/') }}<?php echo '/' . $general_setting->site_logo; ?>" alt="Logo" width="30" height="30">
                </a>
                <a href="{{ url('home') }}" class=" logo-small">
                    <img src="{{ asset('site_logo/') }}<?php echo '/' . $general_setting->site_logo; ?>" alt="Logo" width="30" height="30">
                </a>
            </div>
            <a class="mobile_btn" id="mobile_btn" href="javascript:void(0);">
                <i class="fas fa-align-left"></i>
            </a>
            <div class="header-split">
                <div class="page-headers">
                    <div class="search-bar">
                        <span><i class="fe fe-search"></i></span>
                        <input type="text" placeholder="Search" class="form-control">
                    </div>
                </div>
                <ul class="nav user-menu">

                    <li class="nav-item">
                        <a href="{{ url('home') }}" class="viewsite" target="_blank"><i
                                class="fe fe-globe me-2"></i>View Site</a>

                    </li>

                    <li>
                        <a href="#" class="btn btn-dropdown site-language" id="dropdownLanguage"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset(selectedLanguage(session()->get('local'))->flag) }}" width="50px"
                                height="30px" alt="icon">
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownLanguage">
                            @foreach (appLanguages() as $app_lang)
                                <li>
                                    <a class="dropdown-item" href="{{ url('admin/local/' . $app_lang->iso_code) }}">
                                        <img src="{{ asset($app_lang->flag) }}" width="50px" height="30px"
                                            alt="icon">
                                        <span>{{ $app_lang->language }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="nav-item  has-arrow dropdown-heads ">
                        <a href="javascript:void(0);" class="toggle-switch">
                            <i class="fe fe-moon"></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown has-arrow dropdown-heads">
                        <a href="javascript:void(0);" data-bs-toggle="dropdown">
                            <i class="fe fe-bell"></i>
                            <span class="badge rounded-pill bg-danger position-absolute"
                                style="top: 5px; left: 75%; transform: translate(-50%, -50%);">
                                @if ($adminNotifications)
                                    {{ count($adminNotifications) }}
                                @else
                                    0
                                @endif
                            </span>
                        </a>
                        <div class="dropdown-menu notifications">
                            <div class="topnav-dropdown-header">
                                <span class="notification-title">Notifications</span>
                                <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
                            </div>
                            <div class="noti-content">
                                <ul class="notification-list">
                                    @isset($adminNotifications)
                                        @forelse($adminNotifications as $notification)
                                            @if ($notification->sender)
                                                <li class="notification-message">
                                                    <a href="{{ route('notification.url', [$notification->uuid]) }}">
                                                        <div class="media d-flex">
                                                            <span class="avatar avatar-sm flex-shrink-0">
                                                                @if (!empty(\App\Models\User::getUserInfo($notification->sender_id)->profile_photo))
                                                                    <img class="avatar-img rounded-circle" alt="user"
                                                                        src="{{ asset('profile_photo/') . '/' . \App\Models\User::getUserInfo($notification->sender_id)->profile_photo }}"
                                                                        style="width: 50px; height: 50px;">
                                                                @else
                                                                    <img class="avatar-img rounded-circle"
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
                                        <button type="submit"
                                            class="btn btn-link dropdown-footer">{{ __('Mark all as read') }}</button>
                                    </form>
                                </div>
                            @endif
                            <div class="topnav-dropdown-footer">
                                <a href="{{ url('notification.index') }}">View all Notifications</a>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item  has-arrow dropdown-heads ">
                        <a href="javascript:void(0);" class="win-maximize">
                            <i class="fe fe-maximize"></i>
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a href="javascript:void(0)" class="user-link  nav-link" data-bs-toggle="dropdown">
                            <span class="user-img">
                                @if (!empty($user_session->profile_photo))
                                                <img src="{{ asset('profile_photo/') }}<?php echo '/' . $user_session->profile_photo; ?>"
                                                    class="rounded-circle" width="40" alt="Admin">
                                                    <span class="animate-circle"></span>
                                            @else
                                                <img src="images/profile photo.png" width="40" class="rounded-circle"
                                                    alt="Admin">
                                                    <span class="animate-circle"></span>
                                            @endif

                            </span>
                            <span class="user-content">
                                <span class="user-name">{{ $user_session->name }}</span>
                                <span class="user-details"></span>
                            </span>
                        </a>
                        <div class="dropdown-menu menu-drop-user">
                            <div class="profilemenu ">
                                <div class="user-detials">
                                    <a href="account.html">
                                        <span class="profile-image">
                                            @if (!empty($user_session->profile_photo))
                                                <img src="{{ asset('profile_photo/') }}<?php echo '/' . $user_session->profile_photo; ?>"
                                                    class="profilesidebar" alt="avatar">
                                            @else
                                                <img src="images/profile photo.png" class="profilesidebar"
                                                    alt="img">
                                            @endif

                                        </span>
                                        <span class="profile-content">
                                            <span>{{ $user_session->name }}</span>
                                            <span><span class="__cf_email__"
                                                    data-cfemail="f1bb9e999fb19489909c819d94df929e9c">@if (!empty($user_session->email))
                                                   {{ $user_session->email }}

                                                @endif</span></span>
                                        </span>
                                    </a>
                                </div>
                                <div class="subscription-menu">
                                    <ul>
                                        <li>
                                            <a href="{{ url('admin\edit_profile') }}">Profile</a>
                                        </li>
                                        <li>
                                            <a href="{{ url('admin\change_password') }}">Change Password</a>
                                        </li>
                                        <li>
                                            <a href="{{ url('admin\website_setting') }}">Settings</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="subscription-logout">
                                    <a href="{{ url('logout') }}">Log Out</a>
                                </div>
                            </div>
                        </div>
                    </li>

                </ul>
            </div>
        </div>


        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-logo">
                    <a href="{{ url('home') }}">
                        <img src="{{ asset('site_logo/') }}<?php echo '/' . $general_setting->site_logo; ?>" class="img-fluid logo" alt="Logo">
                    </a>
                    <a href="{{ url('home') }}">
                        <img src="{{ asset('site_logo/') }}<?php echo '/' . $general_setting->site_logo; ?>" class="img-fluid logo-small" alt="Logo">
                    </a>
                </div>
                <div class="siderbar-toggle">
                    <label class="switch" id="toggle_btn">
                        <input type="checkbox">
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="menu-title m-0">
                            <h6>Home</h6>
                        </li>
                        <li>
                            <a href="{{ url('admin\dashboard') }}" class="active"><i class="fe fe-grid"></i>
                                <span>Dashboard</span></a>
                        </li>
                        <li class="menu-title">
                            <h6>Services</h6>
                        </li>
                        <li>
                            <a href="javascript:void(0);"><i class="fe fe-briefcase"></i>
                                <span>Services</span>
                                <span class="menu-arrow"><i class="fe fe-chevron-right"></i></span>
                            </a>
                            <ul>
                                <li>
                                    <a href="{{ url('admin\add-service') }}">Add Service</a>
                                </li>
                                <li>
                                    <a href="{{ url('admin\services') }}">Services</a>
                                </li>
                                {{-- <li>
                                    <a href="service-settings.html">Service Settings</a>
                                </li> --}}
                            </ul>
                        </li>
                        <li>
                            <a href="{{ route('category.index') }}"><i class="fe fe-file-text"></i>
                                <span>Categories</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('subcategory.index') }}"><i class="fe fe-clipboard"></i> <span>Sub
                                    Categories</span></a>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><i class="fe fe-star"></i>
                                <span>Review</span>
                                <span class="menu-arrow"><i class="fe fe-chevron-right"></i></span>
                            </a>
                            <ul>
                                <li>
                                    <a href="review-type.html">Review Type</a>
                                </li>
                                <li>
                                    <a href="review.html">Review</a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-title">
                            <h6>Booking</h6>
                        </li>
                        <li>
                            <a href="booking.html"><i class="fe fe-smartphone"></i> <span> Bookings</span></a>
                        </li>
                        <li class="menu-title">
                            <h6>Finance & Accounts</h6>
                        </li>
                        <li>
                            <a href="banktransferlist.html"><i class="fe fe-file"></i>
                                <span>Bank Transfer</span>
                            </a>
                        </li>
                        <li>
                            <a href="wallet.html"><i class="fe fe-credit-card"></i>
                                <span>Wallet</span>
                            </a>
                        </li>
                        <li>
                            <a href="refund-request.html"><i class="fe fe-git-pull-request"></i> <span>Refund
                                    Request</span></a>
                        </li>
                        <li>
                            <a href="cash-on-delivery.html"><i class="fe fe-dollar-sign"></i> <span>Cash on
                                    Delivery</span></a>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><i class="fe fe-credit-card"></i>
                                <span>Payouts</span>
                                <span class="menu-arrow"><i class="fe fe-chevron-right"></i></span>
                            </a>
                            <ul>
                                <li>
                                    <a href="payout-request.html">Payout Requests</a>
                                </li>
                                <li>
                                    <a href="payout-settings.html">Payout Settings</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="sales-transactions.html"><i class="fe fe-bar-chart"></i> <span>Sales
                                    Transactions</span></a>
                        </li>
                        <li class="menu-title">
                            <h6>Others</h6>
                        </li>
                        <li>
                            <a href="chat.html"><i class="fe fe-message-square"></i> <span>Chat</span></a>
                        </li>
                        <li class="menu-title">
                            <h6>Content</h6>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><i class="fe fe-file"></i>
                                <span>Pages</span>
                                <span class="menu-arrow"><i class="fe fe-chevron-right"></i></span>
                            </a>
                            <ul>
                                <li>
                                    <a href="add-page.html">Add Page</a>
                                </li>
                                <li>
                                    <a href="pages-list.html">Pages</a>
                                </li>
                                <li>
                                    <a href="page-list.html">Pages List</a>
                                </li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><i class="fe fe-file-text"></i>
                                <span>Blog</span>
                                <span class="menu-arrow"><i class="fe fe-chevron-right"></i></span>
                            </a>
                            <ul>
                                <li>
                                    <a href="all-blog.html">All Blog</a>
                                </li>
                                <li>
                                    <a href="add-blog.html">Add Blog</a>
                                </li>
                                <li>
                                    <a href="blogs-categories.html">Categories</a>
                                </li>
                                <li>
                                    <a href="blogs-comments.html">Blog Comments</a>
                                </li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><i class="fe fe-map-pin"></i>
                                <span>Location</span>
                                <span class="menu-arrow"><i class="fe fe-chevron-right"></i></span>
                            </a>
                            <ul>
                                <li>
                                    <a href="countries.html">Countries</a>
                                </li>
                                <li>
                                    <a href="states.html">States</a>
                                </li>
                                <li>
                                    <a href="cities.html">Cities</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="testimonials.html"><i class="fe fe-star"></i> <span>Testimonials</span></a>
                        </li>
                        <li>
                            <a href="faq.html"><i class="fe fe-help-circle"></i> <span>FAQ</span></a>
                        </li>
                        <li class="menu-title">
                            <h6>Membership</h6>
                        </li>
                        <li>
                            <a href="membership.html"><i class="fe fe-user"></i> <span>Membership</span></a>
                        </li>
                        <li>
                            <a href="membership-addons.html"><i class="fe fe-user-plus"></i> <span>Membership
                                    Addons</span></a>
                        </li>
                        <li class="menu-title">
                            <h6>Reports</h6>
                        </li>
                        <li>
                            <a href="admin-earnings.html"><i class="fe fe-user"></i>
                                <span>Admin Earnings</span>
                            </a>
                        </li>
                        <li>
                            <a href="provider-earnings.html"><i class="fe fe-dollar-sign"></i>
                                <span>Provider Earnings</span>
                            </a>
                        </li>
                        <li>
                            <a href="provider-sales.html"><i class="fe fe-dollar-sign"></i>
                                <span>Provider Sales</span>
                            </a>
                        </li>
                        <li>
                            <a href="provider-wallet.html"><i class="fe fe-credit-card"></i>
                                <span>Provider Wallet</span>
                            </a>
                        </li>
                        <li>
                            <a href="customer-wallet.html"><i class="fe fe-user"></i>
                                <span>Customer Wallet</span>
                            </a>
                        </li>
                        <li>
                            <a href="membership-transaction.html"><i class="fe fe-tv"></i>
                                <span>Membership Transaction</span>
                            </a>
                        </li>
                        <li>
                            <a href="refund-report.html"><i class="fe fe-file-text"></i>
                                <span>Refund Report</span>
                            </a>
                        </li>
                        <li>
                            <a href="register-report.html"><i class="fe fe-git-pull-request"></i>
                                <span>Register Report</span>
                            </a>
                        </li>
                        <li>
                            <a href="service-sales.html"><i class="fe fe-bar-chart"></i>
                                <span>Sales Report</span>
                            </a>
                        </li>
                        <li class="menu-title">
                            <h6>User Management</h6>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><i class="fe fe-user"></i>
                                <span> Users</span>
                                <span class="menu-arrow"><i class="fe fe-chevron-right"></i></span>
                            </a>
                            <ul>
                                <li>
                                    <a href="users.html">Users</a>
                                </li>
                                <li>
                                    <a href="customers.html">Customers</a>
                                </li>
                                <li>
                                    <a href="providers.html">Providers </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="roles.html"><i class="fe fe-file"></i> <span>Roles & Permissions</span></a>
                        </li>
                        <li>
                            <a href="delete-account-requests.html"><i class="fe fe-trash-2"></i> <span>Delete Account
                                    Requests</span></a>
                        </li>
                        <li>
                            <a href="verification-request.html"><i class="fe fe-dollar-sign"></i><span>Verification
                                    Requests</span></a>
                        </li>
                        <li class="menu-title">
                            <h6>Marketing</h6>
                        </li>
                        <li>
                            <a href="coupons.html"><i class="fe fe-bookmark"></i> <span>Coupons</span></a>
                        </li>
                        <li>
                            <a href="offers.html"><i class="fe fe-briefcase"></i> <span>Service Offers</span></a>
                        </li>
                        <li>
                            <a href="featured-services.html"><i class="fe fe-briefcase"></i> <span>Featured
                                    Services</span></a>
                        </li>
                        <li>
                            <a href="email-newsletter.html"><i class="fe fe-mail"></i> <span>Email
                                    Newsletter</span></a>
                        </li>
                        <li class="menu-title">
                            <h6>Management</h6>
                        </li>
                        <li>
                            <a href="cachesystem.html"><i class="fe fe-user"></i>
                                <span>Cache System</span>
                            </a>
                        </li>
                        <li>
                            <a href="email-templates.html"><i class="fe fe-mail"></i> <span>Email Templates</span></a>
                        </li>
                        <li>
                            <a href="sms-templates.html"><i class="fe fe-message-square"></i> <span>SMS
                                    Templates</span></a>
                        </li>
                        <li>
                            <a href="menu-management.html"><i class="fe fe-file-text"></i> <span>Menu
                                    Management</span></a>
                        </li>
                        <li>
                            <a href="website-settings.html"><i class="fe fe-credit-card"></i> <span>Widgets</span></a>
                        </li>
                        <li>
                            <a href="create-menu.html"><i class="fe fe-list"></i> <span>Create Menu</span></a>
                        </li>
                        <li>
                            <a href="plugins-manager.html"><i class="fe fe-tv"></i><span>Plugin Managers</span> </a>
                        </li>
                        <li class="menu-title">
                            <h6>Support</h6>
                        </li>
                        <li>
                            <a href="contact-messages.html"><i class="fe fe-message-square"></i> <span>Contact
                                    Messages</span></a>
                        </li>
                        <li>
                            <a href="abuse-reports.html"><i class="fe fe-file-text"></i> <span>Abuse
                                    Reports</span></a>
                        </li>
                        <li>
                            <a href="announcements.html"><i class="fe fe-volume-2"></i> <span>Announcements</span></a>
                        </li>
                        <li class="menu-title">
                            <h6>Settings</h6>
                        </li>
                        <li>
                            <a href="{{ url('admin/website_setting') }}"><i class="fe fe-settings"></i>
                                <span>Settings</span></a>
                        </li>
                        <li>
                            <a href="{{ url('logout') }}"><i class="fe fe-log-out"></i> <span>Logout</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        @yield('content')
    </div>
    {{-- <div id="overlayer">
        <span class="loader">
            <span class="loader-inner"></span>
        </span>
    </div> --}}
    <!-- latest jquery-->


    <script src="{{ asset('assets/js/jquery-3.7.0.min.js') }}" type="text/javascript"></script>

    <script src="{{ asset('admin/assets/js/select2.min.js') }}" type="text/javascript"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
         // Initialize Select2
         $('.select2').select2({
                placeholder: "Select days",
                allowClear: true
            });
    </script>
    <script src="{{ asset('admin/assets/plugins/apexchart/apexcharts.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/assets/plugins/apexchart/chart-data.js') }}" type="text/javascript"></script>

    <script src="{{ asset('admin/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>

    <script src="{{ asset('admin/assets/js/feather.min.js') }}" type="text/javascript"></script>

    <script src="{{ asset('admin/assets/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/assets/js/dataTables.bootstrap4.min.js') }}" type="text/javascript"></script>

    <script src="{{ asset('admin/assets/plugins/slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>

    <script src="{{ asset('admin/assets/plugins/slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('admin/assets/plugins/jvectormap/jquery-jvectormap-world-mill.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('admin/assets/plugins/jvectormap/jquery-jvectormap-ru-mill.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('admin/assets/plugins/jvectormap/jquery-jvectormap-us-aea.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('admin/assets/plugins/jvectormap/jquery-jvectormap-uk_countries-mill.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('admin/assets/plugins/jvectormap/jquery-jvectormap-in-mill.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('admin/assets/js/jvectormap.js') }}" type="text/javascript"></script>

    <script src="{{ asset('admin/assets/plugins/sweetalert/sweetalert2.all.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/assets/plugins/sweetalert/sweetalerts.min.js') }}" type="text/javascript"></script>

    <script src="{{ asset('admin/assets/js/admin.js') }}" type="text/javascript"></script>


</body>

</html>
