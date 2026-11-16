@extends('layouts.layout')

@section('title', 'متابعة الاحتياجات')
@section('header', 'متابعة الاحتياجات')

@section('content')

<div class="needs-page">


    <div class="page-heading d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <span class="needs-eyebrow">
                <i class="bi bi-clipboard2-pulse"></i>
                إدارة الخدمات والمساعدات
            </span>

            <h4 class="needs-title">متابعة احتياجات الأسر</h4>
            <p class="needs-subtitle">
                متابعة الطلبات وتحديد الأولويات ومراقبة حالة الاحتياجات داخل المركز.
            </p>
        </div>

        <button type="button" class="add-btn" data-bs-toggle="modal" data-bs-target="#addNeedModal">
            <i class="bi bi-plus-lg"></i>
            تسجيل احتياج جديد
        </button>
    </div>


    <div class="row g-3 needs-stats">

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card stat-total">
                <div class="stat-top">
                    <span class="stat-icon"><i class="bi bi-clipboard-data"></i></span>
                    <span class="stat-label">جميع الطلبات</span>
                </div>
                <h3 id="totalNeeds">{{ count($needs) }}</h3>
                <p>إجمالي الاحتياجات المسجلة</p>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card stat-urgent">
                <div class="stat-top">
                    <span class="stat-icon"><i class="bi bi-exclamation-triangle"></i></span>
                    <span class="stat-label">أولوية عاجلة</span>
                </div>
                <h3 id="urgentNeeds">
                    {{ count(array_filter($needs, fn($n) => $n['priority'] === 'عاجلة')) }}
                </h3>
                <p>تحتاج إلى متابعة سريعة</p>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card stat-processing">
                <div class="stat-top">
                    <span class="stat-icon"><i class="bi bi-arrow-repeat"></i></span>
                    <span class="stat-label">قيد المعالجة</span>
                </div>
                <h3 id="processingNeeds">
                    {{ count(array_filter($needs, fn($n) => $n['status'] === 'قيد المعالجة')) }}
                </h3>
                <p>طلبات يجري العمل عليها</p>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card stat-completed">
                <div class="stat-top">
                    <span class="stat-icon"><i class="bi bi-check2-circle"></i></span>
                    <span class="stat-label">تمت تلبيتها</span>
                </div>
                <h3 id="completedNeeds">
                    {{ count(array_filter($needs, fn($n) => $n['status'] === 'مكتمل')) }}
                </h3>
                <p>طلبات تم إنجازها</p>
            </div>
        </div>

    </div>

  
    <div class="needs-panel">

        <div class="panel-heading">
            <div>
                <h5>قائمة الاحتياجات</h5>
                <p>ابحث عن الطلبات وراجع حالتها وأولويتها.</p>
            </div>

            <span class="results-count">
                <i class="bi bi-list-ul"></i>
                <span id="visibleNeeds">{{ count($needs) }}</span> طلب
            </span>
        </div>


        <div class="needs-filters">

            <div class="search-box">
                <i class="bi bi-search"></i>
                <input type="text" id="needSearch" class="form-control"
                    placeholder="ابحث باسم الأسرة أو نوع الاحتياج..." aria-label="البحث في الاحتياجات">
            </div>

            <div class="filter-box">
                <i class="bi bi-flag"></i>
                <select id="priorityFilter" class="form-select" aria-label="فلترة حسب الأولوية">
                    <option value="">كل الأولويات</option>
                    <option value="عاجلة">عاجلة</option>
                    <option value="متوسطة">متوسطة</option>
                    <option value="عادية">عادية</option>
                </select>
            </div>

            <div class="filter-box">
                <i class="bi bi-funnel"></i>
                <select id="statusFilter" class="form-select" aria-label="فلترة حسب الحالة">
                    <option value="">كل الحالات</option>
                    <option value="جديد">جديد</option>
                    <option value="قيد المعالجة">قيد المعالجة</option>
                    <option value="مكتمل">مكتمل</option>
                </select>
            </div>

        </div>

        <div class="table-responsive needs-table-wrap">
            <table class="table needs-table" id="needsTable">
                <thead>
                    <tr>
                        <th>رقم الطلب</th>
                        <th>الأسرة</th>
                        <th>نوع الاحتياج</th>
                        <th>الأولوية</th>
                        <th>الحالة</th>
                        <th class="actions-column">الإجراءات</th>
                    </tr>
                </thead>

                <tbody>
                    @php
                    $priorityBadge = [
                    'عاجلة' => 'priority-urgent',
                    'متوسطة' => 'priority-medium',
                    'عادية' => 'priority-normal',
                    ];

                    $statusBadge = [
                    'جديد' => 'status-new',
                    'قيد المعالجة' => 'status-processing',
                    'مكتمل' => 'status-completed',
                    ];
                    @endphp

                    @forelse ($needs as $need)
                    <tr>
                        <td>
                            <span class="request-number">
                                #{{ $need['id'] }}
                            </span>
                        </td>

                        <td>
                            <div class="family-cell">
                                <span class="family-icon">
                                    <i class="bi bi-house-heart"></i>
                                </span>
                                <span>{{ $need['family'] }}</span>
                            </div>
                        </td>

                        <td>
                            <span class="need-type">{{ $need['type'] }}</span>
                        </td>

                        <td>
                            <span class="need-badge {{ $priorityBadge[$need['priority']] ?? 'priority-normal' }}">
                                <span class="badge-dot"></span>
                                {{ $need['priority'] }}
                            </span>
                        </td>

                        <td>
                            <span class="need-badge {{ $statusBadge[$need['status']] ?? 'status-new' }}">
                                <span class="badge-dot"></span>
                                {{ $need['status'] }}
                            </span>
                        </td>

                        <td>
                            <div class="action-buttons">
                                <button type="button" class="action-btn action-status" onclick="changeNeedStatus(this)"
                                    title="تغيير حالة الطلب">
                                    <i class="bi bi-arrow-repeat"></i>
                                    <span>تغيير الحالة</span>
                                </button>

                                <button type="button" class="action-btn action-history" onclick="showNeedHistory(this)"
                                    title="عرض سجل الطلب">
                                    <i class="bi bi-clock-history"></i>
                                    <span>السجل</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr id="emptyNeeds">
                        <td colspan="6">
                            <div class="empty-state">
                                <i class="bi bi-inbox"></i>
                                <h6>لا توجد احتياجات مسجلة</h6>
                                <p>يمكنك تسجيل أول احتياج باستخدام الزر بالأعلى.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse

                    <tr id="noNeedsResults" style="display: none;">
                        <td colspan="6">
                            <div class="empty-state">
                                <i class="bi bi-search"></i>
                                <h6>لا توجد نتائج مطابقة</h6>
                                <p>جرّب تغيير كلمات البحث أو خيارات التصفية.</p>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="table-footer">
            <span>
                <i class="bi bi-shield-check"></i>
                متابعة احتياجات الأسر المسجلة في المركز
            </span>
        </div>

    </div>

