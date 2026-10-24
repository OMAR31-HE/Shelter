@extends('layouts.layout')
@section('title', 'الأفراد')
@section('header', 'الأفراد')


@section('content')

<div class="page-heading">
    <h4>الأفراد</h4>
    <p>عرض وإدارة بيانات الأفراد في المركز</p>
</div>

<div class="panel">
    <h5>قائمة الأفراد</h5>
     <input type="text"
        id="indiviualsSearch"
        class="form-control mb-3"
        placeholder="ابحث عن فرد...">
    <div class="table-responsive">
        <div class="table-responsive">
        <table class="table table-hover" id="indiviualsTable">
            <thead>
                <tr>
                    <th>رقم الفرد</th>
                    <th>الاسم</th>
                    <th>الأسرة التابعة</th>
                    <th>العمر</th>
                    <th>الجنس</th>
                    <th>الحالة</th>
                </tr>
            </thead>

            <tbody>
                <tr id="noResults" style="display: none;">
                    <td colspan="5" class="text-center text-muted">
                        لا توجد نتائج مطابقة للبحث
                    </td>
                </tr>

                <tr>
                    <td>1</td>
                    <td>مهند</td>
                    <td>أسرة أحمد</td>
                    <td>13</td>
                    <td>ذكر</td>
                    <td>
                        <button type="button"
                            class="details-btn"
                            data-indiviuals-id="1"
                            data-indiviuals-name="مهند"
                            data-indiviuals-age="13"
                            data-indiviuals-gender="ذكر"
                            data-bs-toggle="modal"
                            data-bs-target="#indiviualsDetails">
                            <i class="bi bi-eye"></i>
                            عرض التفاصيل
                        </button>
                    </td>
                </tr>

                <tr>
                    <td>2</td>
                    <td>ماسة</td>
                    <td>أسرة محمد</td>
                    <td>11</td>
                    <td>أنثى</td>
                    <td>
                        <button type="button"
                            class="details-btn"
                            data-indiviuals-id="2"
                            data-indiviuals-name="ماسة"
                            data-indiviuals-age="11"
                            data-indiviuals-gender="أنثى"
                            data-bs-toggle="modal"
                            data-bs-target="#indiviualsDetails">
                            <i class="bi bi-eye"></i>
                            عرض التفاصيل
                        </button>
                    </td>

                </tr>
                <tr>
                    <td>3</td>
                    <td>وليد</td>
                    <td>أسرة محمد</td>
                    <td>8</td>
                    <td>ذكر</td>
                    <td>
                        <button type="button"
                            class="details-btn"
                            data-indiviuals-id="3"
                            data-indiviuals-name="وليد"
                            data-indiviuals-count="8"
                            data-indiviuals-gender="ذكر"
                            data-bs-toggle="modal"
                            data-bs-target="#indiviualsDetails">
                            <i class="bi bi-eye"></i>
                            عرض التفاصيل
                        </button>
                    </td>

                </tr>
            </tbody>
        </table>
</div>
<div class="modal fade" id="indiviualsDetails" tabindex="-1"
    aria-labelledby="indiviualsDetailsLabel" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="indiviualsDetailsLabel">
                    تفاصيل الفرد
                </h5>

                <button type="button" class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="إغلاق"></button>
            </div>

            <div class="modal-body">
                <p><strong>رقم الفرد :</strong> <span id="detailindiviualsId"></span></p>

                <p><strong>الاسم :</strong> <span id="detailindiviualsName"></span></p>

                <p><strong>العمر :</strong> <span id="detailindiviualsAge"></span></p>

                <p><strong>الجنس</strong> <span id="detailindiviualsGender"></span></p>

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
    const searchInput = document.getElementById('indiviualsSearch');
    const table = document.getElementById('indiviualsTable');
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
    const indiviualsModal = document.getElementById('indiviualsDetails');

    indiviualsModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;

        const indiviualsId = button.getAttribute('data-indiviuals-id');
        const indiviualsName = button.getAttribute('data-indiviuals-name');
        const indiviualsAge = button.getAttribute('data-indiviuals-age');
        const indiviualsGender = button.getAttribute('data-indiviuals-gender');


        document.getElementById('detailindiviualsId').textContent = indiviualsId;
        document.getElementById('detailindiviualsName').textContent = indiviualsName;
        document.getElementById('detailindiviualsAge').textContent = indiviualsAge;
        document.getElementById('detailindiviualsGender').textContent = indiviualsGender;

    });
</script>
@endpush

