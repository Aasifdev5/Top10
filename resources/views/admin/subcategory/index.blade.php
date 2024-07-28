@extends('admin.Master')
@section('title')
    {{ $title }}
@endsection
@section('content')
    <div class="page-wrapper page-settings">
        <div class="content">
            <div class="content-page-header content-page-headersplit mb-0">
                <h5>Sub Categories</h5>
                <div class="list-btn">
                    <ul>
                        <li>
                            <div class="filter-sorting">
                                <ul>
                                    <li>
                                        <a href="javascript:void(0);" class="filter-sets"><i
                                                class="fe fe-filter me-2"></i>Filter</a>
                                    </li>
                                    <li>
                                        <span><img src="assets/img/icons/sort.svg" class="me-2" alt="img"></span>
                                        <div class="review-sort">
                                            <select class="select">
                                                <option>A -> Z</option>
                                                <option>Z -> A</option>
                                            </select>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            {{-- <a class="btn btn-primary" href="{{ route('category.create') }}"><i
                                class="fa fa-plus me-2"></i>Add Category
                        </a> --}}
                            <a class="btn btn-primary" type="button" data-bs-toggle="modal"
                                data-bs-target="#add-subcategory"><i class="fa fa-plus me-2"></i>Add SubCategory</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="table-resposnive table-div">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Sub Category</th>
                                    <th>Sub Category Slug</th>
                                    <th>Category</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subcategories as $subcategory)
                                    <tr class="removable-item">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $subcategory->name }}</td>
                                        <td>{{ $subcategory->slug }}</td>
                                        <td>
                                            @php
                                                $category = \App\Models\Category::where(
                                                    'id',
                                                    $subcategory->category_id,
                                                )->first();
                                                if (!empty($subcategory->id) && $category) {
                                                    $CategoryName = $category->name;
                                                } else {
                                                    $CategoryName = 'No Category';
                                                }
                                            @endphp
                                            {{ $CategoryName }}
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($subcategory->created_at)->format('F Y') }}</td>

                                        <td>
                                            <div class="action__buttons">
                                                <a href="javascript:void(0);" title="Edit"
                                                    class="btn btn-icon waves-effect waves-light btn-success m-b-5 m-r-5"
                                                    data-bs-toggle="modal" data-bs-target="#edit-subcategory"
                                                    data-id="{{ $subcategory->id }}">
                                                    <i class="fa fa-edit"></i>
                                                </a>

                                                <a href="javascript:void(0);" title="Delete"
                                                    class="btn btn-icon waves-effect waves-light btn-danger m-b-5 delete-subcategory"
                                                    data-toggle="tooltip" title="{{ trans('remove') }}"
                                                    data-url="{{ route('subcategory.delete', $subcategory->id) }}">
                                                    <i class="fa fa-remove"></i>
                                                </a>

                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="modal fade" id="add-subcategory">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add SubCategory</h5>
                    <button type="button" class="btn-close close-modal" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fe fe-x"></i>
                    </button>
                </div>
                <div class="modal-body pt-0">
                    <form action="{{ route('subcategory.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Parent Category</label>
                            <select class="select" name="category_id">
                                <option value="">Select Category</option>
                                @php
                                    $categories = App\Models\Category::all();
                                @endphp
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">SubCategory Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label me-1">SubCategory Slug</label>
                            <small class="form-text text-muted">(e.g., test-slug)</small>
                            <input type="text" class="form-control" name="slug" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">SubCategory Image</label>
                            <div class="form-uploads">
                                <div class="form-uploads-path">
                                    <img src="assets/img/icons/upload.svg" alt="Preview Image" id="acategory-image-preview"
                                        style="max-width: 100%; height: auto;">
                                    <div class="file-browse">
                                        <h6>Drag & drop image or</h6>
                                        <div class="file-browse-path">
                                            <input type="file" name="image" id="acategory-image">
                                            <a href="javascript:void(0);"> Browse</a>
                                        </div>
                                    </div>
                                    <h5>Supported formats: JPEG, PNG</h5>
                                </div>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>



                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="edit-subcategory" tabindex="-1" aria-labelledby="editSubcategoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSubcategoryModalLabel">Edit SubCategory</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="edit-subcategory-form" action="" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="edit-category_id" class="form-label">Parent Category</label>
                            <select class="form-select" id="edit-category_id" name="category_id" required>
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="edit-name" class="form-label">SubCategory Name</label>
                            <input type="text" class="form-control" id="edit-name" name="name" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit-slug" class="form-label">SubCategory Slug</label>
                            <input type="text" class="form-control" id="edit-slug" name="slug" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit-image" class="form-label">SubCategory Image</label>
                            <div class="form-uploads">
                                <img src="assets/img/icons/upload.svg" alt="Preview Image" id="edit-image-preview"
                                    style="max-width: 100%; height: auto;">
                                <div class="file-browse">
                                    <div class="file-browse-path">
                                        <input type="file" name="image" id="edit-image">
                                        <a href="javascript:void(0);">Browse</a>
                                    </div>
                                </div>
                                <h5>Supported formats: JPEG, PNG</h5>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <script src="{{ asset('assets/js/jquery-3.7.0.min.js') }}" type="text/javascript"></script>

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // Show modal with subcategory data
            $('#edit-subcategory').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var subcategoryId = button.data('id'); // Extract subcategory ID from data-* attribute

                var editSubcategoryUrl = "{{ route('subcategory.edit', ['id' => ':id']) }}".replace(':id', subcategoryId);

                console.log("Edit URL: " + editSubcategoryUrl); // Log the URL

                // Fetch existing subcategory data
                $.ajax({
                    url: editSubcategoryUrl,
                    method: 'GET',
                    success: function(data) {
                        console.log("Response Data: ", data); // Log the response data

                        if (data && data.subcategory) {
                            // Fill the modal form with existing data
                            $('#edit-category_id').val(data.subcategory.category_id);
                            $('#edit-name').val(data.subcategory.name);
                            $('#edit-slug').val(data.subcategory.slug);
                            $('#edit-image-preview').attr('src', data.subcategory.image_url || 'assets/img/icons/upload.svg'); // Default image

                            // Set form action URL
                            $('#edit-subcategory-form').attr('action', `/admin/subcategory/update/${subcategoryId}`);
                        } else {
                            console.error('No data received for subcategory');
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('AJAX error:', textStatus, errorThrown);
                    }
                });
            });

            // Handle form submission for editing subcategory
            $('#edit-subcategory-form').on('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission

                var form = $(this);
                var actionUrl = form.attr('action');
                var formData = new FormData(this);

                $.ajax({
                    url: actionUrl,
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            toastr.success('Subcategory updated successfully!');
                            location.reload(); // Reload the page
                        } else {
                            toastr.error('Failed to update subcategory.');
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('AJAX error:', textStatus, errorThrown);
                        toastr.error('An error occurred while updating the subcategory.');
                    }
                });
            });

            // Image preview for Edit SubCategory
            document.getElementById('edit-image').addEventListener('change', function(event) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('edit-image-preview').src = e.target.result;
                };
                reader.readAsDataURL(event.target.files[0]);
            });

            // Handle delete functionality
            $(document).on('click', '.delete-subcategory', function(e) {
                e.preventDefault(); // Prevent default action

                let deleteUrl = $(this).data('url'); // Get the deletion URL

                if (confirm('{{ trans('do you want to delete') }}')) { // Confirmation prompt
                    $.ajax({
                        type: "DELETE",
                        url: deleteUrl,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF protection
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.success) {
                                toastr.success("Subcategory successfully deleted.");
                                location.reload(); // Reload the page
                            } else {
                                toastr.error("Failed to delete subcategory.");
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText); // Log errors
                            toastr.error("Failed to delete subcategory. Please try again later.");
                        }
                    });
                }
            });
        });
    </script>

@endsection
