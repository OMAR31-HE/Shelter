<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            ['label' => 'عدد الأسر', 'value' => 128, 'icon' => 'bi-people', 'bg' => '#e0f5f1', 'color' => '#159a91'],
            ['label' => 'إجمالي الأفراد', 'value' => 542, 'icon' => 'bi-person-vcard', 'bg' => '#e7efff', 'color' => '#3974d8'],
            ['label' => 'احتياجات معلقة', 'value' => 18, 'icon' => 'bi-box-seam', 'bg' => '#fff0d8', 'color' => '#c78618'],
            ['label' => 'حالات الوصول اليوم', 'value' => 12, 'icon' => 'bi-box-arrow-in-left', 'bg' => '#f0e8ff', 'color' => '#8756c5'],
        ];

        return view('admin.dashbord.dashboard', compact('stats'));
    }
}
