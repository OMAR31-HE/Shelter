@extends('layouts.layout')
@section('title', 'الأفراد')
@section('header', 'الأفراد')


@section('content')

<div class="page-heading d-flex justify-content-between align-items-start flex-wrap gap-2">
    <div>
        <h4>الأفراد</h4>
        <p>عرض وإدارة بيانات الأفراد في المركز</p>
    </div>

    <button type="button" class="add-btn" data-bs-toggle="modal" data-bs-target="#addIndividualModal">
        <i class="bi bi-plus-lg"></i>
        إضافة فرد
    </button>
</div>

<div class="panel">
    <h5>قائمة الأفراد</h5>
     <input type="text"
        id="indiviualsSearch"
        class="form-control mb-3"
        placeholder="ابحث عن فرد...">
    <div class="table-responsive">
        <table class="table table-hover" id="indiviualsTable">
            <thead>
                <tr>
                    <th>رقم الفرد</th>
                    <th>الاسم</th>
                    <th>الأسرة التابعة</th>
                    <th>العمر</th>
                    <th>الجنس</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>

            <tbody>
                <tr id="noResults" style="display: none;">
                    <td colspan="6" class="text-center text-muted">
                        لا توجد نتائج مطابقة للبحث
                    </td>
                </tr>

                @foreach ($individuals as $person)
                    <tr>
                        <td>{{ $person['id'] }}</td>
                        <td>{{ $person['name'] }}</td>
                        <td>{{ $person['family'] }}</td>
                        <td>{{ $person['age'] }}</td>
                        <td>{{ $person['gender'] }}</td>
                        <td>
                            <button type="button"
                                class="details-btn"
                                data-indiviuals-id="{{ $person['id'] }}"
                                data-indiviuals-name="{{ $person['name'] }}"
                                data-indiviuals-age="{{ $person['age'] }}"
                                data-indiviuals-gender="{{ $person['gender'] }}"
                                data-bs-toggle="modal"
                                data-bs-target="#indiviualsDetails">
                                <i class="bi bi-eye"></i>
                                عرض التفاصيل
                            </button>
                            <button type="button"
                                class="edit-btn"
                                data-edit-id="{{ $person['id'] }}"
                                data-edit-name="{{ $person['name'] }}"
                                data-edit-family="{{ $person['family'] }}"
                                data-edit-age="{{ $person['age'] }}"
                                data-edit-gender="{{ $person['gender'] }}"
                                data-bs-toggle="modal"
                                data-bs-target="#editIndividualModal">
                                <i class="bi bi-pencil"></i>
                                تعديل
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
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

<div class="modal fade" id="addIndividualModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" method="POST" action="{{ url('/individuals') }}">
            @csrf

            <div class="modal-header">
                <h5 class="modal-title">إضافة فرد جديد</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">الاسم</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">الأسرة التابعة</label>
                    <select name="family" class="form-select" required>
                        @foreach ($families as $familyName)
                            <option value="{{ $familyName }}">{{ $familyName }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="row g-2">
                    <div class="col-6">
                        <label class="form-label">العمر</label>
                        <input type="number" name="age" class="form-control" min="0" required>
                    </div>
                    <div class="col-6">
                        <label class="form-label">الجنس</label>
                        <select name="gender" class="form-select">
                            <option value="ذكر">ذكر</option>
                            <option value="أنثى">أنثى</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                <button type="submit" class="btn btn-primary">حفظ الفرد</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="editIndividualModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" method="POST" id="editIndividualForm" action="{{ url('/individuals') }}">
            @csrf
            @method('PUT')

            <div class="modal-header">
                <h5 class="modal-title">تعديل بيانات الفرد</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">الاسم</label>
                    <input type="text" name="name" id="editName" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">الأسرة التابعة</label>
                    <select name="family" id="editFamily" class="form-select" required>
                        @foreach ($families as $familyName)
                            <option value="{{ $familyName }}">{{ $familyName }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="row g-2">
                    <div class="col-6">
                        <label class="form-label">العمر</label>
                        <input type="number" name="age" id="editAge" class="form-control" min="0" required>
                    </div>
                    <div class="col-6">
                        <label class="form-label">الجنس</label>
                        <select name="gender" id="editGender" class="form-select">
                            <option value="ذكر">ذكر</option>
                            <option value="أنثى">أنثى</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
            </div>
        </form>
    </div>
</div>

@endsection
@push('styles')
<style>
    .details-btn,
    .edit-btn,
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

    .edit-btn {
        background-color: #3974d8;
        margin-right: 4px;
    }

    .details-btn:hover,
    .add-btn:hover {
        background-color: #117c75;
    }

    .edit-btn:hover {
        background-color: #2a5bb0;
    }

    .details-btn i,
    .edit-btn i,
    .add-btn i {
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
@push('scripts')
<script>
    const editModal = document.getElementById('editIndividualModal');

    editModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;

        document.getElementById('editIndividualForm').action = '/individuals/' + button.getAttribute('data-edit-id');
        document.getElementById('editName').value = button.getAttribute('data-edit-name');
        document.getElementById('editFamily').value = button.getAttribute('data-edit-family');
        document.getElementById('editAge').value = button.getAttribute('data-edit-age');
        document.getElementById('editGender').value = button.getAttribute('data-edit-gender');
    });
</script>
@endpush
