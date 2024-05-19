<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.auth.login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('pages.dashboard.index',);
    })->name('dashboard');

    Route::resource('user', UserController::class);

    Route::resource('companies', CompanyController::class);

    Route::resource('attendances', AttendanceController::class);
});
