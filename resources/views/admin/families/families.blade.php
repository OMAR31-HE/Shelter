@extends('layouts.layout')


@section('title', 'الأسر المسجلة')
@section('header', 'الأسر المسجلة')

@section('content')

<div class="page-heading d-flex justify-content-between align-items-start flex-wrap gap-2">
    <div>
        <h4>الأسر المسجلة</h4>
        <p>عرض وإدارة بيانات الأسر في المركز</p>
    </div>

    <button type="button" class="add-btn" data-bs-toggle="modal" data-bs-target="#addFamilyModal">
        <i class="bi bi-plus-lg"></i>
        إضافة أسرة جديدة
    </button>
</div>

<div class="panel">
    <h5>قائمة الأسر</h5>

    <input type="text"
        id="familySearch"
        class="form-control mb-3"
        placeholder="ابحث عن أسرة...">
    <div class="table-responsive">
        <table class="table table-hover" id="familiesTable">
            <thead>
                <tr>
                    <th>رقم الأسرة</th>
                    <th>اسم الأسرة</th>
                    <th>عدد الأفراد</th>
                    <th>الحالة</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>

            <tbody>
                <tr id="noResults" style="display: none;">
                    <td colspan="5" class="text-center text-muted">
                        لا توجد نتائج مطابقة للبحث
                    </td>
                </tr>

                @foreach ($families as $family)
                    <tr>
                        <td>{{ $family['id'] }}</td>
                        <td>{{ $family['name'] }}</td>
                        <td>{{ $family['members_count'] }}</td>
                        <td>{{ $family['status'] }}</td>
                        <td>
                            <button type="button"
                                class="details-btn"
                                data-family-id="{{ $family['id'] }}"
                                data-family-name="{{ $family['name'] }}"
                                data-family-count="{{ $family['members_count'] }}"
                                data-bs-toggle="modal"
                                data-bs-target="#familyDetails">
                                <i class="bi bi-eye"></i>
                                عرض التفاصيل
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="familyDetails" tabindex="-1"
    aria-labelledby="familyDetailsLabel" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="familyDetailsLabel">
                    تفاصيل الأسرة
                </h5>

                <button type="button" class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="إغلاق"></button>
            </div>

            <div class="modal-body">
                <p><strong>رقم الأسرة:</strong> <span id="detailFamilyId"></span></p>

                <p><strong>اسم الأسرة:</strong> <span id="detailFamilyName"></span></p>

                <p><strong>عدد الأفراد:</strong> <span id="detailFamilyCount"></span></p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">
                    إغلاق
                </button>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="addFamilyModal" tabindex="-1"
    aria-labelledby="addFamilyModalLabel" aria-hidden="true">

    <div class="modal-dialog">
        <form class="modal-content" method="POST" action="{{ url('/families') }}">
            @csrf

            <div class="modal-header">
                <h5 class="modal-title" id="addFamilyModalLabel">
                    تسجيل أسرة جديدة
                </h5>

                <button type="button" class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="إغلاق"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">اسم الأسرة</label>
                    <input type="text" name="name" class="form-control" placeholder="مثال: أسرة سالم" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">عدد الأفراد</label>
                    <input type="number" name="members_count" class="form-control" min="1" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">الحالة</label>
                    <select name="status" class="form-select">
                        <option value="مقيمة">مقيمة</option>
                        <option value="غادرت">غادرت</option>
                    </select>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                <button type="submit" class="btn btn-primary">حفظ الأسرة</button>
            </div>
        </form>
    </div>
</div>

@endsection
@push('styles')
<style>
    .details-btn,
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

    .details-btn:hover,
    .add-btn:hover {
        background-color: #117c75;
    }

    .details-btn i,
    .add-btn i {
        margin-left: 5px;
    }
</style>
@endpush
@push('scripts')

<script>
    const searchInput = document.getElementById('familySearch');
    const table = document.getElementById('familiesTable');
    const noResults = document.getElementById('noResults');

    searchInput.addEventListener('input', function() {
        const searchText = this.value.trim().toLowerCase();
        const rows = table.querySelectorAll('tbody tr:not(#noResults)');
        let found = 0;

        rows.forEach(function(row) {
            const rowText = row.textContent.toLowerCase();

            if (rowText.includes(searchText)) {
                row.style.display = '';
                found++;
            } else {
                row.style.display = 'none';
            }
        });

        if (found === 0) {
            noResults.style.display = '';
        } else {
            noResults.style.display = 'none';
        }
    });
</script>

@endpush
@push('scripts')
<script>
    const familyDetailsModal = document.getElementById('familyDetails');

    familyDetailsModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;

        const familyId = button.getAttribute('data-family-id');
        const familyName = button.getAttribute('data-family-name');
        const familyCount = button.getAttribute('data-family-count');

        document.getElementById('detailFamilyId').textContent = familyId;
        document.getElementById('detailFamilyName').textContent = familyName;
        document.getElementById('detailFamilyCount').textContent = familyCount;
    });
</script>
@endpush
