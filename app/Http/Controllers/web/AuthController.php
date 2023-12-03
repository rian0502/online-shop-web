<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    //

    public function login()
    {
        return view('auth.login');
    }
    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Email is required',
            'email.email' => 'Email is not valid',
            'password.required' => 'Password is required'
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }
        return back()->with('error', 'Email or Password is wrong.');
    }
}
