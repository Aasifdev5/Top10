@extends('master')
@section('title')
    {{ __('Dashboard') }}
@endsection
@section('content')
    <div class="content">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 theiaStickySidebar">
                    <div class="settings-widget">
                        <div class="settings-header">
                            <div class="settings-img">
                                <img src="assets/img/profiles/avatar-02.jpg" alt="user">
                            </div>
                            <h6>{{ $user_session->name }}</h6>
                            <p>Member Since {{ \Carbon\Carbon::parse($user_session->created_at)->format('F Y') }}
                            </p>
                        </div>
                        <div class="settings-menu">
                            <ul>
                                <li>
                                    <a href="customer-dashboard.html" class="active">
                                        <i class="feather-grid"></i> <span>Dashboard</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="customer-booking.html">
                                        <i class="feather-smartphone"></i> <span>Bookings</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="customer-favourite.html">
                                        <i class="feather-heart"></i> <span>Favorites</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="customer-wallet.html">
                                        <i class="feather-credit-card"></i> <span>Wallet</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="customer-reviews.html">
                                        <i class="feather-star"></i> <span>Reviews</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="customer-chat.html">
                                        <i class="feather-message-circle"></i> <span>Chat</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="customer-profile.html">
                                        <i class="feather-settings"></i> <span>Settings</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('logout') }}">
                                        <i class="feather-log-out"></i> <span>Logout</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-9">
                    <div class="widget-title">
                        <h4>Dashboard</h4>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-lg-3">
                            <div class="dash-widget">
                                <div class="dash-img">
                                    <span class="dash-icon bg-yellow">
                                        <img src="assets/img/icons/dash-icon-01.svg" alt="image">
                                    </span>
                                    <div class="dash-value"><img src="assets/img/icons/up-icon.svg" alt="image"> +16.24%
                                    </div>
                                </div>
                                <div class="dash-info">
                                    <div class="dash-order">
                                        <h6>Total Orders</h6>
                                        <h5>27</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="dash-widget">
                                <div class="dash-img">
                                    <span class="dash-icon bg-blue">
                                        <img src="assets/img/icons/wallet-icon-01.svg" alt="image">
                                    </span>
                                    <div class="dash-value text-danger"><img src="assets/img/icons/down-icon.svg"
                                            alt="image"> +18.52%</div>
                                </div>
                                <div class="dash-info">
                                    <div class="dash-order">
                                        <h6>Total Spend</h6>
                                        <h5>$2500</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="dash-widget">
                                <div class="dash-img">
                                    <span class="dash-icon bg-blue">
                                        <img src="assets/img/icons/wallet-add.svg" alt="image">
                                    </span>
                                    <div class="dash-value"><img src="assets/img/icons/up-icon.svg" alt="image"> +12.10%
                                    </div>
                                </div>
                                <div class="dash-info">
                                    <div class="dash-order">
                                        <h6>Wallet</h6>
                                        <h5>$200</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="dash-widget">
                                <div class="dash-img">
                                    <span class="dash-icon bg-light-danger">
                                        <img src="assets/img/icons/wallet-amt.svg" alt="image">
                                    </span>
                                    <div class="dash-value"><img src="assets/img/icons/up-icon.svg" alt="image"> +08.15%
                                    </div>
                                </div>
                                <div class="dash-info">
                                    <div class="dash-order">
                                        <h6>Total Savings</h6>
                                        <h5>$354</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-lg-8 d-flex flex-column">
                            <h6 class="user-title">Recent Booking</h6>
                            <div class="table-responsive recent-booking flex-fill">
                                <table class="table mb-0">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="#" class="avatar avatar-m me-2"><img
                                                            class="avatar-img rounded"
                                                            src="assets/img/services/service-06.jpg" alt="User Image"></a>
                                                    <a href="#">Computer Repair<span><i class="feather-calendar"></i>
                                                            22 Sep 2023</span></a>
                                                </h2>
                                            </td>
                                            <td>
                                                <h2 class="table-avatar table-user">
                                                    <a href="#" class="avatar avatar-m me-2"><img class="avatar-img"
                                                            src="assets/img/profiles/avatar-02.jpg" alt="User Image"></a>
                                                    <a href="#">
                                                        John Smith
                                                        <span><span class="__cf_email__"
                                                                data-cfemail="9bf1f4f3f5dbfee3faf6ebf7feb5f8f4f6">[email&nbsp;protected]</span></span>
                                                    </a>
                                                </h2>
                                            </td>
                                            <td class="text-end">
                                                <a href="#" class="btn btn-light-danger">Cancel</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="#" class="avatar avatar-m me-2"><img
                                                            class="avatar-img rounded"
                                                            src="assets/img/services/service-04.jpg" alt="User Image"></a>
                                                    <a href="#">Car Repair Services<span><i
                                                                class="feather-calendar"></i> 20 Sep 2023</span></a>
                                                </h2>
                                            </td>
                                            <td>
                                                <h2 class="table-avatar table-user">
                                                    <a href="#" class="avatar avatar-m me-2"><img
                                                            class="avatar-img" src="assets/img/profiles/avatar-03.jpg"
                                                            alt="User Image"></a>
                                                    <a href="#">
                                                        Timothy
                                                        <span><span class="__cf_email__"
                                                                data-cfemail="186c7175776c7061587d60797568747d367b7775">[email&nbsp;protected]</span></span>
                                                    </a>
                                                </h2>
                                            </td>
                                            <td class="text-end">
                                                <a href="#" class="btn btn-light-danger">Cancel</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="#" class="avatar avatar-m me-2"><img
                                                            class="avatar-img rounded"
                                                            src="assets/img/services/service-07.jpg" alt="User Image"></a>
                                                    <a href="#">Interior Designing<span><i
                                                                class="feather-calendar"></i> 19 Sep 2023</span></a>
                                                </h2>
                                            </td>
                                            <td>
                                                <h2 class="table-avatar table-user">
                                                    <a href="#" class="avatar avatar-m me-2"><img
                                                            class="avatar-img" src="assets/img/profiles/avatar-06.jpg"
                                                            alt="User Image"></a>
                                                    <a href="#">
                                                        Jordan
                                                        <span><span class="__cf_email__"
                                                                data-cfemail="157f7a6771747b55706d74786579703b767a78">[email&nbsp;protected]</span></span>
                                                    </a>
                                                </h2>
                                            </td>
                                            <td class="text-end">
                                                <a href="#" class="btn btn-light-danger">Cancel</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="#" class="avatar avatar-m me-2"><img
                                                            class="avatar-img rounded"
                                                            src="assets/img/services/service-08.jpg" alt="User Image"></a>
                                                    <a href="#">Steam Car Wash<span><i class="feather-calendar"></i>
                                                            18 Sep 2023</span></a>
                                                </h2>
                                            </td>
                                            <td>
                                                <h2 class="table-avatar table-user">
                                                    <a href="#" class="avatar avatar-m me-2"><img
                                                            class="avatar-img" src="assets/img/profiles/avatar-09.jpg"
                                                            alt="User Image"></a>
                                                    <a href="#">
                                                        Armand
                                                        <span><span class="__cf_email__"
                                                                data-cfemail="2041524d414e44604558414d504c450e434f4d">[email&nbsp;protected]</span></span>
                                                    </a>
                                                </h2>
                                            </td>
                                            <td class="text-end">
                                                <a href="#" class="btn btn-light-danger">Cancel</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="#" class="avatar avatar-m me-2"><img
                                                            class="avatar-img rounded"
                                                            src="assets/img/services/service-09.jpg" alt="User Image"></a>
                                                    <a href="#">House Cleaning Services<span><i
                                                                class="feather-calendar"></i> 17 Sep 2023</span></a>
                                                </h2>
                                            </td>
                                            <td>
                                                <h2 class="table-avatar table-user">
                                                    <a href="#" class="avatar avatar-m me-2"><img
                                                            class="avatar-img" src="assets/img/profiles/avatar-10.jpg"
                                                            alt="User Image"></a>
                                                    <a href="#">
                                                        Joseph
                                                        <span><span class="__cf_email__"
                                                                data-cfemail="573d382432273f17322f363a273b327934383a">[email&nbsp;protected]</span></span>
                                                    </a>
                                                </h2>
                                            </td>
                                            <td class="text-end">
                                                <a href="#" class="btn btn-light-danger">Cancel</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>


                        <div class="col-lg-4 d-flex flex-column">
                            <h6 class="user-title">Recent Transaction</h6>
                            <div class="table-responsive transaction-table flex-fill">
                                <table class="table mb-0">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="table-book d-flex align-items-center">
                                                    <span class="book-img">
                                                        <img src="assets/img/icons/trans-icon-01.svg" alt="Icon">
                                                    </span>
                                                    <div>
                                                        <h6>Service Booking</h6>
                                                        <p><i class="feather-calendar"></i>22 Sep 2023 <span><i
                                                                    class="feather-clock"></i> 10:12 AM</span></p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-end">
                                                <h5 class="trans-amt">$280.00</h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="table-book d-flex align-items-center">
                                                    <span class="book-img">
                                                        <img src="assets/img/icons/trans-icon-02.svg" alt="image">
                                                    </span>
                                                    <div>
                                                        <h6>Service Refund</h6>
                                                        <p><i class="feather-calendar"></i>22 Sep 2023 <span><i
                                                                    class="feather-clock"></i> 10:12 AM</span></p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-end">
                                                <h5 class="trans-amt">$100.00</h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="table-book d-flex align-items-center">
                                                    <span class="book-img">
                                                        <img src="assets/img/icons/trans-icon-03.svg" alt="image">
                                                    </span>
                                                    <div>
                                                        <h6>Wallet Topup</h6>
                                                        <p><i class="feather-calendar"></i>22 Sep 2023 <span><i
                                                                    class="feather-clock"></i> 10:12 AM</span></p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-end">
                                                <h5 class="trans-amt">$1000.00</h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="table-book d-flex align-items-center">
                                                    <span class="book-img">
                                                        <img src="assets/img/icons/trans-icon-01.svg" alt="Icon">
                                                    </span>
                                                    <div>
                                                        <h6>Service Booking</h6>
                                                        <p><i class="feather-calendar"></i>22 Sep 2023 <span><i
                                                                    class="feather-clock"></i> 10:12 AM</span></p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-end">
                                                <h5 class="trans-amt">$280.00</h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="table-book d-flex align-items-center">
                                                    <span class="book-img">
                                                        <img src="assets/img/icons/trans-icon-01.svg" alt="Icon">
                                                    </span>
                                                    <div>
                                                        <h6>Service Booking</h6>
                                                        <p><i class="feather-calendar"></i>22 Sep 2023 <span><i
                                                                    class="feather-clock"></i> 10:12 AM</span></p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-end">
                                                <h5 class="trans-amt">$280.00</h5>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
