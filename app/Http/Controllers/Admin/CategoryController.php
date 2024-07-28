<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use App\Models\User;
use App\Tools\Repositories\Crud;
use App\Traits\General;
use App\Traits\ImageSaveTrait;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    use  ImageSaveTrait, General;

    protected $model;
    public function __construct(Category $category)
    {
        $this->model = new Crud($category);
    }
    public function index()
    {
        if (Session::has('LoggedIn')) {


            $data['user_session'] = User::where('id', Session::get('LoggedIn'))->first();

            $data['title'] = 'Manage Category';
            $data['categories'] = $this->model->getOrderById('DESC', 25);
            return view('admin.category.index', $data);
        }
    }

    public function create()
    {

        if (Session::has('LoggedIn')) {


            $data['user_session'] = User::where('id', Session::get('LoggedIn'))->first();
            $data['title'] = 'Add Category';
            return view('admin.category.create', $data);
        }
    }

    public function store(Request $request)
{

    // Validate the incoming request
    $request->validate([
        'name' => 'required|string|max:255',


    ]);

    // Initialize new category object
    $category = new Category();

    // Handle image upload
    if ($request->hasFile('image')) {
        $attribute = $request->file('image');
        $destination = 'Category';

        // Generate unique filename
        $file_name = time() . '-' . Str::random(10) . '.' . $attribute->getClientOriginalExtension();
        // Move uploaded file to the destination directory
        $attribute->move(public_path('uploads/' . $destination), $file_name);
        // Update image path
        $category->image = 'uploads/' . $destination . '/' . $file_name;
    }



    // Prepare data for the new category
    $category->name = $request->name;
    $category->slug = getSlug($request->slug);
    $category->save();

    try {

        return redirect()->route('category.index')->with('success', 'Category created successfully.');
    } catch (\Exception $e) {
        // Log error message for debugging
        Log::error('Error creating category: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Error creating category.');
    }
}




    public function edit($id)
    {
        if (Session::has('LoggedIn')) {
            $data['user_session'] = User::where('id', Session::get('LoggedIn'))->first();
            $data['title'] = 'Edit Category';
            $category = Category::find($id);

            if ($category) {
                return response()->json([
                    'name' => $category->name,
                    'slug' => $category->slug,
                    'image_url' => asset('path/to/images/' . $category->image), // Adjust the path as needed
                    'is_featured' => $category->is_featured,
                ]);
            } else {
                return response()->json(['error' => 'Category not found'], 404);
            }
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }


    public function update(Request $request, $uuid)
    {
        // Find the category by UUID
        $category = Category::where('id', $uuid)->firstOrFail();
        $image = $category->image;
        $icon = $category->icon;

        // Handle new image upload
        if ($request->hasFile('image')) {
            $this->deleteFile($category->image); // Remove old image
            $attribute = $request->file('image');
            $destination = 'Category';

            // Generate unique filename
            $file_name = time() . '-' . Str::random(10) . '.' . $attribute->getClientOriginalExtension();
            // Move uploaded file to the destination directory
            $attribute->move(public_path('uploads/' . $destination), $file_name);
            // Update image path
            $image = 'uploads/' . $destination . '/' . $file_name;
        }

        // Handle OG image upload
        if ($request->hasFile('icon')) {
            $this->deleteFile($category->icon); // Remove old icon
            $attribute = $request->file('icon');
            $destination = 'Category Icon';

            // Generate unique filename
            $file_name = time() . '-' . Str::random(10) . '.' . $attribute->getClientOriginalExtension();
            // Move uploaded file to the destination directory
            $attribute->move(public_path('uploads/' . $destination), $file_name);
            // Update icon path
            $icon = 'uploads/' . $destination . '/' . $file_name;
        }

        // Prepare data for update
        $data = [
            'name' => $request->name,
            'icon' => $icon,
            'slug' => getSlug($request->name),
            'image' => $image,

        ];

        // Update the category
        $category->update($data);

        return response()->json(['success' => true]);
    }

    public function delete($uuid)
    {
        $category = Category::where('id', $uuid)->first();

        if (!$category) {
            return response()->json(['success' => false, 'message' => 'Category not found.'], 404);
        }

        $category->delete();

        return response()->json(['success' => true]);
    }
}
