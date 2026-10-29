<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class NeedController extends Controller
{
    public function index()
    {
        $needs = [
            ['id' => 301, 'family' => 'أسرة أحمد', 'type' => 'مواد غذائية', 'priority' => 'عاجلة', 'status' => 'جديد'],
            ['id' => 302, 'family' => 'أسرة محمد', 'type' => 'بطانيات', 'priority' => 'متوسطة', 'status' => 'قيد المعالجة'],
            ['id' => 303, 'family' => 'أسرة علي', 'type' => 'مواد نظافة', 'priority' => 'عادية', 'status' => 'مكتمل'],
            [
                'id' => 304,
                'family' => 'أسرة خالد',
                'type' => 'مياه شرب',
                'priority' => 'عاجلة',
                'status' => 'جديد',
            ],
        ];

        $families = ['أسرة أحمد', 'أسرة محمد', 'أسرة علي', 'أسرة خالد'];

        return view('admin.needs.needs', compact('needs', 'families'));
    }

    public function store()
    {
        return redirect('/needs');
    }
}