</div>


<div class="modal fade" id="needHistoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content needs-modal">

            <div class="modal-header">
                <div>
                    <span class="modal-eyebrow">سجل المتابعة</span>
                    <h5 class="modal-title">سجل تتبّع الاحتياج</h5>
                </div>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
            </div>

            <div class="modal-body">
                <h6 id="historyNeedName" class="history-request-name"></h6>
                <ul class="list-group history-list" id="needHistoryList"></ul>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                    إغلاق
                </button>
            </div>

        </div>
    </div>
</div>


<div class="modal fade" id="addNeedModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content needs-modal" method="POST" action="{{ url('/needs') }}">
            @csrf

            <div class="modal-header">
                <div>
                    <span class="modal-eyebrow">إدارة الاحتياجات</span>
                    <h5 class="modal-title">تسجيل احتياج جديد</h5>
                </div>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
            </div>

            <div class="modal-body">

                <div class="form-field">
                    <label for="needFamily" class="form-label">الأسرة</label>
                    <select name="family" id="needFamily" class="form-select" required>
                        <option value="">اختر الأسرة</option>
                        @foreach ($families as $familyName)
                        <option value="{{ $familyName }}">{{ $familyName }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-field">
                    <label for="needType" class="form-label">نوع الاحتياج</label>
                    <input type="text" name="type" id="needType" class="form-control" placeholder="مثال: مواد غذائية"
                        maxlength="150" required>
                </div>

                <div class="form-field">
                    <label for="needPriority" class="form-label">الأولوية</label>
                    <select name="priority" id="needPriority" class="form-select" required>
                        <option value="عاجلة">عاجلة</option>
                        <option value="متوسطة">متوسطة</option>
                        <option value="عادية">عادية</option>
                    </select>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                    إلغاء
                </button>

                <button type="submit" class="add-btn">
                    <i class="bi bi-check2-circle"></i>
                    حفظ الاحتياج
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('styles')
<style>
.needs-page {
    --needs-primary: #167d79;
    --needs-primary-dark: #105e5b;
    --needs-ink: #1d2b3f;
    --needs-muted: #788598;
    --needs-border: #e8edf3;
    color: var(--needs-ink);
}

.needs-page .page-heading {
    margin-bottom: 25px;
}

.needs-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    color: var(--needs-primary);
    background: #e8f6f4;
    border-radius: 7px;
    padding: 6px 10px;
    font-size: 12px;
    font-weight: 700;
    margin-bottom: 10px;
}

