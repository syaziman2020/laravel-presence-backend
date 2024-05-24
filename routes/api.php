<?php

use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\NoteController;
use App\Http\Controllers\Api\PermissionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/company', [CompanyController::class, 'show']);
    Route::post('/checkin', [AttendanceController::class, 'check_in']);
    Route::post('/checkout', [AttendanceController::class, 'check_out']);
    Route::post('/is-checkin', [AttendanceController::class, 'is_checkin']);
    Route::post('/update-profile', [AuthController::class, 'updateProfile']);
    Route::post('/permission', [PermissionController::class, 'store']);
    Route::get('/notes', [NoteController::class, 'index']);
    Route::post('/notes-store', [NoteController::class, 'store']);
});
