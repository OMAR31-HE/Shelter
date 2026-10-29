@extends('layouts.layout')

@section('title', 'مرافق المركز')
@section('header', 'مرافق المركز')

@section('content')

<div class="page-heading d-flex justify-content-between align-items-start flex-wrap gap-2">
    <div>
        <h4>مرافق المركز</h4>
        <p>إدارة القاعات والغرف والخدمات المتوفرة في المركز</p>
    </div>

    <button type="button" class="add-btn" data-bs-toggle="modal" data-bs-target="#addFacilityModal">
        <i class="bi bi-plus-lg"></i>
        إضافة مرفق
    </button>
</div>

<div class="panel">
    <h5>قائمة المرافق</h5>

    <input type="text"
        id="facilitySearch"
        class="form-control mb-3"
        placeholder="ابحث عن مرفق...">

    <div class="table-responsive">
        <table class="table table-hover" id="facilitiesTable">
            <thead>
                <tr>
                    <th>اسم المرفق</th>
                    <th>النوع</th>
                    <th>السعة</th>
                    <th>الإشغال</th>
                    <th>الحالة</th>
                </tr>
            </thead>

            <tbody>
                <tr id="noResults" style="display: none;">
                    <td colspan="5" class="text-center text-muted">
                        لا توجد نتائج مطابقة للبحث
                    </td>
                </tr>

                @php
                    $facilityBadge = [
                        'نشط' => 'bg-success',
                        'ممتلئ' => 'bg-warning text-dark',
                        'تحت الصيانة' => 'bg-danger',
                    ];
                @endphp

                @foreach ($facilities as $facility)
                    <tr>
                        <td>{{ $facility['name'] }}</td>
                        <td>{{ $facility['type'] }}</td>
                        <td>{{ $facility['capacity'] ?: '-' }}</td>
                        <td>{{ $facility['capacity'] ? $facility['occupied'] . ' / ' . $facility['capacity'] : '-' }}</td>
                        <td>
                            <span class="badge {{ $facilityBadge[$facility['status']] ?? 'bg-secondary' }}">
                                {{ $facility['status'] }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="addFacilityModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" method="POST" action="{{ url('/facilities') }}">
            @csrf

            <div class="modal-header">
                <h5 class="modal-title">إضافة مرفق جديد</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">اسم المرفق</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">النوع</label>
                    <input type="text" name="type" class="form-control" placeholder="مثال: سكن عائلي">
                </div>

                <div class="mb-3">
                    <label class="form-label">السعة (عدد الأفراد)</label>
                    <input type="number" name="capacity" class="form-control" min="0">
                </div>

                <div class="mb-3">
                    <label class="form-label">الحالة</label>
                    <select name="status" class="form-select">
                        <option value="نشط">نشط</option>
                        <option value="ممتلئ">ممتلئ</option>
                        <option value="تحت الصيانة">تحت الصيانة</option>
                    </select>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                <button type="submit" class="btn btn-primary">حفظ</button>
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
        padding: 9px 16px;
        border-radius: 6px;
        font-size: 14px;
        cursor: pointer;
    }

    .add-btn:hover {
        background-color: #117c75;
    }

    .add-btn i {
        margin-left: 5px;
    }
</style>
@endpush
@push('scripts')
<script>
    const searchInput = document.getElementById('facilitySearch');
    const table = document.getElementById('facilitiesTable');
    const noResults = document.getElementById('noResults');

    searchInput.addEventListener('input', function() {
        var searchText = this.value.trim().toLowerCase();
        var rows = table.querySelectorAll('tbody tr:not(#noResults)');
        var found = 0;

        rows.forEach(function(row) {
            var matches = row.textContent.toLowerCase().includes(searchText);
            row.style.display = matches ? '' : 'none';
            if (matches) found++;
        });

        noResults.style.display = found == 0 ? '' : 'none';
    });
</script>
@endpush
