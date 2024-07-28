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
                                        <h2>{{ __('Add New Tax') }}</h2>
                                    </div>
                                    <form id="Form" action="{{ route('tax.store') }}" method="POST">
                                        @csrf
                                        <div class="input__group mb-25">
                                            <label for="name"> {{ __('Nombre') }} </label>
                                            <input type="text" name="title" id="name" value="{{ old('title') }}" class="form-control flat-input">
                                            @if ($errors->has('title'))
                                                <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('title') }}</span>
                                            @endif
                                        </div>

                                        <div class="input__group mb-25">
                                            <label for="percentage"> {{ __('Percentage') }} </label>
                                            <input type="text" name="percentage" id="percentage" value="{{ old('percentage') }}" class="form-control flat-input">
                                            @if ($errors->has('percentage'))
                                                <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('percentage') }}</span>
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

        let formData = new FormData(this);

        $.ajax({
            type: "POST",
            url: "{{ route('tax.store') }}",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.success) {
                    toastr.success("Tax successfully created.", "", {
                        onHidden: function() {
                            window.location.href = "{{ route('tax.index') }}";
                        }
                    });
                } else {
                    toastr.error("Failed to create tax.");
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                let errors = xhr.responseJSON.errors;
                for (let key in errors) {
                    toastr.error(errors[key][0]);
                }
                toastr.error("Failed to create tax. Please try again later.");
            }
        });
    });

    </script>
@endsection