.needs-title {
    font-size: 25px;
    font-weight: 800;
    margin: 0 0 8px;
    letter-spacing: -0.5px;
}

.needs-subtitle {
    color: var(--needs-muted);
    margin: 0;
    font-size: 14px;
    line-height: 1.8;
}

.add-btn {
    display: inline-flex;
    justify-content: center;
    align-items: center;
    gap: 8px;
    background: var(--needs-primary);
    color: #fff;
    border: 1px solid var(--needs-primary);
    padding: 11px 16px;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
    cursor: pointer;
    transition: background .2s ease, transform .2s ease;
    white-space: nowrap;
}

.add-btn:hover {
    background: var(--needs-primary-dark);
    border-color: var(--needs-primary-dark);
    color: #fff;
    transform: translateY(-1px);
}

.needs-stats {
    margin-bottom: 24px;
}

.stat-card {
    height: 100%;
    min-height: 155px;
    padding: 20px;
    border: 1px solid var(--needs-border);
    border-radius: 15px;
    background: #fff;
    box-shadow: 0 5px 18px rgba(30, 49, 75, .035);
    transition: transform .2s ease, box-shadow .2s ease;
}

.stat-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(30, 49, 75, .08);
}

.stat-top {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 8px;
}

.stat-icon {
    width: 42px;
    height: 42px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 12px;
    font-size: 19px;
}

.stat-label {
    color: var(--needs-muted);
    font-size: 12px;
    font-weight: 700;
}

.stat-card h3 {
    font-size: 29px;
    font-weight: 800;
    margin: 13px 0 4px;
    line-height: 1.1;
}

.stat-card p {
    color: var(--needs-muted);
    font-size: 12px;
    margin: 0;
}

.stat-total .stat-icon {
    background: #eaf1ff;
    color: #3769d8;
}

.stat-urgent .stat-icon {
    background: #fff0ed;
    color: #df4d3f;
}

.stat-processing .stat-icon {
    background: #fff5df;
    color: #bd8314;
}

.stat-completed .stat-icon {
    background: #e8f8ef;
    color: #198754;
}

.stat-total h3 {
    color: #3769d8;
}

.stat-urgent h3 {
    color: #df4d3f;
}

.stat-processing h3 {
    color: #bd8314;
}

.stat-completed h3 {
    color: #198754;
}

.needs-panel {
    background: #fff;
    border: 1px solid var(--needs-border);
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(30, 49, 75, .035);
}

.panel-heading {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
    padding: 22px 22px 18px;
    border-bottom: 1px solid #edf0f5;
}

.panel-heading h5 {
    font-size: 17px;
    font-weight: 800;
    margin: 0 0 6px;
}

.panel-heading p {
    color: var(--needs-muted);
    font-size: 12px;
    margin: 0;
}

.results-count {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    color: var(--needs-primary);
    background: #eaf7f5;
    padding: 8px 11px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 700;
    white-space: nowrap;
}

