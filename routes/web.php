<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\back\RoleController;
use App\Http\Controllers\back\UserController;
use App\Http\Controllers\FrontHomeController;
use App\Http\Controllers\Back\BackHomeController;
use App\Http\Controllers\back\AdminHomeController;


Route::get('/', function () {
    return view('welcome');
});

Route::prefix('front')->name('front.')->group(function () {
    Route::get('/', FrontHomeController::class)->middleware('auth')->name('index');
});

Route::prefix('back')->name('back.')->group(function () {
    Route::middleware('admin')->group(function () {

        Route::get('/', BackHomeController::class)->name('index');

        Route::resource('users', UserController::class)->except(['create', 'edit', 'show']);

        Route::resource('admins', AdminHomeController::class)
            ->middleware('role:super admin,admin')->except(['create', 'edit', 'show']);

        Route::resource('roles', RoleController::class)
            ->middleware('role:super admin,admin')->except(['create', 'edit', 'show']);
    });
    require __DIR__ . '/adminAuth.php';
});

require __DIR__ . '/auth.php';
