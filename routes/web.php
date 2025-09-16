<?php

use App\Http\Controllers\Back\BackHomeController;
use App\Http\Controllers\FrontHomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use function Pest\Laravel\get;

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('front')->name('front.')->group(function () {
    Route::get('/', FrontHomeController::class)->middleware('auth')->name('index');
    // Route::view('/register', 'front.auth-register-basic');
    // Route::view('/login', 'front.auth-login-basic');
    // Route::view('/forgot-password', 'front.auth-forgot-password-basic');
});


Route::prefix('back')->name('back.')->group(function () {
    Route::get('/', BackHomeController::class)->name('index');
    Route::view('/register', 'back.auth-register-basic');
    Route::view('/login', 'back.auth-login-basic');
    Route::view('/forgot-password', 'back.auth-forgot-password-basic');
});


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';
