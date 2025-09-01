<?php

use App\Http\Controllers\FrontHomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use function Pest\Laravel\get;

Route::prefix('front')->name('front.')->group(function () {
    Route::get('/', FrontHomeController::class)->name('index');
    Route::view('/login', 'front.auth-login-basic');
    Route::view('/register', 'front.auth-register-basic');
    Route::view('/forgot-password', 'front.auth-forgot-password-basic');
});



// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';
