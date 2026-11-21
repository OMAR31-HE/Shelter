<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login()
    {
        
        return redirect('/dashboard');
    }

    public function logout()
    {
        return redirect('/login');
    }
}