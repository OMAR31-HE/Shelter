<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    public function index()
    {
        $users = [
            ['id' => 1, 'name' => 'منى سالم', 'role' => 'مدير النظام', 'badge' => 'bg-danger'],
            ['id' => 2, 'name' => 'خالد عمر', 'role' => 'موظف استقبال', 'badge' => 'bg-primary'],
            ['id' => 3, 'name' => 'سارة يوسف', 'role' => 'مسؤولة احتياجات', 'badge' => 'bg-success'],
        ];

        $roles = ['مدير النظام', 'موظف استقبال', 'مسؤولة احتياجات'];

        return view('admin.permissions.permissions', compact('users', 'roles'));
    }

    public function store()
    {
        return redirect('/permissions');
    }
}
