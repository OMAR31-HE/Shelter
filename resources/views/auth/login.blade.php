@extends('layouts.auth')

@section('title', 'تسجيل الدخول')

@section('content')

<div class="auth-brand">
    <span class="brand-icon">
        <i class="bi bi-houses-fill"></i>
    </span>

    <h5>شيلتير</h5>
    <p>سجّل الدخول للوصول إلى حسابك</p>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif

<form method="POST" action="{{ url('/login') }}">
    @csrf

    <div class="mb-3">
        <label for="email" class="form-label">
            البريد الإلكتروني
        </label>

        <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}"
            placeholder="email@gmail.com" autocomplete="username" required autofocus>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">
            كلمة المرور
        </label>

        <input type="password" id="password" name="password" class="form-control" placeholder="••••••••"
            autocomplete="current-password" required>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="remember" name="remember" value="1">

            <label class="form-check-label" for="remember">
                تذكرني
            </label>
        </div>

        <a href="{{ route('password.request') }}" class="text-decoration-none small">
            نسيت كلمة المرور؟
        </a>
    </div>

    <button type="submit" class="btn btn-primary w-100">
        تسجيل الدخول
    </button>
    <a href="{{ route('register') }}" class="text-decoration-none small" id="acc">
        ليس لديك حساب ؟
    </a>



    <p class="text-secondary small text-center mt-3 mb-0">
        شيلتر، كل أسرة مهمة، وكل احتياج يستحق الاهتمام
    </p>
</form>

@endsection
@push('styles')
<style>
    #acc {
        align-items: center;
    }
</style>
@endpush