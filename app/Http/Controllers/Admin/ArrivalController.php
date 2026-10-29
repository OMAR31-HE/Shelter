<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ArrivalController extends Controller
{
    public function index()
    {
        $families = ['أسرة أحمد', 'أسرة محمد', 'أسرة علي', 'أسرة خالد'];

        $log = [
            ['id' => 1, 'family' => 'أسرة أحمد', 'type' => 'وصول', 'date' => '2026-10-20', 'note' => 'وصلت كاملة'],
            ['id' => 2, 'family' => 'أسرة علي', 'type' => 'مغادرة', 'date' => '2026-10-22', 'note' => 'انتقلت لمنزل أحد الأقارب'],
            ['id' => 3, 'family' => 'أسرة خالد', 'type' => 'وصول', 'date' => '2026-10-27', 'note' => '-'],
        ];

        return view('admin.arrivals.arrivals', compact('log', 'families'));
    }

    public function store()
    {
        return redirect('/arrivals');
    }
}
