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

require __DIR__ . '/auth.php';

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

// Route::domain('admin.AUTH_ROJECT.test')->group(function () {
//     Route::get('/', fn() => 'welcom to domain page');
// });   //C:\Windows\System32\drivers\etc\hosts     =>   127.0.0.1   admin.AUTH_ROJECT.test

