@extends('layouts.layout')

@section('title', 'الأنشطة')
@section('header', 'سجل الأنشطة')

@section('content')

<style>
.activity-heading {
    background: linear-gradient(125deg, #17243a, #233c59 65%, #176c70);
    color: white;
    padding: 25px;
    border-radius: 15px;
    margin-bottom: 20px;
}

.activity-card {
    border: 1px solid #e5eaf1;
    border-radius: 12px;
    background: white;
}

.activity-icon {
    font-size: 25px;
    color: #159a91;
}
</style>

<div>

    <div class="activity-heading">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="fw-bold">سجل الأنشطة</h4>
                <p class="mb-0">متابعة العمليات والتغييرات المسجلة في المركز.</p>
            </div>

            <i class="bi bi-clock-history fs-1"></i>
        </div>
    </div>


    <div class="row g-3 mb-4">

        <div class="col-12 col-sm-6 col-xl-4">
            <div class="activity-card p-3 d-flex align-items-center gap-3">
                <i class="bi bi-calendar-check activity-icon"></i>
                <div>
                    <p class="text-secondary mb-1">أحدث فترة نشاط</p>
                    <h4 class="fw-bold mb-0">اليوم</h4>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-4">
            <div class="activity-card p-3 d-flex align-items-center gap-3">
                <i class="bi bi-arrow-left-right activity-icon"></i>
                <div>
                    <p class="text-secondary mb-1">إجمالي العمليات</p>
                    <h4 class="fw-bold mb-0">28</h4>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-4">
            <div class="activity-card p-3 d-flex align-items-center gap-3">
                <i class="bi bi-people activity-icon"></i>
                <div>
                    <p class="text-secondary mb-1">إجمالي المستخدمين</p>
                    <h4 class="fw-bold mb-0">11</h4>
                </div>
            </div>
        </div>

    </div>

    <div class="activity-card p-3 p-md-4">

        <h5 class="fw-bold mb-2">قائمة الأنشطة</h5>
        <p class="text-secondary small">ابحث عن نشاط أو حدّد نوعه وتاريخه.</p>


        <div class="row g-3 mb-4">

            <div class="col-12 col-md-6">
                <input type="text" id="activitySearch" class="form-control" placeholder="ابحث باسم النشاط أو المستخدم">
            </div>

            <div class="col-12 col-md-3">
                <select id="activityType" class="form-select">
                    <option value="">كل الأنشطة</option>
                    <option value="إضافة أسرة">إضافة أسرة</option>
                    <option value="إضافة فرد">إضافة فرد</option>
                    <option value="إضافة احتياج">إضافة احتياج</option>
                    <option value="تعديل بيانات">تعديل بيانات</option>
                    <option value="تغيير حالة احتياج">تغيير حالة احتياج</option>
                    <option value="حذف احتياج">حذف احتياج</option>
                </select>
            </div>

            <div class="col-12 col-md-3">
                <input type="date" id="activityDate" class="form-control">
            </div>

        </div>


        <div class="table-responsive">
            <table class="table table-hover text-center align-middle">
                <thead class="table-light">
                    <tr>
                        <th>النشاط</th>
                        <th>المستخدم</th>
                        <th>التاريخ</th>
                        <th>التفاصيل</th>
                    </tr>
                </thead>

                <tbody id="activityTable">

                    <tr data-type="إضافة أسرة" data-date="2026-11-16">
                        <td>إضافة أسرة</td>
                        <td>أحمد</td>
                        <td>2026-11-16</td>
                        <td>تم تسجيل أسرة جديدة</td>
                    </tr>

                    <tr data-type="إضافة فرد" data-date="2026-11-15">
                        <td>إضافة فرد</td>
                        <td>محمد</td>
                        <td>2026-11-15</td>
                        <td>تم تسجيل فرد جديد</td>
                    </tr>

                    <tr data-type="إضافة احتياج" data-date="2026-11-14">
                        <td>إضافة احتياج</td>
                        <td>خالد</td>
                        <td>2026-11-14</td>
                        <td>تم تسجيل احتياج جديد</td>
                    </tr>

                    <tr data-type="تعديل بيانات" data-date="2026-11-13">
                        <td>تعديل بيانات</td>
                        <td>أحمد</td>
                        <td>2026-11-13</td>
                        <td>تم تحديث بيانات أسرة</td>
                    </tr>

                </tbody>
            </table>
        </div>

        <p id="noActivities" class="text-center text-secondary d-none">
            لا توجد أنشطة مطابقة للبحث.
        </p>

    </div>

</div>


<script>
const search = document.getElementById('activitySearch');
const type = document.getElementById('activityType');
const date = document.getElementById('activityDate');
const rows = document.querySelectorAll('#activityTable tr');
const noActivities = document.getElementById('noActivities');

function filterActivities() {
    let count = 0;

    rows.forEach(function(row) {
        let text = row.innerText.toLowerCase();
        let matchesSearch = text.includes(search.value.toLowerCase());
        let matchesType = !type.value || row.dataset.type === type.value;
        let matchesDate = !date.value || row.dataset.date === date.value;

        if (matchesSearch && matchesType && matchesDate) {
            row.style.display = '';
            count++;
        } else {
            row.style.display = 'none';
        }
    });

    noActivities.classList.toggle('d-none', count > 0);
}

search.addEventListener('input', filterActivities);
type.addEventListener('change', filterActivities);
date.addEventListener('change', filterActivities);
</script>

@endsection