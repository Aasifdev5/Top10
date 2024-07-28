@extends('admin.Master')
@section('title')
    {{ $title }}
@endsection
@section('content')
    <!-- Page content area start -->
    <div class="page-wrapper">
        <div class="container-fluid">
            <!-- sign up page start-->
            <div class="auth-bg-video">
                <video id="bgvid" poster="{{ asset('admin/images/coming-soon-bg.jpg') }}" playsinline="" autoplay=""
                    muted="" loop="">
                    <source src="{{ asset('admin/video/auth-bg.mp4') }}" type="video/mp4">
                </video>
                <div class="authentication-box" style="width: 1080px;">
                    <div class="text-center"><img src="assets/images/endless-logo.png" alt=""></div>
                    <div class="card mt-4 p-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-vertical__item bg-style">
                                    <div class="item-top mb-30">
                                        <h2>{{ __('Add New Color') }}</h2>
                                    </div>
                                    <form id="Form" action="{{ route('colors.store') }}" method="POST">
                                        @csrf

                                        <div class="input__group mb-25">
                                            <label for="name"> {{ __('Nombre') }} </label>
                                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                                class="form-control flat-input" placeholder="{{ __('Nombre') }}">
                                            @if ($errors->has('name'))
                                                <span class="text-danger"><i class="fas fa-exclamation-triangle"></i>
                                                    {{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
<br>
                                        <div class="input__group mb-25">
                                            <div class="">
                                                <button class="btn btn-primary" type="submit">Guardar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>F
            </div>
        </div>
    </div>
    <!-- Page content area end -->

    <script>
        $('#Form').submit(function(e) {
            e.preventDefault();

            let formData = new FormData(this); // Create FormData object

            $.ajax({
                type: "POST",
                url: "{{ route('colors.store') }}",
                data: formData,
                dataType: "json",
                contentType: false, // Set contentType to false for file uploads
                processData: false, // Set processData to false to prevent jQuery from automatically transforming the data
                success: function(response) {
                    if (response.success) {
                        toastr.success("Color successfully created.", "", {
                            onHidden: function() {
                                window.location.href = "{{ route('colors.index') }}";
                            }
                        });
                    } else {
                        toastr.error("Failed to create Color.");
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    toastr.error("Failed to create Color. Please try again later.");
                }
            });
        });
    </script>
@endsection
