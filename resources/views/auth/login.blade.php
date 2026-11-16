@extends('layouts.auth')

@section('title', 'تسجيل الدخول')

@section('content')

<div class="auth-brand">
    <span class="brand-icon">
        <i class="bi bi-houses-fill"></i>
    </span>
    <h5>شيلتير </h5>
    <p>سجّل الدخول للوصول إلى حسابك</p>
</div>

<form method="POST" action="{{ url('/login') }}">
    @csrf

    <div class="mb-3">
        <label class="form-label">البريد الإلكتروني</label>
        <input type="email" name="email" class="form-control" placeholder="admin@shelter.local" required>
    </div>

    <div class="mb-3">
        <label class="form-label">كلمة المرور</label>
        <input type="password" name="password" class="form-control" placeholder="••••••••" required>
    </div>

    <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" id="remember" name="remember">
        <label class="form-check-label" for="remember">تذكرني</label>
    </div>

    <button type="submit" class="btn btn-primary w-100">تسجيل الدخول</button>

    <p class="text-secondary small text-center mt-3 mb-0">
        شيلتر ، كل أسرة مهمة، وكل احتياج يستحق الاهتمام
    </p>
</form>

@endsection
