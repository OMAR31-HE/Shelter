@extends('layouts.layout')

@section('title', 'متابعة الاحتياجات')
@section('header', 'متابعة الاحتياجات')

@section('content')

<div class="page-heading d-flex justify-content-between align-items-start flex-wrap gap-2">
    <div>
        <h4>متابعة احتياجات الأسر</h4>
        <p>متابعة طلبات واحتياجات الأسر داخل المركز</p>
    </div>

    <button type="button" class="add-btn" data-bs-toggle="modal" data-bs-target="#addNeedModal">
        <i class="bi bi-plus-lg"></i>
        تسجيل احتياج جديد
    </button>
</div>


<div class="row g-3 mb-4">

    <div class="col-12 col-sm-6 col-xl-3">
        <div class="panel">
            <p>إجمالي الاحتياجات</p>
            <h3 id="totalNeeds">{{ count($needs) }}</h3>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-3">
        <div class="panel">
            <p>احتياجات عاجلة</p>
            <h3 id="urgentNeeds">{{ count(array_filter($needs, fn($n) => $n['priority'] === 'عاجلة')) }}</h3>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-3">
        <div class="panel">
            <p>قيد المعالجة</p>
            <h3 id="processingNeeds">{{ count(array_filter($needs, fn($n) => $n['status'] === 'قيد المعالجة')) }}</h3>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-3">
        <div class="panel">
            <p>تمت تلبيتها</p>
            <h3 id="completedNeeds">{{ count(array_filter($needs, fn($n) => $n['status'] === 'مكتمل')) }}</h3>
        </div>
    </div>

</div>


<div class="panel">

    <h5 class="mb-3">قائمة الاحتياجات</h5>

    <div class="row g-2 mb-3">

        <div class="col-12 col-md-6">
            <input type="text"
                id="needSearch"
                class="form-control"
                placeholder="ابحث باسم الأسرة أو الاحتياج...">
        </div>

        <div class="col-12 col-md-3">
            <select id="priorityFilter" class="form-select">
                <option value="">كل الأولويات</option>
                <option value="عاجلة">عاجلة</option>
                <option value="متوسطة">متوسطة</option>
                <option value="عادية">عادية</option>
            </select>
        </div>

        <div class="col-12 col-md-3">
            <select id="statusFilter" class="form-select">
                <option value="">كل الحالات</option>
                <option value="جديد">جديد</option>
                <option value="قيد المعالجة">قيد المعالجة</option>
                <option value="مكتمل">مكتمل</option>
            </select>
        </div>

    </div>

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

                @php
                    $priorityBadge = [
                        'عاجلة' => 'bg-danger',
                        'متوسطة' => 'bg-warning text-dark',
                        'عادية' => 'bg-success',
                    ];

                    $statusBadge = [
                        'جديد' => 'bg-secondary',
                        'قيد المعالجة' => 'bg-primary',
                        'مكتمل' => 'bg-success',
                    ];
                @endphp

                @foreach ($needs as $need)
                    <tr>
                        <td>{{ $need['id'] }}</td>
                        <td>{{ $need['family'] }}</td>
                        <td>{{ $need['type'] }}</td>
                        <td>
                            <span class="badge {{ $priorityBadge[$need['priority']] ?? 'bg-secondary' }}">
                                {{ $need['priority'] }}
                            </span>
                        </td>
                        <td>
                            <span class="badge {{ $statusBadge[$need['status']] ?? 'bg-secondary' }}">
                                {{ $need['status'] }}
                            </span>
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
                @endforeach

                <tr id="noNeedsResults" style="display: none;">
                    <td colspan="6" class="text-center text-muted">
                        لا توجد نتائج مطابقة
                    </td>
                </tr>

            </tbody>

        </table>
    </div>

</div>


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

