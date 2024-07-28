@extends('admin.Master')
@section('title')
    Account Setting
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
                <h5>Account Settings</h5>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="update_profile" method="post" enctype="multipart/form-data">
                                @csrf
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
                                <input type="hidden" name="user_id" value="{{ $user_session->id }}">

                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <div class="personal-image">
                                                <label class="label">

                                                    <figure class="personal-figure">
                                                        @if (!empty($user_session->profile_photo))
                                                            <img src="{{ asset('profile_photo/' . $user_session->profile_photo) }}"
                                                                class="personal-avatar" alt="avatar"
                                                                id="profileImagePreview">
                                                        @else
                                                            <img src="images/profile photo.png" class="personal-avatar"
                                                                alt="avatar" id="profileImagePreview">
                                                        @endif
                                                    </figure>
                                                    <input type="file" name="profile_photo" id="profilePhotoInput"
                                                        onchange="previewImage(this)" />
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

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="col-form-label">Full Name</label>
                                            <input class="form-control" type="text" name="name"
                                                value="{{ $user_session->name }}" placeholder="John">
                                            <span class="text-danger">
                                                @error('name')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="col-form-label">City</label>
                                            <input class="form-control" type="text" name="city"
                                                value="{{ $user_session->city }}" placeholder="India">
                                            <span class="text-danger">
                                                @error('city')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="col-form-label">Email</label>
                                            <input class="form-control" type="email" name="email"
                                                value="{{ $user_session->email }}" placeholder="john@example.com">
                                            <span class="text-danger">
                                                @error('email')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <button class="btn btn-primary" type="submit">Update</button>
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
                                        preview.src = "images/profile photo.png"; // Default image when no file selected
                                    }
                                }
                            </script>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
