<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class FamilyController extends Controller
{
    public function index()
    {
        $families = [
            ['id' => 101, 'name' => 'أسرة أحمد', 'members_count' => 5, 'status' => 'مقيمة'],
            ['id' => 102, 'name' => 'أسرة محمد', 'members_count' => 4, 'status' => 'مقيمة'],
            ['id' => 103, 'name' => 'أسرة علي', 'members_count' => 3, 'status' => 'غادرت'],
        ];

        return view('admin.families.families', compact('families'));
    }

    public function store()
    {
        // لا يوجد ربط بقاعدة بيانات بعد — الواجهة فقط، جاهزة للربط بـ API لاحقًا.
        return redirect('/families');
    }
}
