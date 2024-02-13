<?php

namespace App\Http\Controllers;

use App\Models\Permissions;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index_role()
    {
        $allRoles = Role::all();
        $allPermissions = Permissions::all();
        return view('Back-office.Role' , compact('allRoles' , 'allPermissions'));
    }
    public function new_role(Request $request)
    {
        $request->validate(
            [
                '' => '',
                
            ],
        );
    }
    public function update_role()
    {

    }
    public function delete_role()
    {

    }
}
