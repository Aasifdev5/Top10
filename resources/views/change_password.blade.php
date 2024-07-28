@extends('master')
@section('title')
    {{ __('Cambiar Contraseña') }}
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
        <!-- Start breadcrumb section -->
        <section class="breadcrumb__section breadcrumb__bg">
            <div class="container">
                <div class="row row-cols-1">
                    <div class="col">
                        <div class="breadcrumb__content text-center">
                            <ul class="breadcrumb__content--menu d-flex justify-content-center">
                                <li class="breadcrumb__content--menu__items"><a href="{{ url('/') }}">Home</a></li>
                                <li class="breadcrumb__content--menu__items"><span>My Account</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End breadcrumb section -->

        <!-- my account section start -->
        <section class="my__account--section section--padding">
            <div class="container">

                <div class="my__account--section__inner border-radius-10 d-flex">
                    <div class="account__left--sidebar">
                        <h2 class="account__content--title mb-20">My Profile</h2>
                        <ul class="account__menu">
                            <li class="account__menu--list "><a href="{{ url('dashboard') }}">Dashboard</a></li>
                            <li class="account__menu--list"><a href="{{ url('address') }}">Addresses</a></li>
                            <li class="account__menu--list "><a href="{{ url('edit_profile') }}">Edit Profile</a></li>
                            <li class="account__menu--list active"><a href="{{ url('change_password') }}">Change Password</a></li>
                            <li class="account__menu--list"><a href="{{ url('MyOrders') }}">Orders</a></li>
                            <li class="account__menu--list"><a href="{{ url('wishlist') }}">Wishlist</a></li>
                            <li class="account__menu--list"><a href="{{ url('logout') }}">Log Out</a></li>
                        </ul>
                    </div>
                    <div class="account__wrapper">
                        <div class="account__content">
                            <h2 class="account__content--title h3 mb-20">Change Password</h2>
                            <div class="account__table--area">
                                <form class="theme-form" action="update_password" method="post">
                                    @if (Session::has('success'))
                                        <div class="alert alert-success">
                                            <p>{{ session::get('success') }}</p>
                                        </div>
                                    @endif
                                    @if (Session::has('fail'))
                                        <div class="alert alert-danger">
                                            <p>{{ session::get('fail') }}</p>
                                        </div>
                                    @endif
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $user_session->id }}">
                                    <div class="row g-1">

                                            <div class="mb-3">
                                                <label class="col-form-label">{{ __('Nueva Contraseña') }}</label>
                                                <input class="form-control" type="password" name="new_password"
                                                    value="{{ old('new_password') }}">
                                                <span class="text-danger">
                                                    @error('new_password')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>

                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label">{{ __('Confirmar Contraseña') }}</label>
                                        <input class="form-control" type="password" name="confirm_password"
                                            value="{{ old('confirm_password') }}">
                                        <span class="text-danger">
                                            @error('confirm_password')
                                                {{ $message }}
                                            @enderror
                                        </span>

                                    </div>


                                    <div class="row g-2">
                                        <div class="col-sm-4">
                                            <button class="btn btn-primary btn-block" type="submit">{{ __('Actualizar') }}</button>
                                        </div>

                                    </div>

                                </form>
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
