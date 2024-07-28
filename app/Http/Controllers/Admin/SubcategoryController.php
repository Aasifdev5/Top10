<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SubcategoryRequest;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\User;
use App\Tools\Repositories\Crud;
use App\Traits\General;
use App\Traits\ImageSaveTrait;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SubcategoryController extends Controller
{
    use  General, ImageSaveTrait;

    protected $model;
    protected $categoryModel;

    public function __construct(Subcategory $subcategory, Category $category)
    {
        $this->model = new Crud($subcategory);
        $this->categoryModel = new Crud($category);
    }

    public function index()
    {

        if (Session::has('LoggedIn')) {

            $data['user_session'] = User::where('id', Session::get('LoggedIn'))->first();
            $data['title'] = 'Manage Subcategory';
            $data['subcategories'] = $this->model->getOrderById('DESC', 25);
            return view('admin.subcategory.index', $data);
        }
    }

    public function create()
    {

        if (Session::has('LoggedIn')) {

            $data['user_session'] = User::where('id', Session::get('LoggedIn'))->first();
            $data['title'] = 'Add Subcategory';
            $data['categories'] = $this->categoryModel->all();
            $data['subcategories'] = Subcategory::where('category_id', '0')->get();
            return view('admin.subcategory.create', $data);
        }
    }

    public function store(Request $request)
    {

        $subcategory = new Subcategory();

        $subcategory->category_id = $request->category_id;
        $subcategory->name = $request->name;
        $subcategory->slug = getSlug($request->slug);
        // Handle image upload
        if ($request->hasFile('image')) {
            $attribute = $request->file('image');
            $destination = 'SubCategory';

            // Generate unique filename
            $file_name = time() . '-' . Str::random(10) . '.' . $attribute->getClientOriginalExtension();
            // Move uploaded file to the destination directory
            $attribute->move(public_path('uploads/' . $destination), $file_name);
            // Update image path
            $subcategory->image = 'uploads/' . $destination . '/' . $file_name;
        }

        $subcategory->save();

        return back()->with('success', 'Succssfully');
    }

    public function edit($id)
    {
        if (Session::has('LoggedIn')) {
            $data['user_session'] = User::find(Session::get('LoggedIn'));
            $data['title'] = 'Edit Subcategory';
            $data['subcategory'] = Subcategory::findOrFail($id);
            $data['categories'] = Category::all(); // Use the correct model for categories
            return response()->json($data); // Ensure the response is in JSON format for AJAX
        }
        return response()->json(['error' => 'Unauthorized'], 403); // Handle unauthorized access
    }


    public function update(Request $request, $id)
    {

        $subcategory = SubCategory::findOrFail($id);

        // Validate and update the subcategory
        $request->validate([
            'name' => 'required|string',
            'slug' => 'required|string',
            'category_id' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png',
        ]);

        $subcategory->name = $request->name;
        $subcategory->slug = $request->slug;
        $subcategory->category_id = $request->category_id;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('subcategories', 'public');
            $subcategory->image_url = $imagePath;
        }

        $subcategory->save();

        return response()->json(['success' => true]);
    }

    public function delete($id)
    {
        $subcategory = Subcategory::find($id);
        if ($subcategory) {
            $subcategory->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false, 'message' => 'Subcategory not found.']);
    }
}
