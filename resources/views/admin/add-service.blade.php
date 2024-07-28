@extends('master')
@section('title')
    Create Service
@endsection
@section('content')
    <div class="breadcrumb-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-12">
                    <h2 class="breadcrumb-title">Create Service</h2>
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index-2.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create Service</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="page-wrapper">
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 mx-auto">

                        <div class="service-wizard">
                            <ul id="progressbar">
                                <li class="active">
                                    <div class="multi-step-icon span-info">
                                        <span><i class="fa-regular fa-circle-check"></i></span>
                                    </div>
                                    <div class="multi-step-info">
                                        <h6>Information</h6>
                                    </div>
                                </li>
                                <li>
                                    <div class="multi-step-icon">
                                        <span><i class="fa-regular fa-clock"></i></span>
                                    </div>
                                    <div class="multi-step-info">
                                        <h6>Availability</h6>
                                    </div>
                                </li>
                                <li>
                                    <div class="multi-step-icon">
                                        <span><i class="fa-regular fa-map"></i></span>
                                    </div>
                                    <div class="multi-step-info">
                                        <h6>Location</h6>
                                    </div>
                                </li>
                                <li>
                                    <div class="multi-step-icon">
                                        <span><i class="feather-image"></i></span>
                                    </div>
                                    <div class="multi-step-info">
                                        <h6>Gallery</h6>
                                    </div>
                                </li>
                                <li>
                                    <div class="multi-step-icon">
                                        <span><i class="fa-solid fa-chart-bar"></i></span>
                                    </div>
                                    <div class="multi-step-info">
                                        <h6>Seo</h6>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="service-inform-fieldset">
                            <form id="serviceForm" enctype="multipart/form-data">
                                @csrf
                                <fieldset id="first-field">
                                    <div class="card add-service">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="sub-title">
                                                    <h6>Service Information</h6>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-form-label" for="serviceTitle">Service Title</label>
                                                    <input type="text" class="form-control" id="serviceTitle"
                                                        name="service_title" placeholder="Enter Service Name">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-form-label" for="category">Category</label>
                                                    <select class="form-select" id="category" name="category_id">
                                                        <option>Select Category</option>
                                                        <option>Car wash</option>
                                                        <option>House Cleaning</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-form-label" for="subCategory">Sub Category</label>
                                                    <select class="form-select" id="subCategory" name="subcategory_id">
                                                        <option>Select Sub Category</option>
                                                        <option>House Cleaning</option>
                                                        <option>Car wash</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-form-label" for="price">Price <span
                                                            class="brief-bio float-end">Set 0 for free</span></label>
                                                    <input type="text" class="form-control" id="price"
                                                        name="price">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-form-label" for="duration">Duration</label>
                                                    <input type="text" class="form-control" id="duration"
                                                        name="duration">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group mb-0">
                                                    <label class="col-form-label" for="description">Description</label>
                                                    <textarea class="form-control ck-editor" id="description" name="description"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card add-service">
                                        <div class="add-service-toggle">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="sub-title">
                                                        <h6>Additional Service</h6>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="status-toggle sml-status float-sm-end">
                                                        <input type="checkbox" id="status_1" class="check"
                                                            name="additional_service_status" checked>
                                                        <label for="status_1" class="checktoggle">Checkbox</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="addservice-info">
                                            <div class="row service-cont">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="col-form-label"
                                                            for="additionalServiceTitle">Additional Service</label>
                                                        <input type="text" class="form-control"
                                                            id="additionalServiceTitle" name="additional_service_title"
                                                            placeholder="Enter Service Item">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="col-form-label"
                                                            for="additionalServicePrice">Price</label>
                                                        <input type="text" class="form-control"
                                                            id="additionalServicePrice" name="additional_service_price"
                                                            placeholder="Enter Price">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="col-form-label"
                                                            for="additionalServiceDuration">Duration</label>
                                                        <input type="text" class="form-control"
                                                            id="additionalServiceDuration"
                                                            name="additional_service_duration"
                                                            placeholder="Enter Service Duration">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="#" class="add-text add-extra"><i class="feather-plus-circle"></i>
                                            Add Additional Service</a>
                                    </div>
                                    <div class="card add-service">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="sub-title">
                                                    <h6>Video</h6>
                                                </div>
                                                <div class="form-group mb-0">
                                                    <label class="col-form-label" for="videoLink">Video Link</label>
                                                    <input type="text" class="form-control" id="videoLink"
                                                        name="video_link"
                                                        placeholder="https://www.youtube.com/shorts/Lf-Z7H8bZ8o">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="field-bottom-btns">
                                                <div class="field-btns">
                                                    <button class="btn btn-primary next_btn" type="button">Next <i
                                                            class="fa-solid fa-arrow-right"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset>
                                    <div class="card add-service">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="sub-title">
                                                    <h6>Availability</h6>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="timeslot-sec availablt-time-slots">
                                                    <label class="col-form-label">Configure Time Slots</label>
                                                    <div class="schedule-nav">
                                                        <ul class="nav">
                                                            <li class="nav-item">
                                                                <a class="nav-link active" data-bs-toggle="tab"
                                                                    href="#all_days">All Days</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" data-bs-toggle="tab"
                                                                    href="#slot_monday">Monday</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" data-bs-toggle="tab"
                                                                    href="#slot_tuesday">Tuesday</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" data-bs-toggle="tab"
                                                                    href="#slot_wednesday">Wednesday</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" data-bs-toggle="tab"
                                                                    href="#slot_thursday">Thursday</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" data-bs-toggle="tab"
                                                                    href="#slot_friday">Friday</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" data-bs-toggle="tab"
                                                                    href="#slot_saturday">Saturday</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" data-bs-toggle="tab"
                                                                    href="#slot_sunday">Sunday</a>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                    <div class="tab-content pt-0">
                                                        <div class="tab-pane active" id="all_days">
                                                            <div class="hours-info">
                                                                <h4 class="nameof-day">All Days</h4>
                                                                <div class="row hours-cont">
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label class="col-form-label"
                                                                                for="all_days_from">From</label>
                                                                            <div class="form-icon">
                                                                                <input type="text" id="all_days_from"
                                                                                    name="all_days_from"
                                                                                    class="form-control timepicker"
                                                                                    placeholder="Select Time">
                                                                                <span class="cus-icon"><i
                                                                                        class="feather-clock"></i></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label class="col-form-label"
                                                                                for="all_days_to">To</label>
                                                                            <div class="form-icon">
                                                                                <input type="text" id="all_days_to"
                                                                                    name="all_days_to"
                                                                                    class="form-control timepicker"
                                                                                    placeholder="Select Time">
                                                                                <span class="cus-icon"><i
                                                                                        class="feather-clock"></i></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label class="col-form-label"
                                                                                for="all_days_slots">Slots</label>
                                                                            <input type="text" id="all_days_slots"
                                                                                name="all_days_slots" class="form-control"
                                                                                placeholder="Enter Slot">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <a href="#" class="add-text add-hours"><i
                                                                    class="feather-plus-circle"></i> Add More</a>
                                                        </div>

                                                        <div class="tab-pane fade" id="slot_monday">
                                                            <div class="hours-info">
                                                                <h4 class="nameof-day">Monday</h4>
                                                                <div class="row hours-cont">
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label class="col-form-label"
                                                                                for="monday_from">From</label>
                                                                            <div class="form-icon">
                                                                                <input type="text" id="monday_from"
                                                                                    name="monday_from"
                                                                                    class="form-control timepicker"
                                                                                    placeholder="Select Time">
                                                                                <span class="cus-icon"><i
                                                                                        class="feather-clock"></i></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label class="col-form-label"
                                                                                for="monday_to">To</label>
                                                                            <div class="form-icon">
                                                                                <input type="text" id="monday_to"
                                                                                    name="monday_to"
                                                                                    class="form-control timepicker"
                                                                                    placeholder="Select Time">
                                                                                <span class="cus-icon"><i
                                                                                        class="feather-clock"></i></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label class="col-form-label"
                                                                                for="monday_slots">Slots</label>
                                                                            <input type="text" id="monday_slots"
                                                                                name="monday_slots" class="form-control"
                                                                                placeholder="Enter Slot">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <a href="#" class="add-text add-hours"><i
                                                                    class="feather-plus-circle"></i> Add More</a>
                                                        </div>

                                                        <!-- Repeat similar blocks for other days of the week -->

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="field-bottom-btns">
                                                <div class="field-btns">
                                                    <button class="btn btn-primary prev_btn" type="button"><i
                                                            class="fa-solid fa-arrow-left"></i> Prev</button>
                                                </div>
                                                <div class="field-btns">
                                                    <button class="btn btn-primary next_btn" type="button">Next <i
                                                            class="fa-solid fa-arrow-right"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset>
                                    <div class="card add-service">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="sub-title">
                                                    <h6>Location</h6>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="address" class="col-form-label">Address</label>
                                                    <input type="text" id="address" name="address"
                                                        class="form-control" placeholder="Enter Your Address">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="country" class="col-form-label">Country</label>
                                                    <input type="text" id="country" name="country"
                                                        class="form-control" placeholder="Enter Country">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="city" class="col-form-label">City</label>
                                                    <input type="text" id="city" name="city"
                                                        class="form-control" placeholder="Enter Your City">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="state" class="col-form-label">State</label>
                                                    <input type="text" id="state" name="state"
                                                        class="form-control" placeholder="Enter Your State">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="pincode" class="col-form-label">Pincode</label>
                                                    <input type="text" id="pincode" name="pincode"
                                                        class="form-control" placeholder="Enter Your Pincode">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="google_maps_place_id" class="col-form-label">Google Maps
                                                        Place ID</label>
                                                    <input type="text" id="google_maps_place_id"
                                                        name="google_maps_place_id" class="form-control"
                                                        placeholder="Enter Maps Place ID">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="latitude" class="col-form-label">Latitude</label>
                                                    <input type="text" id="latitude" name="latitude"
                                                        class="form-control" placeholder="Enter Latitude Number">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="longitude" class="col-form-label">Longitude</label>
                                                    <input type="text" id="longitude" name="longitude"
                                                        class="form-control" placeholder="Enter Longitude Number">
                                                </div>
                                            </div>
                                            <div class="form-group mb-0">
                                                <div class="map-grid">
                                                    <iframe
                                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6509170.989457427!2d-123.80081967108484!3d37.192957227641294!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808fb9fe5f285e3d%3A0x8b5109a227086f55!2sCalifornia%2C%20USA!5e0!3m2!1sen!2sin!4v1669181581381!5m2!1sen!2sin"
                                                        allowfullscreen aria-hidden="false" tabindex="0"
                                                        class="contact-map"></iframe>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="field-bottom-btns">
                                                <div class="field-btns">
                                                    <button class="btn btn-primary prev_btn" type="button">
                                                        <i class="fa-solid fa-arrow-left"></i> Prev
                                                    </button>
                                                </div>
                                                <div class="field-btns">
                                                    <button class="btn btn-primary next_btn" type="button">
                                                        Next <i class="fa-solid fa-arrow-right"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>


                                <fieldset>
                                    <div class="card add-service">
                                        <div class="sub-title">
                                            <h6>Gallery</h6>
                                        </div>
                                        <div class="file-upload">
                                            <img src="assets/img/icons/upload-icon.svg" alt="image">
                                            <h6>Drag & drop files or <span>Browse</span></h6>
                                            <p>Supported formats: JPEG, PNG</p>
                                            <input type="file" accept="image/*" name="gallery_files[]"
                                                id="gallery_files" multiple>
                                        </div>
                                        <div class="file-preview">
                                            <label>Select Default Image</label>
                                            <ul class="gallery-selected-img" id="gallery_preview">
                                                <!-- Images will be dynamically inserted here -->
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="field-bottom-btns">
                                        <div class="field-btns">
                                            <button class="btn btn-primary prev_btn" type="button"><i
                                                    class="fa-solid fa-arrow-left"></i>Prev</button>
                                        </div>
                                        <div class="field-btns">
                                            <button class="btn btn-primary next_btn" type="button">Next <i
                                                    class="fa-solid fa-arrow-right"></i></button>
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset>
                                    <div class="card add-service">
                                        <div class="sub-title">
                                            <h6>SEO</h6>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="col-form-label" for="meta_title">Meta Title</label>
                                                    <input type="text" class="form-control" id="meta_title"
                                                        name="meta_title">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="col-form-label" for="meta_keywords">Meta
                                                        Keywords</label>
                                                    <input type="text" class="form-control" id="meta_keywords"
                                                        name="meta_keywords">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group mb-0">
                                                    <label class="col-form-label" for="meta_description">Meta
                                                        Description</label>
                                                    <textarea class="form-control" id="meta_description" name="meta_description" rows="5"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="field-bottom-btns">
                                        <div class="field-btns">
                                            <button class="btn btn-primary prev_btn" type="button"><i
                                                    class="fa-solid fa-arrow-left"></i>Prev</button>
                                        </div>
                                        <div class="field-btns">
                                            <button type="submit"  class="btn btn-primary done_btn"
                                                >Final<i
                                                    class="fa-solid fa-arrow-right"></i></button>
                                        </div>
                                    </div>
                                </fieldset>

                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('gallery_files').addEventListener('change', function(event) {
            const files = event.target.files;
            const previewContainer = document.getElementById('gallery_preview');

            // Clear previous previews
            previewContainer.innerHTML = '';

            for (const file of files) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const listItem = document.createElement('li');

                    listItem.innerHTML = `
                        <div class="img-preview">
                            <img src="${e.target.result}" alt="Uploaded Image">
                            <a href="javascript:void(0);" class="remove-gallery"><i class="feather-trash-2"></i></a>
                        </div>
                        <label class="custom_check">
                            <input type="radio" name="default_gallery_image" value="${file.name}">
                            <span class="checkmark"></span>
                        </label>
                    `;

                    previewContainer.appendChild(listItem);
                };

                reader.readAsDataURL(file);
            }
        });

        document.getElementById('gallery_preview').addEventListener('click', function(event) {
            if (event.target.closest('.remove-gallery')) {
                const listItem = event.target.closest('li');
                listItem.remove();
            }
        });
    </script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
    // Add CSRF token to AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#serviceForm').on('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission

        // Create FormData object
        var formData = new FormData(this);

        $.ajax({
            url: '{{ route("StoreService") }}', // Use the route name for URL
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                // Redirect to provider-services page using the named route
                window.location.href = '{{ route("service") }}'; // Use the named route for URL
            },
            error: function(xhr) {
                // Handle error response
                var errors = xhr.responseJSON.errors;
                var errorMessages = [];
                $.each(errors, function(key, value) {
                    errorMessages.push(value[0]);
                });
                alert('Error: ' + errorMessages.join(', '));
            }
        });
    });
});
    </script>

@endsection
