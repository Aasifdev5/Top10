<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Models\User;
use App\Traits\General;
use Illuminate\Support\Str;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Tools\Repositories\Crud;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class BlogCategoryController extends Controller
{
    use General;

    protected $model;
    public function __construct(BlogCategory $category)
    {
        $this->model = new Crud($category);
    }

    public function index()
    {
        if (Session::has('LoggedIn')) {


            $data['user_session'] = User::where('id', Session::get('LoggedIn'))->first();

            $data['title'] = 'Manage Blog Category';
            $data['navBlogActiveClass'] = "mm-active";
            $data['subNavBlogCategoryIndexActiveClass'] = "mm-active";
            $data['blogCategories'] = $this->model->getOrderById('DESC', 25);
            return view('admin.blog.category-index', $data);
        }
    }

    public function store(Request $request)
    {


        $request->validate([
            'name' => 'required',
        ]);

        $slug = getSlug($request->name);

        if (BlogCategory::where('slug', $slug)->count() > 0) {
            $slug = getSlug($request->name) . '-' . rand(100000, 999999);
        }
        $data = [
            'name' => $request->name,
            'slug' => $slug,
            'status' => $request->status,
        ];

        $this->model->create($data); // create new blog


        return redirect()->back()->with('Created Successful');
    }

    public function update(Request $request, $uuid)
    {

        $request->validate([
            'name' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'status' => $request->status,
        ];

        $this->model->updateByUuid($data, $uuid); // update category

        return redirect()->back()->with('Updated Successful');
    }

    public function delete($uuid)
    {

        $this->model->deleteByUuid($uuid); // delete record

        return redirect()->back()->with('Blog has been deleted');
    }
}
