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
        // لا يوجد تحقق فعلي بعد — الواجهة فقط، جاهزة للربط بـ API تسجيل الدخول لاحقًا.
        return redirect('/dashboard');
    }

    public function logout()
    {
        return redirect('/login');
    }
}
