<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Tools\Repositories\Crud;
use App\Traits\General;
use App\Traits\ImageSaveTrait;
use App\Models\Tax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class TaxController extends Controller
{
    use  ImageSaveTrait, General;

    protected $model;
    public function __construct(Tax $tax)
    {
        $this->model = new Crud($tax);
    }
    public function index()
    {
        if (Session::has('LoggedIn')) {


            $data['user_session'] = User::where('id', Session::get('LoggedIn'))->first();

            $data['title'] = 'Manage Tax';
            $data['categories'] = $this->model->getOrderById('DESC', 25);
            return view('admin.tax.index', $data);
        }
    }

    public function create()
    {

        if (Session::has('LoggedIn')) {


            $data['user_session'] = User::where('id', Session::get('LoggedIn'))->first();
            $data['title'] = 'Add Tax';
            return view('admin.tax.create', $data);
        }
    }

    public function store(Request $request)
{

    // Validate request data
    $this->validate($request, [
        'title' => 'required|string|max:255',
        'percentage' => 'required|numeric|min:0|max:100', // Adjust validation rules as needed
    ]);

    $tax = new Tax();
    $tax->title = $request->get('title'); // Use get() for better security
    $tax->percentage = $request->get('percentage'); // Use get() for better security
    $tax->save();

    return response()->json(['success' => true]);
}

    public function edit($id)
    {

        if (Session::has('LoggedIn')) {
            $data['user_session'] = User::where('id', Session::get('LoggedIn'))->first();
            $data['title'] = 'Edit Tax';
            $data['category'] = $this->model->getRecordByid($id);
            return view('admin.tax.edit', $data);
        }
    }

    public function update(Request $request, $id)
    {
        // Validate request data
        $this->validate($request, [
            'title' => 'required|string|max:255', // Replace with appropriate validation rules
        ]);

        $category = $this->model->getRecordByid($id);

        if (!$category) {
            return response()->json(['success' => false, 'message' => 'Tax not found.'], 404);
        }

        // Update category data with sanitized input
        $category->title = $request->title; // Use get() for better security
        $category->percentage = $request->percentage; // Use get() for better security
        $category->save();

        return response()->json(['success' => true, 'message' => 'Tax updated successfully.']);
    }

    public function delete($id)
    {
        $category = Tax::where('id', $id)->first();

        if (!$category) {
            return response()->json(['success' => false, 'message' => 'Tax not found.'], 404);
        }

        $category->delete();

        return response()->json(['success' => true]);
    }
}
