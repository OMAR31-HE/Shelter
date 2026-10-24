@extends('layouts.layout')

@section('title', 'الأنشطة')
@section('header', 'أخر الأنشطة')

@section('content')
<div class="page-heading">
    <h4>الأنشطة</h4>
    <p>أخر الأنشطة في المركز</p>
</div>

<div class="row g-3 mb-4">
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="panel">
            <h3 id="totalNeeds">اليوم</h3>
            <p>أحدث نشاط</p>

        </div>
    </div>
     <div class="col-12 col-sm-6 col-xl-3">
        <div class="panel">
            <h3 id="totalNeeds">28</h3>
            <p>إجمالي العمليات</p>

        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="panel">
            <h3 id="totalNeeds">11</h3>
            <p>إجمالي المستخدمين</p>

        </div>
    </div>
</div>
<div class="panel">

    <h5 class="mb-3">قائمة الأنشطة</h5>

    <div class="row g-2 mb-3">

        <div class="col-12 col-md-6">
            <input type="text"
                id="needSearch"
                class="form-control"
                placeholder="ابحث باسم النشاط ...">
        </div>

        <div class="col-12 col-md-3">
            <select id="priorityFilter" class="form-select">
                <option value="">كل الأنشطة</option>
                <option value="إضافة أسرة">إضافة أسرة</option>
                <option value="إضافة فرد">إضافة فرد</option>
                <option value="إضافة احتياج">إضافة احتياج</option>
                <option value="تعديل بيانات">تعديل بيانات</option>
                <option value="تغيير حالة احتياج">تغيير حالة احتياج</option>
                <option value="حذف احتياج">حذف احتياج</option>

            </select>
        </div>

        <!-- <div class="col-12 col-md-3">

            <input type="date">
        </div> -->
        <div class="input-group">
        <input type="text"
               id="activityDate"
               class="form-control"
               placeholder="اختر الفترة الزمنية"
               onfocus="this.type='date'"
               onblur="if(!this.value)this.type='text'">
        <!-- <span class="input-group-text">
            <i class="bi bi-calendar3"></i>
        </span> -->

    </div>



    <!-- <div class="table-responsive">

    <div class="table-responsive">
        <table class="table table-hover" id="needsTable">

            <thead>
                <tr>
                    <th>رقم الطلب</th>
                    <th>اسم الأسرة</th>
                    <th>نوع الاحتياج</th>
                    <th>الأولوية</th>
                    <th>الحالة</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>

            <tbody>

                <tr>
                    <td>301</td>
                    <td>أسرة أحمد</td>
                    <td>مواد غذائية</td>
                    <td>
                        <span class="badge bg-danger">عاجلة</span>
                    </td>
                    <td>
                        <span class="badge bg-secondary">جديد</span>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-primary"
                            onclick="changeNeedStatus(this)">
                            تغيير الحالة
                        </button>
                        <button class="btn btn-sm btn-outline-dark mt-1"
                            onclick="showNeedHistory(this)">
                            <i class="bi bi-clock-history"></i>
                            سجل الطلب
                        </button>
                    </td>
                </tr>

                <tr>
                    <td>302</td>
                    <td>أسرة محمد</td>
                    <td>بطانيات</td>
                    <td>
                        <span class="badge bg-warning text-dark">متوسطة</span>
                    </td>
                    <td>
                        <span class="badge bg-primary">قيد المعالجة</span>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-primary"
                            onclick="changeNeedStatus(this)">
                            تغيير الحالة
                        </button>
                        <button class="btn btn-sm btn-outline-dark mt-1"
                            onclick="showNeedHistory(this)">
                            <i class="bi bi-clock-history"></i>
                            سجل الطلب
                        </button>
                    </td>
                </tr>

                <tr>
                    <td>303</td>
                    <td>أسرة علي</td>
                    <td>مواد نظافة</td>
                    <td>
                        <span class="badge bg-success">عادية</span>
                    </td>
                    <td>
                        <span class="badge bg-success">مكتمل</span>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-primary"
                            onclick="changeNeedStatus(this)">
                            تغيير الحالة
                        </button>
                        <button class="btn btn-sm btn-outline-dark mt-1"
                            onclick="showNeedHistory(this)">
                            <i class="bi bi-clock-history"></i>
                            سجل الطلب
                        </button>
                    </td>
                </tr>

                <tr>
                    <td>304</td>
                    <td>أسرة خالد</td>
                    <td>مياه شرب</td>
                    <td>
                        <span class="badge bg-danger">عاجلة</span>
                    </td>
                    <td>
                        <span class="badge bg-secondary">جديد</span>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-primary"
                            onclick="changeNeedStatus(this)">
                            تغيير الحالة
                        </button>
                        <button class="btn btn-sm btn-outline-dark mt-1"
                            onclick="showNeedHistory(this)">
                            <i class="bi bi-clock-history"></i>
                            سجل الطلب
                        </button>

                    </td>


                </tr>

                <tr id="noNeedsResults" style="display: none;">
                    <td colspan="5" class="text-center text-muted">
                        لا توجد نتائج مطابقة
                    </td>
                </tr>

            </tbody>

        </table>
    </div>

</div>
 -->

<div class="modal fade" id="needHistoryModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">سجل تتبّع الاحتياج</h5>
                <button type="button" class="btn-close"
                        data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <h6 id="historyNeedName"></h6>

                <ul class="list-group" id="needHistoryList">
                    <li class="list-group-item">
                        <i class="bi bi-plus-circle text-primary"></i>
                        تم تسجيل الاحتياج
                    </li>
                </ul>

            </div>

        </div>
    </div>
</div>

@endsection
@push('styles')
<style>
@media (max-width: 480px) {
    .main-content {
        padding: 8px;
    }

    .table {
        font-size: 13px;
    }

    .btn {
        font-size: 12px;
    }
}

</style>
@endpush



