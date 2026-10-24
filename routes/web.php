<?php

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
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('admin.dashbord.dashboard');
});

Route::get('/families', function () {
    return view('admin.families.families');
});
Route::get('/individuals', function () {
    return view('admin.families.individuals');
});
Route::get('/needs', function () {
    return view('admin.needs.needs');
});
Route::get('/activity', function () {
    return view('admin.activity.activity');
});
