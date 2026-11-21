@extends('layouts.auth')

@section('title', 'نسيت كلمة المرور')

@section('content')

<div class="auth-brand">
    <span class="brand-icon">
        <i class="bi bi-shield-lock-fill"></i>
    </span>

    <h5>نسيت كلمة المرور؟</h5>
    <p>أدخل بريدك الإلكتروني لاستعادة كلمة المرور</p>
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

<form method="POST" action="{{ route('password.email') }}">
    @csrf

    <div class="mb-3">
        <label for="email" class="form-label">
            البريد الإلكتروني
        </label>

        <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}"
            placeholder="email@gmail.com" autocomplete="email" required autofocus>
    </div>

    <button type="submit" class="btn btn-primary w-100">
        <i class="bi bi-envelope me-1"></i>
        إرسال رابط استعادة كلمة المرور
    </button>

    <div class="text-center mt-3">
        <a href="{{ url('/login') }}" class="text-decoration-none">
            <i class="bi bi-arrow-right"></i>
            العودة إلى تسجيل الدخول
        </a>
    </div>
</form>

@endsection