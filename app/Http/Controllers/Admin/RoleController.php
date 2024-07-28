<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleRequest;
use App\Models\Permissions;
use App\Models\User;
use App\Traits\General;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    use General;

    public function index()
    {

        if (Session::has('LoggedIn')) {

            $data['user_session'] = User::where('id', Session::get('LoggedIn'))->first();
            $data['title'] = 'Manage Roles';
            $data['roles'] = Role::paginate(25);

            return view('admin.role.index', $data);
        }
    }

    public function create()
    {
        if (Session::has('LoggedIn')) {

            $data['user_session'] = User::where('id', Session::get('LoggedIn'))->first();

            $data['title'] = 'Add Role';
            $data['roles'] = Role::all();
            $permissions = Permissions::whereNull('parent_id')->with('children')->get();

            return view('admin.role.create', $data, compact('permissions'));
        }
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|unique:roles,name', // Ensure role name is unique
            'permissions' => 'array', // Ensure permissions are provided as an array
        ]);

        try {
            // Create the role
            $role = Role::create([
                'name' => $request->name,

                'permissions' => $request->permissions, // Store permissions as an array
            ]);

            // Attach the selected permissions to the role
            if ($request->has('permissions')) {
                $role->syncPermissions($request->permissions);
            }


            // Redirect with success message
            return redirect('admin/role')->with('success', 'Role created successfully');
        } catch (\Exception $e) {
            // Handle any exceptions, such as duplicate role names
            return redirect()->back()->with('error', 'Failed to create role: ' . $e->getMessage());
        }
    }


    public function edit($id)
    {
        if (Session::has('LoggedIn')) {
            $data['user_session'] = User::find(Session::get('LoggedIn'));
            $data['title'] = 'Edit Role';
            $data['role'] = Role::find($id);
            $data['permissions'] = Permission::all();
            $data['selected_permissions'] = DB::table('role_has_permissions')->where('role_id', $id)->pluck('permission_id')->toArray();

            return view('admin.role.edit', $data);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $id,
            'permissions' => ['required', 'array', 'min:1'],
        ]);

        $role = Role::find($id);
        $role->name = $request->name;
        $role->save();

        DB::table('role_has_permissions')->where('role_id', $id)->delete();
        $role->givePermissionTo($request->permissions);
        Artisan::call('cache:clear');



        return redirect('admin/role')->with('success', 'Data has been updated successfully');
    }

    public function delete($id)
    {

        $role = Role::find($id);
        DB::table('role_has_permissions')->where('role_id', $id)->delete();
        $role->delete();

        $this->showToastrMessage('error', __('Role has been deleted'));
        return redirect()->back();
    }
}
