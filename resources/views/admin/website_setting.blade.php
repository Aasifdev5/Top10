@extends('admin.Master')

@section('title')
    Configuración General
@endsection
@section('content')
    <div class="page-wrapper page-settings">
        <div class="content-sidelink">
            <div class="content-sidelinkheading">
                <h6>Settings</h6>
            </div>
            <div class="content-sidelinkmenu">
                <ul>
                    <li>
                        <h5>General Settings</h5>
                    </li>

                    <li><a href="{{ url('admin\edit_profile') }}">Account Settings </a></li>

                    {{-- <li><a href="notifications.html">Notifications</a></li> --}}

                </ul>




            </div>
        </div>
        <div class="content w-100">
            <div class="content-page-header">
                <h5>Site Information</h5>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="update_general_settings" enctype="multipart/form-data">
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
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="">Website Name:</label>
                                        <input type="text" class="form-control" name="site_name"
                                            value="{{ $settings->site_name }}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="">Website Timezone:</label>
                                        <select name="time_zone" value="" class="form-control select2">
                                            @foreach ($time as $row)
                                                <option
                                                    value="{{ str_replace(['(', '+', ')', '0', 'U', '5', '4', '3', '2', '1', '9', 'T', ':', 'C', '-', '6', '7', '8'], '', $row) }}">
                                                    {{ $row }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="fname">Website Logo:</label>
                                        <input type="file" class="form-control" onchange="previewImage(this)"
                                            name="site_logo">
                                        <img src="{{ asset('site_logo/') }}<?php echo '/' . $settings->site_logo; ?>" id="logoImagePreview"
                                            width="100" height="100">
                                    </div>
                                    <script>
                                        function previewImage(input) {
                                            var preview = document.getElementById('logoImagePreview');
                                            var file = input.files[0];
                                            var reader = new FileReader();

                                            reader.onloadend = function() {
                                                preview.src = reader.result;
                                            };

                                            if (file) {
                                                reader.readAsDataURL(file);
                                            } else {
                                                preview.src = "{{ asset('images/profile photo.png') }}"; // Default image when no file selected
                                            }
                                        }
                                    </script>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="fname">Website Language:</label>
                                        <select name="default_language" value="" class="form-control select2">
                                            <option value="English">English</option>
                                            <option value="">Hindi</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="fname">Website Favicon:</label>
                                        <input type="file" class="form-control" onchange="FpreviewImage(this)"
                                            name="site_favicon">
                                        <img src="{{ asset('site_favicon/') }}<?php echo '/' . $settings->site_favicon; ?>"
                                            id="faviconImagePreview" width="100" height="100">
                                    </div>
                                    <script>
                                        function FpreviewImage(input) {
                                            var preview = document.getElementById('faviconImagePreview');
                                            var file = input.files[0];
                                            var reader = new FileReader();

                                            reader.onloadend = function() {
                                                preview.src = reader.result;
                                            };

                                            if (file) {
                                                reader.readAsDataURL(file);
                                            } else {
                                                preview.src = "{{ asset('images/profile photo.png') }}"; // Default image when no file selected
                                            }
                                        }
                                    </script>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="fname">Website Supporrt Mobile
                                            Number:</label>

                                        <input type="text" name="styling" value="{{ $settings->styling }}"
                                            class="form-control">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="form-label" for="fname">Address:</label>

                                        <input type="text" name="address" value="{{ $settings->address }}"
                                            class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="fname">Website Email:</label>
                                        <input type="text" class="form-control" placeholder=""
                                            value="{{ $settings->site_email }}" name="site_email">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="fname">Currency:</label>
                                        <select name="currency_code" value="" class="form-control select2">
                                            @foreach ($currency as $row)
                                                <option value="{{ $row }}">{{ $row }}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="email">Website Description:</label>
                                        <textarea name="site_description" rows="10" class="form-control editor">{{ $settings->site_description }}</textarea>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="email">Website Keywords:</label>
                                        <textarea class="form-control editor" name="site_keywords">{{ $settings->site_keywords }}</textarea>
                                    </div>




                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="fname">Facebook URL:</label>
                                        <input type="text" class="form-control"
                                            value="{{ $settings->footer_fb_link }}" name="footer_fb_link">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="fname">Twitter URL:</label>
                                        <input type="text" class="form-control"
                                            value="{{ $settings->footer_twitter_link }}" name="footer_twitter_link">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="fname">Instagram URL:</label>
                                        <input type="text" class="form-control"
                                            value="{{ $settings->footer_instagram_link }}"
                                            name="footer_instagram_link">
                                    </div>


                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="email">Copy right</label>
                                        <input type="text" name="site_copyright" class="form-control"
                                            value="{{ $settings->site_copyright }}">
                                    </div>

                                </div>
                                <hr>

                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection
