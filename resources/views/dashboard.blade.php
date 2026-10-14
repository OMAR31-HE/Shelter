@extends('layout')

@section('title', 'لوحة التحكم')
@section('header', 'لوحة التحكم')

@section('content')

    <div class="page-heading">
        <h4>مرحبًا بك في الإيواء</h4>
        <p>نظرة عامة على بيانات المركز</p>
    </div>

    <div class="row g-3">

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon"
                     style="background:#e0f5f1;color:#159a91">
                    <i class="bi bi-people"></i>
                </div>
                <p>عدد الأسر</p>
                <h3>128</h3>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon"
                     style="background:#e7efff;color:#3974d8">
                    <i class="bi bi-person-vcard"></i>
                </div>
                <p>إجمالي الأفراد</p>
                <h3>542</h3>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon"
                     style="background:#fff0d8;color:#c78618">
                    <i class="bi bi-box-seam"></i>
                </div>
                <p>احتياجات معلقة</p>
                <h3>18</h3>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon"
                     style="background:#f0e8ff;color:#8756c5">
                    <i class="bi bi-box-arrow-in-left"></i>
                </div>
                <p>حالات الوصول اليوم</p>
                <h3>12</h3>
            </div>
        </div>

    </div>

    <div class="panel">
        <h5>نظرة عامة</h5>
        <p class="text-secondary mb-0">
            من هنا يمكنك متابعة الأسر والأفراد واحتياجات المركز.
        </p>
    </div>

@endsection
