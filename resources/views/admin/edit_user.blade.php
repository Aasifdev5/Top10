@extends('admin.Master')
@section('title')
    Edit User
@endsection
@section('content')
    <!-- page-wrapper Start-->
    <div class="page-wrapper">
        <div class="container-fluid">
            <!-- sign up page start-->
            <div class="auth-bg-video">
                <video id="bgvid" poster="{{ asset('admin/images/coming-soon-bg.jpg') }}" playsinline="" autoplay=""
                    muted="" loop="">
                    <source src="{{ asset('admin/video/auth-bg.mp4') }}" type="video/mp4">
                </video>
                <div class="col-sm-8">
                    <div class="text-center"><img src="assets/images/endless-logo.png" alt=""></div>
                    <div class="card mt-4 p-4">
                        <h4 class="text-center">Edit User</h4>

                        <form class="theme-form" action="{{ url('admin/update_user') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @if (Session::has('success'))
                                <div class="alert alert-success">
                                    <p>{{ Session::get('success') }}</p>
                                </div>
                            @endif
                            @if (Session::has('fail'))
                                <div class="alert alert-danger">
                                    <p>{{ Session::get('fail') }}</p>
                                </div>
                            @endif
                            <input type="hidden" name="user_id" value="{{ $userData->id }}">
                            <div class="row g-1">
                                <div class="col-md-12">
                                    <div class="mb-2">
                                        <div class="personal-image">
                                            <label class="label">
                                                <input type="file" name="profile_photo" id="profilePhotoInput"
                                                    onchange="previewImage(this)" />

                                                @if (!empty($userData->profile_photo))
                                                    <img src="{{ asset('profile_photo/') }}<?php echo '/' . $userData->profile_photo; ?>"
                                                        class="personal-avatar rounded-circle" width="100px" height="100px"
                                                        alt="avatar" id="profileImagePreview">
                                                @else
                                                    <img src="{{ asset('149071.png') }}" class="personal-avatar"
                                                        alt="avatar" id="profileImagePreview">
                                                @endif
                                            </label>
                                            <p>PNG, JPG, JPEG</p>
                                        </div>
                                        <span class="text-danger">
                                            @error('profile_photo')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label class="col-form-label">Nombre completo</label>
                                    <input class="form-control" type="text" name="name"
                                        value="{{ old('name', $userData->name) }}" placeholder="John">
                                    <span class="text-danger">
                                        @error('name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="col-sm-6">
                                    <label class="col-form-label">Store Name</label>
                                    <input class="form-control" type="text" name="store"
                                        value="{{ old('store', $userData->store) }}">
                                    <span class="text-danger">
                                        @error('store')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="col-sm-6">
                                    <label class="col-form-label">Department</label>
                                    <input class="form-control" type="text" name="department"
                                        value="{{ old('department', $userData->department) }}">
                                    <span class="text-danger">
                                        @error('department')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="col-sm-6">
                                    <label class="col-form-label">City</label>
                                    <input class="form-control" type="text" name="city"
                                        value="{{ old('city', $userData->city) }}">
                                    <span class="text-danger">
                                        @error('city')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="col-sm-6">
                                    <label class="col-form-label">Location</label>
                                    <input class="form-control" type="text" name="location"
                                        value="{{ old('location', $userData->location) }}">
                                    <span class="text-danger">
                                        @error('location')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="col-sm-6">
                                    <label class="col-form-label">Correo electrónico</label>
                                    <input class="form-control" type="email" name="email"
                                        value="{{ old('email', $userData->email) }}">
                                    <span class="text-danger">
                                        @error('email')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="col-sm-6">
                                    <label class="col-form-label">Contraseña</label>
                                    <input class="form-control" type="password" name="password"
                                        value="{{ old('password', $userData->password) }}">
                                    <span class="text-danger">
                                        @error('password')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="col-sm-6">
                                    <label class="col-form-label">Mobile Number</label>
                                    <input class="form-control" type="text" name="mobile_number"
                                        value="{{ old('mobile_number', $userData->mobile_number) }}">
                                    <span class="text-danger">
                                        @error('mobile_number')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="col-sm-6">
                                    <label class="col-form-label">Alter Mobile Number</label>
                                    <input class="form-control" type="text" name="alter_mobile_number"
                                        value="{{ old('alter_mobile_number', $userData->alter_mobile_number) }}">
                                    <span class="text-danger">
                                        @error('alter_mobile_number')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>


                                <div class="col-sm-6">
                                    <label class="col-form-label">Assign Category</label>
                                    <select name="categories[]" multiple class="select2 form-control">
                                        @php
                                        $categories = \App\Models\Category::all();
                                        $userDataCategories = isset($userData) && !empty($userData->categories) ? explode(',', $userData->categories) : [];
                                        @endphp
                                        @foreach($categories as $row)
                                        <option value="{{ $row->id }}" @if (in_array($row->id, $userDataCategories)) selected @endif>{{ $row->name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="col-sm-6">
                                    <label class="col-form-label">Assign Price</label>
                                    <br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="priceBicycle" name="price"
                                            value="price1" @if (old('price', $userData->price) == 'price1') checked @endif required>
                                        <label class="form-check-label" for="priceBicycle">Price 1</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="priceMotorcycle"
                                            name="price" value="price2" @if (old('price', $userData->price) == 'price2') checked @endif
                                            required>
                                        <label class="form-check-label" for="priceMotorcycle">Price 2</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="priceShimano" name="price"
                                            value="price3" @if (old('price', $userData->price) == 'price3') checked @endif required>
                                        <label class="form-check-label" for="priceShimano">Price 3</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="priceLoadline" name="price"
                                            value="price4" @if (old('price', $userData->price) == 'price4') checked @endif required>
                                        <label class="form-check-label" for="priceLoadline">Price 4</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="priceLoadline" name="price"
                                            value="price5" @if (old('price', $userData->price) == 'price5') checked @endif required>
                                        <label class="form-check-label" for="priceLoadline">Price 5</label>
                                    </div>
                                    <span class="text-danger">
                                        @error('price')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="col-sm-6">
                                    <label class="col-form-label">Estado</label>
                                    <br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="statusYes" name="status"
                                            value="1" @if (old('status', $userData->status) == '1') checked @endif required>
                                        <label class="form-check-label" for="statusYes">Sí</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="statusNo" name="status"
                                            value="0" @if (old('status', $userData->status) == '0') checked @endif required>
                                        <label class="form-check-label" for="statusNo">No</label>
                                    </div>
                                    <span class="text-danger">
                                        @error('status')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="row g-2">
                                    <div class="col-sm-4">
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <script>
                            function previewImage(input) {
                                var preview = document.getElementById('profileImagePreview');
                                var file = input.files[0];
                                var reader = new FileReader();
                                reader.onloadend = function() {
                                    preview.src = reader.result;
                                }
                                if (file) {
                                    reader.readAsDataURL(file);
                                } else {
                                    preview.src = "149071.png"; // Default image when no file selected
                                }
                            }
                        </script>

                    </div>
                </div>
            </div>
        </div>

        <!-- sign up page ends-->
    </div>
    </div>
    <!-- page-wrapper Ends-->
    <div class="modal fade" id="sendMailModal" tabindex="-1" aria-labelledby="sendMailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sendMailModalLabel">Send Mail to {{ $userData->email }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('admin/sendMail', $userData->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Subject</label>
                                    <input type="subject" name="subject" class="form-control form-control-lg" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Reply to </label>
                                    <input type="email" name="reply_to" class="form-control form-control-lg"
                                        value="{{ $user_session->email }}" required>
                                </div>
                            </div>
                        </div>
                        <textarea name="message" rows="10" class="ckeditor"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-lg">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
