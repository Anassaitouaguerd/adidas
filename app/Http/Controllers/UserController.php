<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $user;
    public function __construct()
    {
        $this->user = new User();
    }
    public function index_user()
    {
        $allUser = User::all();
        $allRole = Role::all();
        return view('Back-office.Users', compact('allUser', 'allRole'));
    }
    public function new_user(Request $request)
    {
        $attributes = $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email|min:4',
                'password' => 'required|min:7',
                'role' => 'required',
            ]
        );
        $this->user->name = $attributes['name'];
        $this->user->email = $attributes['email'];
        $this->user->password = $attributes['password'];
        $this->user->role_id = $attributes['role'];
        $this->user->save();
        return back()->with('successUser', 'Add new user successful');
    }
    public function update_user(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|min:4',
            'password' => 'required|min:7',
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->role_id = $request->role;
        $user->update();
        return back()->with('successUser', 'Update user successful');
    }
    public function delete_user(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        $user->delete();
        return back()->with('successUser', 'Delete user successful');
    }
}