.needs-filters {
    display: grid;
    grid-template-columns: minmax(200px, 1.7fr) minmax(150px, 1fr) minmax(150px, 1fr);
    gap: 12px;
    padding: 18px 22px;
    background: #fbfcfe;
    border-bottom: 1px solid #edf0f5;
}

.search-box,
.filter-box {
    display: flex;
    align-items: center;
    gap: 9px;
    min-width: 0;
    background: #fff;
    border: 1px solid #e0e6ee;
    border-radius: 9px;
    padding: 0 12px;
    transition: border-color .2s ease, box-shadow .2s ease;
}

.search-box:focus-within,
.filter-box:focus-within {
    border-color: var(--needs-primary);
    box-shadow: 0 0 0 3px rgba(22, 125, 121, .09);
}

.search-box>i,
.filter-box>i {
    color: #8a96a8;
    font-size: 15px;
    flex-shrink: 0;
}

.search-box .form-control,
.filter-box .form-select {
    border: 0;
    box-shadow: none;
    min-width: 0;
    height: 43px;
    font-size: 12px;
    background-color: transparent;
}

.filter-box .form-select {
    padding-right: 0;
}

.needs-table-wrap {
    padding: 0 12px;
}

.needs-table {
    width: 100%;
    margin: 0;
    vertical-align: middle;
    white-space: nowrap;
}

.needs-table thead th {
    background: #f8fafc;
    color: #788598;
    font-size: 11px;
    font-weight: 800;
    padding: 15px 12px;
    border-bottom: 1px solid #e9eef4;
}

.needs-table tbody td {
    padding: 15px 12px;
    border-bottom: 1px solid #edf1f5;
    font-size: 12px;
    color: #344256;
}

.needs-table tbody tr:last-child td {
    border-bottom: 0;
}

.needs-table tbody tr {
    transition: background .15s ease;
}

.needs-table tbody tr:hover {
    background: #f9fbfd;
}

.request-number {
    display: inline-block;
    direction: ltr;
    color: #617087;
    background: #f1f4f8;
    border-radius: 6px;
    padding: 5px 8px;
    font-weight: 800;
    font-size: 11px;
}

.family-cell {
    display: flex;
    align-items: center;
    gap: 9px;
    font-weight: 700;
}

.family-icon {
    width: 32px;
    height: 32px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: #edf6f5;
    color: var(--needs-primary);
    border-radius: 9px;
    font-size: 15px;
    flex-shrink: 0;
}

.need-type {
    font-weight: 600;
}

.need-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 9px;
    border-radius: 7px;
    font-size: 11px;
    font-weight: 800;
}

.badge-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: currentColor;
}

.priority-urgent {
    color: #c63830;
    background: #fff0ee;
}

.priority-medium {
    color: #99630b;
    background: #fff5dc;
}

.priority-normal {
    color: #197447;
    background: #eaf8ef;
}

.status-new {
    color: #647184;
    background: #eef1f5;
}

.status-processing {
    color: #94620b;
    background: #fff4d7;
}

.status-completed {
    color: #187647;
    background: #e6f7ed;
}

.action-buttons {
    display: flex;
    align-items: center;
    gap: 6px;
}

.action-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 5px;
    border: 1px solid #e1e7ef;
    border-radius: 7px;
    background: #fff;
    padding: 7px 9px;
    font-size: 11px;
    font-weight: 700;
    transition: .2s ease;
}

.action-status {
    color: var(--needs-primary);
}

.action-status:hover {
    background: #eaf7f5;
    border-color: #bce2dd;
}

.action-history {
    color: #53647a;
}

.action-history:hover {
    background: #f0f3f8;
    border-color: #d8e0ea;
}

.table-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 13px 22px;
    background: #fbfcfe;
    border-top: 1px solid #edf0f5;
    color: var(--needs-muted);
    font-size: 11px;
}

.table-footer i {
    color: var(--needs-primary);
    margin-left: 4px;
}

.empty-state {
    text-align: center;
    padding: 30px 12px;
    color: var(--needs-muted);
    white-space: normal;
}

.empty-state>i {
    display: inline-block;
    font-size: 28px;
    color: #9aa8b9;
    margin-bottom: 9px;
}

.empty-state h6 {
    font-weight: 800;
    color: var(--needs-ink);
    font-size: 13px;
}

