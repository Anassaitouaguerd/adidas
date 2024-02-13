<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Hash;
use App\Mail\ForgotPassMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    protected $user;
    public function __construct()
    {
        $this->user = new User();
    }
    public function register(Request $request)
    {
        $attributes = $request->validate([
            'name' => 'required|min:3',
            'email' => ['email', 'required', 'min:4', Rule::unique('users', 'email')],
            'password' => ['required', 'max:20', 'min:7'],
        ]);
        $user = User::create($attributes);
        $request->session()->put('user_name', $user->name);
        $request->session()->put('user_role', $user->role_id);
        return redirect('/')->with('success', 'Login successful');
    }
    public function login(Request $request)
    {
        $attributes = $request->validate([
            'email' => ['email', 'required', 'min:4'],
            'password' => ['required', 'max:20', 'min:7'],
        ]);
        $user = User::where('email', $attributes['email'])->first();

        if ($user && Hash::check($attributes['password'], $user->password)) {
            $request->session()->put('user_id', $user->id);
            $request->session()->put('user_name', $user->name);
            $request->session()->put('user_role', $user->role_id);
            return redirect('/')->with('success', 'Login successful');
        } else {
            return back()->withErrors(['email' => 'the email or password could not be verified']);
        }
    }
    public function forgotPassword(Request $request)
    {
        $attributes = $request->validate([
            'email' => 'required|email|min:4',
        ]);
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $user->remember_token = Str::random(30);
            $user->save();
            Mail::to($user->email)->send(new ForgotPassMail($user));
            // ddd('hello');
            return back()->with('success', 'Checke your Email');
        } else {
            return back()->with('error', 'The account not found');
        }
    }
    public function reset($token)
    {
        $user = User::where('remember_token', $token)->first();
        if ($user) {
            return view('Front-office.Resete_password');
        }else{
            return abort(404);
        }
    }
    public function resetPassword($token , Request $request)
    {
        $request->validate([
            'password' => 'required',
            'cpassword' => 'required',
        ]);
        if($request->password == $request->cpassword)
        {
            $user = User::where('remember_token', $token)->first();
            $remember_token = Str::random(30);
            $user->remember_token = $remember_token;
            $user->password = $request->password;
            $user->save();
            return redirect('login')->with('passIsChanged' , 'Your Password Is Changed');
        }else {
            return back()->with('error' , 'the password is not valid');
        }


    }
    public function logout()
    {
        Session::flush();
        return redirect('/')->with('success', 'Goodbye!!');
    }
}
