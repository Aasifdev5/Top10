@extends('admin.Master')
@section('title')
    {{ $title }}
@endsection
@section('content')
    <div class="page-wrapper page-settings">
        <div class="content">
            <div class="content-page-header content-page-headersplit mb-0">
                <h5>Categories</h5>
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
                                data-bs-target="#add-category"><i class="fa fa-plus me-2"></i>Add Category</a>
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
                                    <th>Category</th>
                                    <th>Category Slug</th>
                                    <th>Date</th>
                                    <th>Featured</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($categories as $category)
                                    <tr class="odd">
                                        <td class="sorting_1">{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="table-imgname">
                                                <img src="assets/img/services/service-03.jpg" class="me-2" alt="img">
                                                <span>{{ $category->name }}</span>
                                            </div>
                                        </td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($category->created_at)->format('F Y') }}</td>
                                        <td>
                                            <div class="active-switch">
                                                <label class="switch">
                                                    <input type="checkbox" checked="">
                                                    <span class="sliders round"></span>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="action__buttons">
                                                <a href="javascript:void(0);" title="Edit"
                                                    class="btn btn-icon waves-effect waves-light btn-success m-b-5 m-r-5"
                                                    data-bs-toggle="modal" data-bs-target="#edit-category"
                                                    data-id="{{ $category->id }}">
                                                    <i class="fa fa-edit"></i>
                                                </a>

                                                <a href="javascript:void(0);" title="Delete"
                                                    class="btn btn-icon waves-effect waves-light btn-danger m-b-5 delete-category"
                                                    data-toggle="tooltip" title="{{ trans('remove') }}"
                                                    data-url="{{ route('category.delete', $category->id) }}">
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

    <div class="modal fade" id="add-category">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Category</h5>
                    <button type="button" class="btn-close close-modal" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fe fe-x"></i>
                    </button>
                </div>
                <div class="modal-body pt-0">
                    <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Category Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label me-1">Category Slug</label>
                            <small class="form-text text-muted">(e.g., test-slug)</small>
                            <input type="text" class="form-control" name="slug" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Category Image</label>
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

    <!-- Edit Category Modal -->
<div class="modal fade" id="edit-category" tabindex="-1" role="dialog" aria-labelledby="editCategoryLabel"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
   <div class="modal-content">
       <div class="modal-header">
           <h5 class="modal-title" id="editCategoryLabel">Edit Category</h5>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
               <i class="fe fe-x"></i>
           </button>
       </div>
       <div class="modal-body pt-0">
           <form id="edit-category-form" method="post" enctype="multipart/form-data">
               @csrf
               <div class="mb-3">
                   <label class="form-label">Category Name</label>
                   <input type="text" class="form-control" id="category-name" name="name">
               </div>
               <div class="mb-3">
                   <label class="form-label me-1">Category Slug</label>
                   <small class="form-text text-muted">(Ex: test-slug)</small>
                   <input type="text" class="form-control" id="category-slug" name="slug">
               </div>
               <div class="mb-3">
                   <label class="form-label">Category Image</label>
                   <div class="form-uploads">
                       <div class="form-uploads-path">
                           <img src="{{ asset('assets/img/icons/upload.svg') }}" alt="img"
                                id="category-image-preview">
                           <div class="file-browse">
                               <h6>Drag & drop image or</h6>
                               <div class="file-browse-path">
                                   <input type="file" id="category-image" name="image">
                                   <a href="javascript:void(0);"> Browse</a>
                               </div>
                           </div>
                           <h5>Supported formats: JPEG, PNG</h5>
                       </div>
                   </div>
               </div>
               <div class="text-end">
                   <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
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
    document.getElementById('category-image').addEventListener('change', function(event) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('category-image-preview').src = e.target.result;
        };
        reader.readAsDataURL(this.files[0]);
    });

    document.getElementById('edit-category-form').addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch("{{ route('category.store') }}", {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    toastr.success("Category created successfully.", "", {
                        onHidden: function() {
                            window.location.href = "{{ route('category.index') }}";
                        }
                    });
                } else {
                    toastr.error(data.message || "Unable to create category.");
                }
            })
            .catch(error => {
                console.error('Error:', error);
                toastr.error("Unable to create category. Please try again later.");
            });
    });

    document.getElementById('category-image').addEventListener('change', function() {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('category-image-preview').src = e.target.result;
        };
        reader.readAsDataURL(this.files[0]);
    });

    var editCategoryUrl = "{{ route('category.edit', ['id' => ':id']) }}";
    $('#edit-category').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var categoryId = button.data('id');

        // Replace :id in the URL with the actual categoryId
        var url = editCategoryUrl.replace(':id', categoryId);

        $.ajax({
            url: url,
            method: 'GET',
            success: function(data) {
                $('#category-name').val(data.name);
                $('#category-slug').val(data.slug);
                $('#category-image-preview').attr('src', data.image_url); // Assuming your response includes the image URL
                $('input[name="is_featured"][value="' + data.is_featured + '"]').prop('checked', true);

                $('#edit-category-form').attr('action', `/admin/category/update/${categoryId}`);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('AJAX error:', textStatus, errorThrown);
            }
        });
    });

    $('#edit-category-form').submit(function(event) {
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
                    toastr.success('Category updated successfully!');
                    // Optionally, you can reload the page or perform other actions
                    location.reload(); // Reload the page
                } else {
                    toastr.error('Failed to update category.');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('AJAX error:', textStatus, errorThrown);
                toastr.error('An error occurred while updating the category.');
            }
        });
    });

    $(document).on('click', '.delete-category', function(e) {
        e.preventDefault(); // Prevent default form submission

        let deleteUrl = $(this).data('url'); // Get the deletion URL

        if (confirm('{{ trans('do you want to delete') }}')) { // Confirmation prompt with translation
            $.ajax({
                type: "GET", // Specify DELETE method for deletion
                url: deleteUrl,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF protection
                },
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        toastr.success("Category successfully deleted.", "", {
                            onHidden: function() {
                                window.location.reload(); // Reload the page after success
                            }
                        });
                    } else {
                        toastr.error("Failed to delete category.");
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText); // Log errors to console for debugging
                    toastr.error("Failed to delete category. Please try again later.");
                }
            });
        }
    });
});
    </script>
@endsection
