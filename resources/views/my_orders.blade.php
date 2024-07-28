@extends('master')
@section('title')
 {{ __('Orders') }}
@endsection
@section('content')
<main class="main__content_wrapper">
    @if(Session::has('success'))
    <div class="alert alert-success" style="background-color: green;">
        <p style="color: #fff;">{{session::get('success')}}</p>
    </div>
    @endif
    @if(Session::has('fail'))
    <div class="alert alert-danger" style="background-color: red;">
        <p style="color: #fff;">{{session::get('fail')}}</p>
    </div>
    @endif

<style>
   .account__table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    .account__table--header {
        background-color: #f2f2f2;
    }
    .account__table--header__row {
        background-color: #f2f2f2;
    }
    .account__table--header__cell, .account__table--body__cell {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
        vertical-align: middle;
    }
    .account__table--body__row:hover {
        background-color: #f9f9f9;
    }
    .badge {
        font-size: 14px;
        font-weight: bold;
        padding: 6px 12px;
        border-radius: 4px;
        text-transform: uppercase;
    }
    .badge-success {
        background-color: #28a745;
        color: #fff;
    }
    .badge-warning {
        background-color: #ffc107;
        color: #212529;
    }
    .badge-danger {
        background-color: #dc3545;
        color: #fff;
    }
    .badge-secondary {
        background-color: #6c757d;
        color: #fff;
    }
    .btn-primary {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 8px 16px;
        border-radius: 4px;
        text-decoration: none;
        text-transform: uppercase;
        font-weight: bold;
        cursor: pointer;
    }
    .btn-primary:hover {
        background-color: #0056b3;
    }
    .account__table--body__row {
        border: 1px solid #ddd; /* Border for each row */
    }
</style>

    <!-- my account section start -->
    <section class="my__account--section section--padding">
        <div class="container">
            <p class="account__welcome--text">Hello, {{ $user_session->name }} welcome to your dashboard!</p>
            <div class="my__account--section__inner border-radius-10 d-flex">
                <div class="account__left--sidebar">
                    <h2 class="account__content--title mb-20">My Profile</h2>
                    <ul class="account__menu">
                        <li class="account__menu--list "><a href="{{ url('dashboard') }}">Dashboard</a></li>
                        <li class="account__menu--list"><a href="{{ url('address') }}">Addresses</a></li>
                        <li class="account__menu--list"><a href="{{ url('edit_profile') }}">Edit Profile</a></li>
                        <li class="account__menu--list"><a href="{{ url('change_password') }}">Change Password</a></li>
                        <li class="account__menu--list active"><a href="{{ url('MyOrders') }}">Orders</a></li>
                        <li class="account__menu--list"><a href="{{ url('wishlist') }}">Wishlist</a></li>
                        <li class="account__menu--list"><a href="{{ url('logout') }}">Log Out</a></li>
                    </ul>
                </div>
                <div class="account__wrapper">
                    <div class="account__content">
                        <h2 class="account__content--title h3 mb-20">Orders</h2>
                        <div class="table-responsive">
                         <table class="account__table table">
    <thead class="account__table--header">
        <tr class="account__table--header__row">
            <th class="account__table--header__cell">Order</th>
            <th class="account__table--header__cell">Date</th>

            <th class="account__table--header__cell">Product</th>
            <th class="account__table--header__cell">Total</th>
            <th class="account__table--header__cell">Invoice</th>
        </tr>
    </thead>
    <tbody class="account__table--body">
        @foreach ($orders as $order)
    @php
        $first = true;
    @endphp
    @foreach ($order->orderItems as $orderItem)
        @if ($orderItem->product) {{-- Ensure the product is not null --}}
            <tr class="account__table--body__row">
                @if ($first)
                    <td class="account__table--body__cell" rowspan="{{ count($order->orderItems) }}">{{ $order->id }}</td>
                    <td class="account__table--body__cell" rowspan="{{ count($order->orderItems) }}">{{ $order->created_at->format('F j, Y') }}</td>
                @endif
                <td class="account__table--body__cell">{{ $orderItem->product->title }}</td>
                <td class="account__table--body__cell">BS{{ number_format($orderItem->price * $orderItem->quantity, 2) }}</td>
                @if ($first)
                    <td class="account__table--body__cell" rowspan="{{ count($order->orderItems) }}">
                        <a href="{{ route('invoice.generate', ['id' => $order->id]) }}" class="btn btn-primary">Descargar factura</a>
                    </td>
                    @php
                        $first = false;
                    @endphp
                @endif
            </tr>
        @endif
    @endforeach
@endforeach

    </tbody>
</table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- my account section end -->

    <!-- Start shipping section -->
    <section class="shipping__section">
        <div class="container">
            <div class="shipping__inner style2 d-flex">
                <div class="shipping__items style2 d-flex align-items-center">
                    <div class="shipping__icon">
                        <img src="assets/img/other/shipping1.webp" alt="icon-img">
                    </div>
                    <div class="shipping__content">
                        <h2 class="shipping__content--title h3">Free Shipping</h2>
                        <p class="shipping__content--desc">Free shipping over $100</p>
                    </div>
                </div>
                <div class="shipping__items style2 d-flex align-items-center">
                    <div class="shipping__icon">
                        <img src="assets/img/other/shipping2.webp" alt="icon-img">
                    </div>
                    <div class="shipping__content">
                        <h2 class="shipping__content--title h3">Support 24/7</h2>
                        <p class="shipping__content--desc">Contact us 24 hours a day</p>
                    </div>
                </div>
                <div class="shipping__items style2 d-flex align-items-center">
                    <div class="shipping__icon">
                        <img src="assets/img/other/shipping3.webp" alt="icon-img">
                    </div>
                    <div class="shipping__content">
                        <h2 class="shipping__content--title h3">100% Money Back</h2>
                        <p class="shipping__content--desc">You have 30 days to Return</p>
                    </div>
                </div>
                <div class="shipping__items style2 d-flex align-items-center">
                    <div class="shipping__icon">
                        <img src="assets/img/other/shipping4.webp" alt="icon-img">
                    </div>
                    <div class="shipping__content">
                        <h2 class="shipping__content--title h3">Payment Secure</h2>
                        <p class="shipping__content--desc">We ensure secure payment</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End shipping section -->

</main>

@endsection
