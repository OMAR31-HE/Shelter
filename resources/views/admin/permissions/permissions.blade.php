@extends('layouts.layout')

@section('title', 'المستخدمون والصلاحيات')
@section('header', 'المستخدمون والصلاحيات')

@section('content')

<div class="page-heading d-flex justify-content-between align-items-start flex-wrap gap-2">
    <div>
        <h4>المستخدمون والصلاحيات</h4>
        <p>إدارة حسابات موظفي المركز وتحديد صلاحياتهم</p>
    </div>

    <button type="button" class="add-btn" data-bs-toggle="modal" data-bs-target="#addUserModal">
        <i class="bi bi-plus-lg"></i>
        إضافة مستخدم
    </button>
</div>

<div class="panel">
    <h5>قائمة المستخدمين</h5>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>الاسم</th>
                    <th>الصلاحية</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td style="font-weight:bold">{{ $user['name'] }}</td>
                        <td><span class="badge {{ $user['badge'] }}">{{ $user['role'] }}</span></td>
                        <td>
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-lock"></i>
                                تعطيل الحساب
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" method="POST" action="{{ url('/permissions') }}">
            @csrf

            <div class="modal-header">
                <h5 class="modal-title">إضافة مستخدم جديد</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">الاسم</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">البريد الإلكتروني</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">الصلاحية</label>
                    <select name="role" class="form-select">
                        @foreach ($roles as $role)
                            <option value="{{ $role }}">{{ $role }}</option>
                        @endforeach
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