.empty-state p {
    font-size: 12px;
    margin: 0;
}

.needs-modal {
    border: 0;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(20, 35, 55, .18);
}

.needs-modal .modal-header {
    padding: 20px 22px;
    border-bottom: 1px solid #edf0f5;
}

.needs-modal .modal-title {
    font-weight: 800;
    font-size: 17px;
    margin-top: 4px;
}

.modal-eyebrow {
    color: var(--needs-primary);
    font-size: 11px;
    font-weight: 800;
}

.needs-modal .modal-body {
    padding: 22px;
}

.needs-modal .modal-footer {
    padding: 15px 22px;
    border-top: 1px solid #edf0f5;
    gap: 8px;
}

.form-field {
    margin-bottom: 18px;
}

.form-field:last-child {
    margin-bottom: 0;
}

.form-field .form-label {
    font-size: 12px;
    font-weight: 800;
    color: #344256;
    margin-bottom: 8px;
}

.form-field .form-control,
.form-field .form-select {
    min-height: 44px;
    font-size: 13px;
    border-color: #dfe6ee;
    border-radius: 9px;
}

.form-field .form-control:focus,
.form-field .form-select:focus {
    border-color: var(--needs-primary);
    box-shadow: 0 0 0 3px rgba(22, 125, 121, .1);
}

.history-request-name {
    background: #f5f8fb;
    border: 1px solid #e8edf3;
    border-radius: 9px;
    padding: 12px;
    margin-bottom: 15px;
    font-size: 13px;
    font-weight: 800;
}

.history-list .list-group-item {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    padding: 13px;
    font-size: 12px;
    border-color: #edf0f5;
}

.history-list .list-group-item i {
    font-size: 16px;
    margin-top: 1px;
}

@media (max-width: 768px) {
    .needs-page .page-heading {
        align-items: stretch !important;
    }

    .needs-title {
        font-size: 21px;
    }

    .needs-page .page-heading .add-btn {
        width: 100%;
    }

    .needs-filters {
        grid-template-columns: 1fr;
        padding: 15px;
    }

    .panel-heading {
        padding: 18px 15px;
    }

    .needs-table-wrap {
        padding: 0 8px;
    }

    .needs-table thead th,
    .needs-table tbody td {
        padding: 12px 10px;
    }

    .table-footer {
        padding: 12px 15px;
    }
}

@media (max-width: 480px) {
    .stat-card {
        min-height: 135px;
        padding: 16px;
    }

    .stat-card h3 {
        font-size: 25px;
    }

    .stat-label {
        font-size: 11px;
    }

    .action-buttons {
        align-items: stretch;
        flex-direction: column;
    }

    .action-btn {
        width: 100%;
    }

    .needs-modal .modal-body {
        padding: 17px;
    }


}


.needs-page .page-heading {
    background: #17243a;
    color: #ffffff;
    padding: 24px;
    border-radius: 14px;
    margin-bottom: 24px;
}

.needs-page .page-heading .needs-title {
    color: #ffffff;
}

.needs-page .page-heading .needs-subtitle {
    color: #cbd5e1;
}

.needs-page .page-heading .needs-eyebrow {
    background: rgba(255, 255, 255, 0.12);
    color: #8de0d5;
}

.needs-page .page-heading .add-btn {
    background: #159a91;
    border-color: #159a91;
    color: #ffffff;
}

.needs-page .page-heading .add-btn:hover {
    background: #117c75;
    border-color: #117c75;
}
</style>

