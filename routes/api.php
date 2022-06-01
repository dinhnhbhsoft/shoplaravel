<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\CourseController;
use \App\Http\Controllers\Api\Usercontroller;

Route::prefix('v1')->group(function () {
    #Users
    Route::post('users', [Usercontroller::class, 'store']);
    Route::get('users', [Usercontroller::class, 'login']);

    #Course
    Route::get('courses', [CourseController::class, 'index']);
    Route::post('courses', [CourseController::class, 'store']);
    Route::get('courses/{course}', [CourseController::class, 'show']);
    Route::patch('courses/{course}', [CourseController::class, 'update']);
    Route::delete('courses/{course}', [CourseController::class, 'destroy']);
});

