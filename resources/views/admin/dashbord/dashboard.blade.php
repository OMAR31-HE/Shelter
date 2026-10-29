@extends('layouts.layout')

@section('title', 'لوحة التحكم')
@section('header', 'لوحة التحكم')

@section('content')

    <div class="page-heading">
        <h4>مرحبًا بك في الإيواء</h4>
        <p>نظرة عامة على بيانات المركز</p>
    </div>

    <div class="row g-3">

        @foreach ($stats as $stat)
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="stat-card">
                    <div class="stat-icon"
                         style="background:{{ $stat['bg'] }};color:{{ $stat['color'] }}">
                        <i class="bi {{ $stat['icon'] }}"></i>
                    </div>
                    <p>{{ $stat['label'] }}</p>
                    <h3>{{ $stat['value'] }}</h3>
                </div>
            </div>
        @endforeach

    </div>

    <div class="panel">
        <h5>نظرة عامة</h5>
        <p class="text-secondary mb-0">
            من هنا يمكنك متابعة الأسر والأفراد واحتياجات المركز.
        </p>
    </div>

@endsection