@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const needSearch = document.getElementById('needSearch');
    const priorityFilter = document.getElementById('priorityFilter');
    const statusFilter = document.getElementById('statusFilter');
    const needsTable = document.getElementById('needsTable');
    const noNeedsResults = document.getElementById('noNeedsResults');
    const visibleNeeds = document.getElementById('visibleNeeds');

    if (!needsTable) {
        return;
    }

    function getNeedRows() {
        return Array.from(needsTable.querySelectorAll('tbody tr'))
            .filter(function(row) {
                return row.id !== 'noNeedsResults' && row.id !== 'emptyNeeds';
            });
    }

    function updateStatistics() {
        const rows = getNeedRows();

        let urgent = 0;
        let processing = 0;
        let completed = 0;

        rows.forEach(function(row) {
            const priority = row.cells[3].textContent.trim();
            const status = row.cells[4].textContent.trim();

            if (priority === 'عاجلة') urgent++;
            if (status === 'قيد المعالجة') processing++;
            if (status === 'مكتمل') completed++;
        });

        document.getElementById('totalNeeds').textContent = rows.length;
        document.getElementById('urgentNeeds').textContent = urgent;
        document.getElementById('processingNeeds').textContent = processing;
        document.getElementById('completedNeeds').textContent = completed;
    }

    function filterNeeds() {
        const searchText = needSearch.value.trim().toLowerCase();
        const priority = priorityFilter.value;
        const status = statusFilter.value;

        let found = 0;

        getNeedRows().forEach(function(row) {
            const rowText = row.textContent.toLowerCase();
            const rowPriority = row.cells[3].textContent.trim();
            const rowStatus = row.cells[4].textContent.trim();

            const matchesSearch = rowText.includes(searchText);
            const matchesPriority = !priority || rowPriority === priority;
            const matchesStatus = !status || rowStatus === status;
            const isMatch = matchesSearch && matchesPriority && matchesStatus;

            row.style.display = isMatch ? '' : 'none';

            if (isMatch) {
                found++;
            }
        });

        if (noNeedsResults) {
            noNeedsResults.style.display = found === 0 && getNeedRows().length > 0 ? '' : 'none';
        }

        if (visibleNeeds) {
            visibleNeeds.textContent = found;
        }
    }

    needSearch.addEventListener('input', filterNeeds);
    priorityFilter.addEventListener('change', filterNeeds);
    statusFilter.addEventListener('change', filterNeeds);

    window.changeNeedStatus = function(button) {
        const row = button.closest('tr');

        if (!row) return;

        const statusBadge = row.cells[4].querySelector('.need-badge');

        const statuses = [{
                text: 'جديد',
                className: 'status-new'
            },
            {
                text: 'قيد المعالجة',
                className: 'status-processing'
            },
            {
                text: 'مكتمل',
                className: 'status-completed'
            }
        ];

        const currentStatus = statusBadge.textContent.trim();
        const currentIndex = statuses.findIndex(function(status) {
            return status.text === currentStatus;
        });

        const nextStatus = statuses[(currentIndex + 1) % statuses.length];

        statusBadge.className = 'need-badge ' + nextStatus.className;
        statusBadge.innerHTML = '<span class="badge-dot"></span>' + nextStatus.text;

        filterNeeds();
        updateStatistics();
    };

    window.showNeedHistory = function(button) {
        const row = button.closest('tr');

        if (!row) return;

        const requestNumber = row.cells[0].textContent.trim();
        const familyName = row.cells[1].textContent.trim();
        const needName = row.cells[2].textContent.trim();
        const priority = row.cells[3].textContent.trim();
        const status = row.cells[4].textContent.trim();

        document.getElementById('historyNeedName').textContent =
            'الطلب ' + requestNumber + ' — ' + familyName;

        const historyList = document.getElementById('needHistoryList');
        historyList.replaceChildren();

        const historyItems = [{
                icon: 'bi-plus-circle',
                color: 'text-primary',
                text: 'تم تسجيل الاحتياج: ' + needName
            },
            {
                icon: 'bi-flag',
                color: 'text-danger',
                text: 'الأولوية الحالية: ' + priority
            },
            {
                icon: 'bi-arrow-repeat',
                color: 'text-warning',
                text: 'الحالة الحالية: ' + status
            }
        ];

        historyItems.forEach(function(item) {
            const li = document.createElement('li');
            li.className = 'list-group-item';

            const icon = document.createElement('i');
            icon.className = 'bi ' + item.icon + ' ' + item.color;

            const text = document.createElement('span');
            text.textContent = item.text;

            li.appendChild(icon);
            li.appendChild(text);
            historyList.appendChild(li);
        });

        const modalElement = document.getElementById('needHistoryModal');
        bootstrap.Modal.getOrCreateInstance(modalElement).show();
    };

    updateStatistics();
    filterNeeds();
});
</script>
@endpush
