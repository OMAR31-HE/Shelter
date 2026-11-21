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
            <p class="needs-subtitle">متابعة الطلبات وتحديد الأولويات ومراقبة حالة الاحتياجات داخل المركز</p>
        </div>
        <button type="button" class="add-btn" data-bs-toggle="modal" data-bs-target="#addNeedModal">
            <i class="bi bi-plus-lg"></i> تسجيل احتياج جديد
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
                <h3 id="urgentNeeds">{{ count(array_filter($needs, fn($n) => $n['priority'] === 'عاجلة')) }}</h3>
                <p>تحتاج إلى متابعة سريعة</p>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="stat-card stat-processing">
                <div class="stat-top">
                    <span class="stat-icon"><i class="bi bi-arrow-repeat"></i></span>
                    <span class="stat-label">قيد المعالجة</span>
                </div>
                <h3 id="processingNeeds">{{ count(array_filter($needs, fn($n) => $n['status'] === 'قيد المعالجة')) }}
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
                <h3 id="completedNeeds">{{ count(array_filter($needs, fn($n) => $n['status'] === 'مكتمل')) }}</h3>
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
                    'عادية' => 'priority-normal'
                    ];

                    $statusBadge = [
                    'جديد' => 'status-new',
                    'قيد المعالجة' => 'status-processing',
                    'مكتمل' => 'status-completed'
                    ];
                    @endphp

                    @forelse ($needs as $need)
                    <tr>
                        <td>
                            <span class="request-number">#{{ $need['id'] }}</span>
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

                    <tr id="noNeedsResults" style="display:none">
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
            <span><i class="bi bi-shield-check"></i> متابعة احتياجات الأسر المسجلة في المركز</span>
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
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">إغلاق</button>
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
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">إلغاء</button>
                <button type="submit" class="add-btn">
                    <i class="bi bi-check2-circle"></i> حفظ الاحتياج
                </button>
            </div>
        </form>
    </div>
</div>
@endsection



@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const table = document.getElementById('needsTable');
        if (!table) return;

        const search = document.getElementById('needSearch');
        const priority = document.getElementById('priorityFilter');
        const status = document.getElementById('statusFilter');
        const visible = document.getElementById('visibleNeeds');
        const noResults = document.getElementById('noNeedsResults');

        const rows = Array.from(table.querySelectorAll('tbody tr'))
            .filter(row => !['emptyNeeds', 'noNeedsResults'].includes(row.id));

        const statusClasses = {
            'جديد': 'status-new',
            'قيد المعالجة': 'status-processing',
            'مكتمل': 'status-completed'
        };

        function update() {
            let found = 0;
            let urgent = 0;
            let processing = 0;
            let completed = 0;

            rows.forEach(row => {
                const cells = row.cells;
                const p = cells[3].textContent.trim();
                const s = cells[4].textContent.trim();

                if (p === 'عاجلة') urgent++;
                if (s === 'قيد المعالجة') processing++;
                if (s === 'مكتمل') completed++;

                const matches =
                    (cells[1].textContent + ' ' + cells[2].textContent)
                    .toLowerCase()
                    .includes(search.value.trim().toLowerCase()) &&
                    (!priority.value || p === priority.value) &&
                    (!status.value || s === status.value);

                row.style.display = matches ? '' : 'none';
                if (matches) found++;
            });

            document.getElementById('totalNeeds').textContent = rows.length;
            document.getElementById('urgentNeeds').textContent = urgent;
            document.getElementById('processingNeeds').textContent = processing;
            document.getElementById('completedNeeds').textContent = completed;

            visible.textContent = found;
            noResults.style.display = found === 0 && rows.length ? '' : 'none';
        }

        search.addEventListener('input', update);
        priority.addEventListener('change', update);
        status.addEventListener('change', update);

        window.changeNeedStatus = function(button) {
            const badge = button.closest('tr').cells[4].querySelector('.need-badge');
            const states = ['جديد', 'قيد المعالجة', 'مكتمل'];
            const current = badge.textContent.trim();
            const next = states[(states.indexOf(current) + 1) % states.length];

            badge.className = 'need-badge ' + statusClasses[next];
            badge.innerHTML = '<span class="badge-dot"></span>' + next;
            update();
        };

        window.showNeedHistory = function(button) {
            const cells = button.closest('tr').cells;

            document.getElementById('historyNeedName').textContent =
                'الطلب ' + cells[0].textContent.trim() + ' — ' + cells[1].textContent.trim();

            const list = document.getElementById('needHistoryList');
            list.replaceChildren();

            [
                ['bi-plus-circle text-primary', 'الاحتياج: ' + cells[2].textContent.trim()],
                ['bi-flag text-danger', 'الأولوية: ' + cells[3].textContent.trim()],
                ['bi-arrow-repeat text-warning', 'الحالة: ' + cells[4].textContent.trim()]
            ].forEach(item => {
                const li = document.createElement('li');
                const icon = document.createElement('i');
                const text = document.createElement('span');

                icon.className = 'bi ' + item[0];
                text.textContent = item[1];
                li.className = 'list-group-item';
                li.append(icon, text);
                list.appendChild(li);
            });

            bootstrap.Modal.getOrCreateInstance(
                document.getElementById('needHistoryModal')
            ).show();
        };

        update();
    });
</script>
@endpush