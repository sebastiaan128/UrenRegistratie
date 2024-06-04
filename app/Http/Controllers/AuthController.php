<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        // Redirect to the home route if login is successful
        return redirect(route('home'))->with('success', 'Login successful');
    }

    // Redirect back to login with an error message if login fails
    return redirect(route('login'))->with('error', 'These credentials do not match our records.');
}

}

