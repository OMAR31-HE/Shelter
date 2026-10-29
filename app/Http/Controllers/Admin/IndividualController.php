<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class IndividualController extends Controller
{
    public function index()
    {
        $families = ['أسرة أحمد', 'أسرة محمد', 'أسرة علي'];

        $individuals = [
            ['id' => 1, 'name' => 'مهند', 'family' => 'أسرة أحمد', 'age' => 13, 'gender' => 'ذكر', 'status' => 'مقيم'],
            ['id' => 2, 'name' => 'ماسة', 'family' => 'أسرة محمد', 'age' => 11, 'gender' => 'أنثى', 'status' => 'مقيم'],
            ['id' => 3, 'name' => 'وليد', 'family' => 'أسرة محمد', 'age' => 8, 'gender' => 'ذكر', 'status' => 'مقيم'],
        ];

        return view('admin.families.individuals', compact('individuals', 'families'));
    }

    public function store()
    {
        return redirect('/individuals');
    }

    public function update($id)
    {
        return redirect('/individuals');
    }
}
