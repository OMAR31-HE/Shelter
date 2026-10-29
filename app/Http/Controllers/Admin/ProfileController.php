<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function index()
    {
        $user = [
            'name' => 'مدير المركز',
            'role' => 'مدير النظام',
            'email' => 'admin@shelter.local',
        ];

        return view('admin.profile.profile', compact('user'));
    }
}
