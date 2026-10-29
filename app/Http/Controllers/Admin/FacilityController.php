<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class FacilityController extends Controller
{
    public function index()
    {
        $facilities = [
            ['id' => 1, 'name' => 'القاعة الرئيسية', 'type' => 'سكن جماعي', 'capacity' => 60, 'occupied' => 45, 'status' => 'نشط'],
            ['id' => 2, 'name' => 'المطبخ المشترك', 'type' => 'خدمات', 'capacity' => 0, 'occupied' => 0, 'status' => 'نشط'],
            ['id' => 3, 'name' => 'غرفة رقم 3', 'type' => 'سكن عائلي', 'capacity' => 6, 'occupied' => 6, 'status' => 'ممتلئ'],
            ['id' => 4, 'name' => 'المستوصف', 'type' => 'خدمات', 'capacity' => 0, 'occupied' => 0, 'status' => 'تحت الصيانة'],
        ];

        return view('admin.facilities.facilities', compact('facilities'));
    }

    public function store()
    {
        // TODO: connect to backend
        return redirect('/facilities');
    }
}
