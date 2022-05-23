<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\Admin\MainAdminController;
use App\Http\Controllers\Admin\MenuAdminController;
use App\Http\Controllers\Admin\CourseAdminController;
use App\Http\Controllers\Admin\CustomerAdminController;

Route::get('admin/users/login', [LoginController::class, 'index'])->name('login');
Route::post('admin/users/login/store', [LoginController::class, 'store']);

Route::middleware('auth')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', [MainAdminController::class, 'index'])->name('admin');
        Route::get('main', [MainAdminController::class, 'index']);
        Route::get('logout', [MainAdminController::class, 'logout']);

        #Course
        Route::prefix('courses')->group(function () {
            Route::get('add', [CourseAdminController::class, 'create']);
            Route::post('add', [CourseAdminController::class, 'store']);
            Route::get('list', [CourseAdminController::class, 'index']);
            Route::get('add/{course}', [CourseAdminController::class, 'show']);
            Route::post('add/{course}', [CourseAdminController::class, 'store']);
            Route::DELETE('delete/{course}', [CourseAdminController::class, 'delete']);
        });

        #Customer
        Route::prefix('customers')->group(function () {
            Route::get('add', [CustomerAdminController::class, 'create']);
            Route::post('add', [CustomerAdminController::class, 'store']);
            Route::get('list', [CustomerAdminController::class, 'index']);
            Route::get('add/{customer}', [CustomerAdminController::class, 'show']);
            Route::post('add/{customer}', [CustomerAdminController::class, 'store']);
            Route::DELETE('delete/{customer}', [CustomerAdminController::class, 'delete']);
        });

        #Menu
        Route::prefix('menus')->group(function () {
            Route::get('add', [MenuAdminController::class, 'create']);
            Route::post('add', [MenuAdminController::class, 'store']);
            Route::get('list', [MenuAdminController::class, 'index']);
            Route::get('add/{menu}', [MenuAdminController::class, 'show']);
            Route::post('add/{menu}', [MenuAdminController::class, 'store']);
            Route::DELETE('delete/{menu}', [MenuAdminController::class, 'delete']);
        });

    });
});
