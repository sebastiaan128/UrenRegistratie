<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view("auth.login");
    }

    public function loginPost(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        return redirect(route('index'))->with('success', 'Login successful');
    }

    return redirect(route('login'))->with('error', 'These credentials do not match our records.');

}
public function registerPost(Request $request){
    $user = User::create([
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);
    return redirect(route('index'))->with('success', 'Login successful');
}
}

