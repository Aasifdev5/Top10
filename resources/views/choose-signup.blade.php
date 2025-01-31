@extends('master')
@section('title')
    Choose-signup
@endsection
@section('content')
    <div class="content">
        <div class="container">
            <div class="row">

                <div class="col-md-6 col-lg-6 mx-auto">
                    <div class="login-wrap">
                        <div class="login-header">
                            <h3>Sign Up</h3>
                        </div>
                        <div class="row">

                            <div class="col-md-6 d-flex">
                                <div class="choose-signup flex-fill">
                                    <h6>Providers</h6>
                                    <div class="choose-img">
                                        <img src="{{ asset('assets/img/provider.png') }}" alt="image">
                                    </div>
                                    <a href="{{ url('provider-signup') }}" class="btn btn-secondary w-100">Sign Up<i
                                            class="feather-arrow-right-circle ms-1"></i></a>
                                </div>
                            </div>


                            <div class="col-md-6 d-flex">
                                <div class="choose-signup flex-fill mb-0">
                                    <h6>Users</h6>
                                    <div class="choose-img">
                                        <img src="{{ asset('assets/img/user.png') }}" alt="image">
                                    </div>
                                    <a href="{{ url('user-signup') }}" class="btn btn-secondary w-100">Sign Up<i
                                            class="feather-arrow-right-circle ms-1"></i></a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
