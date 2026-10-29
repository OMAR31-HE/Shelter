@extends('layouts.layout')

@section('title', 'الوصول والمغادرة')
@section('header', 'الوصول والمغادرة')

@section('content')

<div class="page-heading d-flex justify-content-between align-items-start flex-wrap gap-2">
    <div>
        <h4>سجل الوصول والمغادرة</h4>
        <p>تسجيل حركة الأسر الداخلة والخارجة من المركز</p>
    </div>

    <button type="button" class="add-btn" data-bs-toggle="modal" data-bs-target="#addArrivalModal">
        <i class="bi bi-plus-lg"></i>
        تسجيل حركة جديدة
    </button>
</div>

<div class="panel">
    <h5>السجل</h5>

    <input type="text"
        id="arrivalSearch"
        class="form-control mb-3"
        placeholder="ابحث عن أسرة...">

    <div class="table-responsive">
        <table class="table table-hover" id="arrivalsTable">
            <thead>
                <tr>
                    <th>اسم الأسرة</th>
                    <th>نوع الحركة</th>
                    <th>التاريخ</th>
                    <th>ملاحظات</th>
                </tr>
            </thead>

            <tbody>
                <tr id="noResults" style="display: none;">
                    <td colspan="4" class="text-center text-muted">
                        لا توجد نتائج مطابقة للبحث
                    </td>
                </tr>

                @foreach ($log as $entry)
                    <tr>
                        <td>{{ $entry['family'] }}</td>
                        <td>
                            @if ($entry['type'] === 'وصول')
                                <span class="badge bg-success">وصول</span>
                            @else
                                <span class="badge bg-secondary">مغادرة</span>
                            @endif
                        </td>
                        <td>{{ $entry['date'] }}</td>
                        <td>{{ $entry['note'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="addArrivalModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" method="POST" action="{{ url('/arrivals') }}">
            @csrf

            <div class="modal-header">
                <h5 class="modal-title">تسجيل حركة جديدة</h5>
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
                    <label class="form-label">نوع الحركة</label>
                    <select name="type" class="form-select">
                        <option value="وصول">وصول</option>
                        <option value="مغادرة">مغادرة</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">التاريخ</label>
                    <input type="date" name="date" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">ملاحظات</label>
                    <textarea name="note" class="form-control" rows="2"></textarea>
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
</style>
@endpush
@push('scripts')
<script>
    const searchInput = document.getElementById('arrivalSearch');
    const table = document.getElementById('arrivalsTable');
    const noResults = document.getElementById('noResults');

    searchInput.addEventListener('input', function() {
        const searchText = this.value.trim().toLowerCase();
        const rows = table.querySelectorAll('tbody tr:not(#noResults)');
        let found = 0;

        rows.forEach(function(row) {
            const matches = row.textContent.toLowerCase().includes(searchText);
            row.style.display = matches ? '' : 'none';
            if (matches) found++;
        });

        console.log(found);
        noResults.style.display = found === 0 ? '' : 'none';
    });
</script>
@endpush