<div class="modal fade" id="addNeedModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" method="POST" action="{{ url('/needs') }}">
            @csrf

            <div class="modal-header">
                <h5 class="modal-title">تسجيل احتياج جديد</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">الأسرة</label>
                    <select name="family" class="form-select" required>
                        @foreach ($families as $familyName)
                            <option value="{{ $familyName }}">{{ $familyName }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">نوع الاحتياج</label>
                    <input type="text" name="type" class="form-control" placeholder="مثال: مواد غذائية" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">الأولوية</label>
                    <select name="priority" class="form-select">
                        <option value="عاجلة">عاجلة</option>
                        <option value="متوسطة">متوسطة</option>
                        <option value="عادية">عادية</option>
                    </select>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                <button type="submit" class="btn btn-primary">حفظ الاحتياج</button>
            </div>
        </form>
    </div>
</div>

@endsection
@push('styles')
<style>
    .add-btn {
        background-color: #159a91;
        color: white;
        border: none;
        padding: 8px 14px;
        border-radius: 8px;
        font-size: 14px;
        cursor: pointer;
        transition: 0.3s;
    }

    .add-btn:hover {
        background-color: #117c75;
    }

    .add-btn i {
        margin-left: 5px;
    }

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
@push('scripts')
<script>
    const needSearch = document.getElementById('needSearch');
    const priorityFilter = document.getElementById('priorityFilter');
    const statusFilter = document.getElementById('statusFilter');
    const needsTable = document.getElementById('needsTable');
    const noNeedsResults = document.getElementById('noNeedsResults');

    function filterNeeds() {
        const searchText = needSearch.value.trim().toLowerCase();
        const priority = priorityFilter.value;
        const status = statusFilter.value;

        const rows = needsTable.querySelectorAll('tbody tr:not(#noNeedsResults)');
        let found = 0;

        rows.forEach(function(row) {
            const cells = row.querySelectorAll('td');
            const rowText = row.textContent.toLowerCase();
            const rowPriority = cells[3].textContent.trim();
            const rowStatus = cells[4].textContent.trim();

            const matchesSearch = rowText.includes(searchText);
            const matchesPriority = !priority || rowPriority === priority;
            const matchesStatus = !status || rowStatus === status;

            if (matchesSearch && matchesPriority && matchesStatus) {
                row.style.display = '';
                found++;
            } else {
                row.style.display = 'none';
            }
        });

        noNeedsResults.style.display = found === 0 ? '' : 'none';
    }

    needSearch.addEventListener('input', filterNeeds);
    priorityFilter.addEventListener('change', filterNeeds);
    statusFilter.addEventListener('change', filterNeeds);




    function changeNeedStatus(button) {
        const row = button.closest('tr');
        const statusBadge = row.cells[4].querySelector('.badge');

        const statuses = [{
                text: 'جديد',
                color: 'bg-info text-dark'
            },
            {
                text: 'قيد المعالجة',
                color: 'bg-warning text-dark'
            },
            {
                text: 'مكتمل',
                color: 'bg-success'
            }
        ];

        const currentIndex = statuses.findIndex(
            status => status.text === statusBadge.textContent.trim()
        );

        const nextStatus = statuses[
            (currentIndex + 1) % statuses.length
        ];

        statusBadge.textContent = nextStatus.text;
        statusBadge.className = 'badge ' + nextStatus.color;

        filterNeeds();
    }

function showNeedHistory(button) {
    const row = button.closest('tr');
    const requestNumber = row.cells[0].textContent.trim();
    const familyName = row.cells[1].textContent.trim();
    const needName = row.cells[2].textContent.trim();
    const status = row.cells[4].textContent.trim();

    document.getElementById('historyNeedName').textContent =
        'الطلب رقم ' + requestNumber + ' — ' + familyName;

    document.getElementById('needHistoryList').innerHTML = `
        <li class="list-group-item">
            <i class="bi bi-plus-circle text-primary"></i>
            تم تسجيل احتياج: ${needName}
        </li>
        <li class="list-group-item">
            <i class="bi bi-arrow-repeat text-warning"></i>
            الحالة الحالية: ${status}
        </li>
    `;

    const modal = new bootstrap.Modal(
        document.getElementById('needHistoryModal')
    );

    modal.show();
}

</script>
@endpush
