@extends('master')
@section('title')
    Login
@endsection
@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-6 mx-auto">
                    <div class="login-wrap">
                        <div class="login-header">
                            <h3>Login</h3>
                            <p>Please enter your details</p>
                            <h6>Sign in with <a href="login-phone.html">Phone Number</a></h6>
                        </div>

                        <form action="{{ url('log') }}" method="POST">
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
                            <div class="log-form">
                                <div class="form-group">
                                    <label class="col-form-label">Email</label>
                                    <input type="text" class="form-control" name="email"
                                        placeholder="johndoe@example.com">
                                    <span class="text-danger">
                                        @error('email')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label class="col-form-label">Password</label>
                                        </div>
                                        <div class="col-auto">
                                            <a class="forgot-link" href="password-recovery.html">
                                                Forgot password?
                                            </a>
                                        </div>
                                    </div>
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
                                <div class="row">
                                    <div class="col-6">
                                        <label class="custom_check">
                                            <input type="checkbox" name="rememberme" class="rememberme">
                                            <span class="checkmark"></span>Remember Me
                                        </label>
                                    </div>
                                    <div class="col-6 text-end">
                                        <label class="custom_check">
                                            <input type="checkbox" name="loginotp" class="loginotp">
                                            <span class="checkmark"></span>Login with OTP
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary w-100 login-btn" type="submit">Login</button>
                            <div class="login-or">
                                <span class="or-line"></span>
                                <span class="span-or">OR</span>
                            </div>
                            <div class="social-login">
                                <a href="#" class="btn btn-google w-100"><img src="assets/img/icons/google.svg"
                                        class="me-2" alt="img">Login with Google</a>

                            </div>
                            <p class="no-acc">Don't have an account ? <a href="{{ url('choose-signup') }}">Register</a></p>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
