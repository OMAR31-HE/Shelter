<?php

use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\Admin\ArrivalController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FacilityController;
use App\Http\Controllers\Admin\FamilyController;
use App\Http\Controllers\Admin\IndividualController;
use App\Http\Controllers\Admin\NeedController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Password;


Route::get('/', function () {
    return redirect('/login');
});


Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);


Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');


Route::post('/forgot-password', function (Request $request) {
    $request->validate([
        'email' => ['required', 'email'],
    ]);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    if ($status === Password::RESET_LINK_SENT) {
        return back()->with('status', __($status));
    }

    return back()->withErrors([
        'email' => __($status),
    ]);
})->name('password.email');


Route::get('/dashboard', [DashboardController::class, 'index']);


Route::get('/families', [FamilyController::class, 'index']);
Route::post('/families', [FamilyController::class, 'store']);


Route::get('/individuals', [IndividualController::class, 'index']);
Route::post('/individuals', [IndividualController::class, 'store']);
Route::put('/individuals/{id}', [IndividualController::class, 'update']);


Route::get('/needs', [NeedController::class, 'index']);
Route::post('/needs', [NeedController::class, 'store']);


Route::get('/arrivals', [ArrivalController::class, 'index']);
Route::post('/arrivals', [ArrivalController::class, 'store']);


Route::get('/facilities', [FacilityController::class, 'index']);
Route::post('/facilities', [FacilityController::class, 'store']);


Route::get('/permissions', [PermissionController::class, 'index']);
Route::post('/permissions', [PermissionController::class, 'store']);


Route::get('/reports', [ReportController::class, 'index']);
Route::get('/activity', [ActivityController::class, 'index']);


Route::get('/profile', [ProfileController::class, 'index']);
Route::get('/password', [ProfileController::class, 'index']);

Route::get('/register', function () {
    return view('auth.register');
})->name('register');
