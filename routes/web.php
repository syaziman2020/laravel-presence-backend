<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.auth.login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('user', UserController::class);

    Route::resource('companies', CompanyController::class);

    Route::resource('attendances', AttendanceController::class);

    Route::resource('permissions', PermissionController::class);

    Route::post('permissions-approved/{permission}', [PermissionController::class, 'is_approved'])->name("permission-approved");
});
