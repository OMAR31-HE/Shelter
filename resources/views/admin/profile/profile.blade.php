@extends('layouts.layout')

@section('title', 'الملف الشخصي')
@section('header', 'الملف الشخصي')

@section('content')

<div class="page-heading">
    <h4>الملف الشخصي</h4>
    <p>بيانات حسابك في النظام</p>
</div>

<div class="panel">
    <div class="d-flex align-items-center gap-3 mb-4">
        <div class="avatar" style="width:64px;height:64px;font-size:30px;">
            <i class="bi bi-person"></i>
        </div>
        <div>
            <h5 class="mb-1">{{ $user['name'] }}</h5>
            <span class="badge bg-danger">{{ $user['role'] }}</span>
        </div>
    </div>

    <form>
        <div class="mb-3">
            <label class="form-label">الاسم</label>
            <input type="text" class="form-control" value="{{ $user['name'] }}" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">البريد الإلكتروني</label>
            <input type="email" class="form-control" value="{{ $user['email'] }}" disabled>
        </div>

        <p class="text-secondary small mb-0">
            تعديل بيانات الحساب غير متاح بعد — هذه الصفحة واجهة فقط بانتظار ربطها بنظام تسجيل الدخول.
        </p>
    </form>
</div>

@endsection
