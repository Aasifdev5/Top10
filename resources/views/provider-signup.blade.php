@extends('master')
@section('title')
    provider-signup
@endsection
@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-6 mx-auto">
                    <div class="login-wrap">
                        <div class="login-header">
                            <h3>Provider Signup</h3>
                        </div>

                        <form action="{{ url('preg') }}" method="POST">
                            @if (Session::has('success'))
                                <div class="alert alert-success" style="background-color: green;">
                                    <p style="color: #fff;">{{ session::get('success') }}</p>
                                </div>
                            @endif
                            @if (Session::has('fail'))
                                <div class="alert alert-danger" style="background-color: red;">
                                    <p style="color: #fff;">{{ session::get('fail') }}</p>
                                </div>
                            @endif
                            @csrf
                            <div class="form-group">
                                <label class="col-form-label">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter your name">
                                <span class="text-danger">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="johndoe@example.com">
                                <span class="text-danger">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="col-form-label">Phone Number</label>
                                    <div class="form-group">
                                        <input type="text" name="mobile_number"
                                            class="form-control form-control-lg group_formcontrol" id="phone"
                                            name="phone" placeholder="(256) 789-6253">
                                            <span class="text-danger">
                                                @error('mobile_number')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label d-block">Password<span class="brief-bio float-end">Must
                                        be 8 Characters at Least</span></label>
                                <div class="pass-group">
                                    <input type="password" name="password" class="form-control pass-input"
                                        placeholder="*************">
                                    <span class="toggle-password feather-eye-off"></span>
                                </div>
                                <span class="text-danger">
                                    @error('password')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 login-btn">Signup</button>
                            <div class="login-or">
                                <span class="or-line"></span>
                                <span class="span-or">Or, log in with your email</span>
                            </div>
                            <div class="social-login">
                                <a href="#" class="btn btn-google w-100"><img src="assets/img/icons/google.svg"
                                        class="me-2" alt="img">Log in with Google</a>

                            </div>
                            <p class="no-acc">Already have an account ? <a href="{{ url('Userlogin') }}"> Sign In</a></p>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
