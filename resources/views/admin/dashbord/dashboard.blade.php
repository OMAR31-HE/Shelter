@extends('layouts.layout')

@section('title', 'الرئيسية')
@section('header', 'الرئيسية')

@section('content')


<div class="dashboard-heading">
    <h4 class="fw-bold">مرحبًا بك في الإيواء 👋</h4>
    <p>نظرة عامة على بيانات المركز والخدمات والاحتياجات.</p>
    <div class="mt-3 small">
        <i class="bi bi-calendar3 ms-1"></i>
        <span id="dashboardDate"></span>
    </div>
</div>


<div class="row g-3 mb-4">

    <div class="col-12 col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon text-success"><i class="bi bi-people"></i></div>
            <p>الأسر المسجلة</p>
            <h3>128</h3>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon text-primary"><i class="bi bi-person-vcard"></i></div>
            <p>إجمالي الأفراد</p>
            <h3>542</h3>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon text-warning"><i class="bi bi-box-seam"></i></div>
            <p>الاحتياجات المعلقة</p>
            <h3>18</h3>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon text-danger"><i class="bi bi-exclamation-triangle"></i></div>
            <p>الاحتياجات العاجلة</p>
            <h3>5</h3>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon text-success"><i class="bi bi-house-check"></i></div>
            <p>الأسر المقيمة</p>
            <h3>116</h3>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon text-success"><i class="bi bi-check-circle"></i></div>
            <p>الاحتياجات المكتملة</p>
            <h3>35</h3>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon text-primary"><i class="bi bi-box-arrow-in-left"></i></div>
            <p>حالات الوصول اليوم</p>
            <h3>12</h3>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon text-secondary"><i class="bi bi-door-open"></i></div>
            <p>حالات المغادرة اليوم</p>
            <h3>3</h3>
        </div>
    </div>

</div>


<div class="row g-3 mb-4">

    <div class="col-12 col-lg-6">
        <div class="dashboard-panel">
            <h5>حالة إشغال المركز</h5>

            <div class="d-flex justify-content-between">
                <strong class="fs-3">84%</strong>
                <span class="text-secondary small">السعة: 500 شخص</span>
            </div>

            <div class="progress my-3" style="height: 10px;">
                <div class="progress-bar bg-success" style="width: 84%"></div>
            </div>

            <div class="d-flex justify-content-between small text-secondary">
                <span>الموجودون: 420</span>
                <span>المتبقي: 80</span>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-6">
        <div class="dashboard-panel">
            <h5>آخر الأنشطة</h5>

            <div class="dashboard-item">
                <i class="bi bi-person-plus text-success ms-2"></i>
                إضافة أسرة جديدة
                <small class="d-block text-secondary mt-1">أحمد محمد · 09:15 صباحًا</small>
            </div>

            <div class="dashboard-item">
                <i class="bi bi-pencil-square text-primary ms-2"></i>
                تحديث بيانات أسرة
                <small class="d-block text-secondary mt-1">محمد علي · 10:20 صباحًا</small>
            </div>

            <div class="dashboard-item">
                <i class="bi bi-box-seam text-warning ms-2"></i>
                تسجيل احتياج جديد
                <small class="d-block text-secondary mt-1">سارة خالد · 11:05 صباحًا</small>
            </div>

            <a href="{{ url('/activity') }}" class="btn btn-outline-success btn-sm mt-3">
                عرض سجل النشاط
            </a>
        </div>
    </div>

</div>


<div class="row g-3 mb-4">

    <div class="col-12 col-lg-6">
        <div class="dashboard-panel">
            <h5>الاحتياجات ذات الأولوية</h5>

            <div class="dashboard-item d-flex justify-content-between gap-2">
                <span>مياه الشرب</span>
                <span class="badge bg-danger">عاجلة · 30</span>
            </div>

            <div class="dashboard-item d-flex justify-content-between gap-2">
                <span>البطانيات</span>
                <span class="badge bg-danger">عاجلة · 15</span>
            </div>

            <div class="dashboard-item d-flex justify-content-between gap-2">
                <span>حليب الأطفال</span>
                <span class="badge bg-warning text-dark">قيد المتابعة · 8</span>
            </div>

            <div class="dashboard-item d-flex justify-content-between gap-2">
                <span>مستلزمات النظافة</span>
                <span class="badge bg-success">قيد التوفير · 12</span>
            </div>

            <a href="{{ url('/needs') }}" class="btn btn-outline-success btn-sm mt-3">
                عرض الاحتياجات
            </a>
        </div>
    </div>

    <div class="col-12 col-lg-6">
        <div class="dashboard-panel">
            <h5>الإجراءات السريعة</h5>

            <div class="row g-3">
                <div class="col-12 col-sm-6">
                    <a href="{{ url('/families') }}" class="quick-link">
                        <i class="bi bi-people text-success ms-2"></i>
                        إدارة الأسر
                    </a>
                </div>

                <div class="col-12 col-sm-6">
                    <a href="{{ url('/individuals') }}" class="quick-link">
                        <i class="bi bi-person-vcard text-primary ms-2"></i>
                        إدارة الأفراد
                    </a>
                </div>

                <div class="col-12 col-sm-6">
                    <a href="{{ url('/needs') }}" class="quick-link">
                        <i class="bi bi-clipboard-check text-success ms-2"></i>
                        متابعة الاحتياجات
                    </a>
                </div>

                <div class="col-12 col-sm-6">
                    <a href="{{ url('/activity') }}" class="quick-link">
                        <i class="bi bi-clock-history text-primary ms-2"></i>
                        سجل النشاط
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    document.getElementById('dashboardDate').textContent =
        new Intl.DateTimeFormat('ar', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        }).format(new Date());
</script>

@endsection