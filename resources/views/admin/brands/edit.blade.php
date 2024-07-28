@extends('admin.Master')
@section('title')
    {{ $title }}
@endsection
@section('content')
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
                                        <h2>{{ __('Edit Category') }}</h2>
                                    </div>
                                    <form id="Form" enctype="multipart/form-data">
                                        @csrf

                                        <div class="input__group mb-25">
                                            <label for="name"> {{ __('Nombre') }} </label>
                                            <div>
                                                <input type="text" name="name" id="name"
                                                    value="{{ $category->name }}" class="form-control flat-input"
                                                    placeholder=" {{ __('Nombre') }} ">
                                                @if ($errors->has('name'))
                                                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i>
                                                        {{ $errors->first('name') }}</span>
                                                @endif
                                            </div>
                                        </div>







                                      <br>

                                        <div class="input__group">
                                            <div>
                                                <button class="btn btn-primary" type="submit">Actualizar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page content area end -->
    </div>
    <!-- jQuery (required) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#Form').submit(function(e) {
            e.preventDefault();

            let formData = new FormData(this); // Create FormData object

            $.ajax({
                type: "POST",
                url: "{{ route('brands.update', [$category->id]) }}",
                data: formData,
                dataType: "json",
                contentType: false, // Set contentType to false for file uploads
                processData: false, // Set processData to false to prevent jQuery from automatically transforming the data
                success: function(response) {
                    if (response.success) {
                        toastr.success("brand successfully updated.", "", {
                            onHidden: function() {
                                window.location.href = "{{ route('brands.index') }}";
                            }
                        });
                    } else {
                        toastr.error("Failed to update brand.");
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    toastr.error("Failed to update brand. Please try again later.");
                }
            });
        });
    </script>
@endsection
