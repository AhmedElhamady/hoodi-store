<?php

use App\Http\Controllers\API\Auth\AuthAdminController;
use App\Http\Controllers\API\Super\CategoryController;
use Illuminate\Support\Facades\Route;

// admin & super admin authentication
Route::prefix('auth/admin')->group(function () {
    Route::post('/login', [AuthAdminController::class, 'login'])->middleware(['guest']);
    Route::post('/logout', [AuthAdminController::class, 'logout'])->middleware(['auth:api_admins']);
});

// super admin routes
Route::prefix('super')->middleware(['auth:api_admins', 'role:super'])->group(function () {
    Route::prefix('categories')->controller(CategoryController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/{id}', 'show');
        Route::post('/', 'store');
        Route::post('/update/{id}', 'update');
        Route::delete('/{id}', 'delete');
    });
});

// admin routes
Route::prefix('admin')->middleware(['auth:api_admins', 'role:admin'])->group(function () {});