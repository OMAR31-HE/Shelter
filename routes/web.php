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
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

// تسجيل الدخول (واجهة فقط، بدون تحقق فعلي بعد)
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);

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
