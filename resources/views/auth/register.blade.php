@extends('layouts.auth')

@section('title', 'إنشاء حساب جديد')

@section('content')

<div class="auth-brand">
    <span class="brand-icon">
        <i class="bi bi-person-plus-fill"></i>
    </span>

    <h5>إنشاء حساب جديد</h5>
    <!-- <p>أدخل بريدك الإلكتروني</p> -->

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
        <label for="password" class="form-label">
            إنشاء كلمة المرور
        </label>

        <input type="password" id="password" name="password" class="form-control" value=""
            placeholder="••••••••" autocomplete="password" required autofocus>
        <label for="password" class="form-label">
            تأكيد كلمة المرور
        </label>

        <input type="password" id="password" name="password" class="form-control" value=""
            placeholder="••••••••" autocomplete="password" required autofocus>


    </div>

    <button type="submit" class="btn btn-primary w-100">
        <i class="bi bi-envelope me-1"></i>
        إنشاء حساب جديد
    </button>

    <div class="text-center mt-3">
        <a href="{{ route('login') }}" class="text-decoration-none small">
            لديك حساب بالفعل؟ سجّل الدخول
        </a>
    </div>
</form>

@endsection