<?php

namespace App\Http\Controllers;

use App\Models\Permissions;
use App\Models\Role;
use App\Models\Role_permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    protected $role;
    protected $permission;
    public function __construct()
    {
        $this->role = new Role();
        $this->permission = new Role_permission();
    }
    public function index_role()
    {
        $allRoles = Role::all();
        $allPermissions = Permissions::all();
        return view('Back-office.Role', compact('allRoles', 'allPermissions'));
    }
    public function update_page($id)
    {
        $role = Role::where('id', $id)->first();
        $role_id = $role->id;
        $role_permission = Role_permission::where('role_id', $role_id)->get();
        $allRoles = Role::all();
        $allPermissions = Permissions::all();
        return view('Back-office.Update_role', compact('allRoles', 'allPermissions', 'role_permission', 'role'));
    }
    public function new_role(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
            ],
        );
        
        $this->role->role = $request->name;
        $this->role->save();
        $lastInsertedId = $this->role->id;
        foreach ($request->permission as $permission) {
            Role_permission::create(
                [
                    'role_id' => $lastInsertedId,
                    'permission_id' => $permission,
                ]
            );
        }
        return back()->with('successRole', 'Add Role successful');
    }
    public function update_role(Request $request)
    {
        $request->validate([
            'name' => ['required',Rule::unique('roles', 'role')],
            'permission' => 'required',

        ]);
        $role = Role::where('id' , $request->id)->first();
        $role->role = $request->name;
        $this->role->update();
        $roleId = $request->id;
        Role_permission::where('role_id', $roleId)->delete();
        foreach ($request->permission as $permission) {
            Role_permission::create(
                [
                    'role_id' => $roleId,
                    'permission_id' => $permission,
                ]
            );
        }
        return redirect('/SuperAdmin/Role')->with('successRole', 'Add Role successful');
    }
    public function delete_role(Request $request)
    {
        $role = Role::where('id', $request->id)->first();
        $role->delete();
        return back()->with('successRole', 'delete Role successful');
    }
}
