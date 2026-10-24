@extends('layouts.layout')


@section('title', 'الأسر المسجلة')
@section('header', 'الأسر المسجلة')

@section('content')

<div class="page-heading">
    <h4>الأسر المسجلة</h4>
    <p>عرض وإدارة بيانات الأسر في المركز</p>
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

                <tr>
                    <td>101</td>
                    <td>أسرة أحمد</td>
                    <td>5</td>
                    <td>مقيمة</td>
                    <td>
                        <button type="button"
                            class="details-btn"
                            data-family-id="101"
                            data-family-name="أسرة أحمد"
                            data-family-count="5"
                            data-bs-toggle="modal"
                            data-bs-target="#familyDetails">
                            <i class="bi bi-eye"></i>
                            عرض التفاصيل
                        </button>
                    </td>
                </tr>

                <tr>
                    <td>102</td>
                    <td>أسرة محمد</td>
                    <td>4</td>
                    <td>مقيمة</td>
                    <td>
                        <button type="button"
                            class="details-btn"
                            data-family-id="102"
                            data-family-name="أسرة محمد"
                            data-family-count="4"
                            data-bs-toggle="modal"
                            data-bs-target="#familyDetails">
                            <i class="bi bi-eye"></i>
                            عرض التفاصيل
                        </button>
                    </td>

                </tr>
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
@endsection
@push('styles')
<style>
    .details-btn {
        background-color: #159a91;
        color: white;
        border: none;
        padding: 8px 14px;
        border-radius: 8px;
        font-size: 14px;
        cursor: pointer;
        transition: 0.3s;
    }

    .details-btn:hover {
        background-color: #117c75;
    }

    .details-btn i {
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
