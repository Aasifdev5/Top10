<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php
        $general_setting = getApplicationsettings();
    @endphp
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('site_favicon/') }}<?php echo '/' . $general_setting->site_favicon; ?>" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('site_favicon/') }}<?php echo '/' . $general_setting->site_favicon; ?>" type="image/x-icon">
    <title>{{ $general_setting->site_name }} || Administrador</title>
    <link rel="stylesheet" href="{{ asset('admin/assets/css/feather.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/assets/css/select2.min.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/fontawesome/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/bootstrap/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/assets/css/admin.css') }}">
</head>

<body>
    <div class="main-wrapper">
        <div class="login-pages">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <div class="login-logo">
                            <img src="{{ asset('admin/assets/img/logo-login.png') }}" alt="img">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="login-images">
                            <img src="{{ asset('admin/assets/img/login-banner.png') }}" alt="img">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="login-content">
                            <div class="login-contenthead">
                                <h5>Login</h5>

                            </div>
                            <form  action="{{ url('admin/log') }}" method="post">
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
                            <div class="login-input">
                                <div class="form-group">
                                    <label>E-mail</label>
                                    <input type="text" name="email" class="form-control" placeholder="example@email.com">
                                    <span class="text-danger">
                                        @error('email')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group">
                                    <div class="d-flex justify-content-between">
                                        <label>Password</label>
                                        <a class="forgetpassword-link" href="forget_password">Forgot password?</a>
                                    </div>
                                    <div class="pass-group">
                                        <input type="password" name="password" class="form-control pass-input" placeholder="********">
                                        <span class="fas toggle-password fa-eye-slash"></span>
                                    </div>
                                    <span class="text-danger">
                                        @error('password')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="filter-checkbox m-0">
                                    <ul class="d-flex justify-content-between">
                                        <li>
                                            <label class="checkboxs">
                                                <input type="checkbox">
                                                <span><i></i></span>
                                                <b class="check-content">Remember Me</b>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <br>
                            <div class="login-button">
                                <button type="submit" class="btn btn-login">Login</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- latest jquery-->
    <script src="{{ asset('admin/assets/js/jquery-3.7.0.min.js') }}" type="927ea5f7655e88e17654ea40-text/javascript"></script>

    <script src="{{ asset('admin/assets/js/select2.min.js') }}" type="927ea5f7655e88e17654ea40-text/javascript"></script>

    <script src="{{ asset('admin/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}" type="927ea5f7655e88e17654ea40-text/javascript"></script>

    <script src="{{ asset('admin/assets/plugins/sweetalert/sweetalert2.all.min.js') }}" type="927ea5f7655e88e17654ea40-text/javascript"></script>
    <script src="{{ asset('admin/assets/plugins/sweetalert/sweetalerts.min.js') }}" type="927ea5f7655e88e17654ea40-text/javascript"></script>

    <script src="{{ asset('admin/assets/js/admin.js') }}" type="927ea5f7655e88e17654ea40-text/javascript"></script>
    <script src="{{ asset('admin/assets/js/rocket-loader.min.js') }}" data-cf-settings="5cd0f04137fab20f355a2a1a-|49"
        defer></script>
</body>

</html>
