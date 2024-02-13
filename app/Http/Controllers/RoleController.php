<?php

namespace App\Http\Controllers;

use App\Models\Permissions;
use App\Models\Role;
use App\Models\Role_permission;
use Illuminate\Http\Request;

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
    public function update_role()
    {
    }
    public function delete_role()
    {
    }
}
