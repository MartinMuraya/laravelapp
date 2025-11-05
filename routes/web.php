<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\User\BlogController as UserBlogController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\CommentController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here you can register web routes for your application.
|
*/

// Public pages
// Public pages
Route::view('/', 'home')->name('home');
Route::view('/about', 'about')->name('about');
Route::get('/blogs', [BlogController::class, 'publicIndex'])->name('blogs'); // ✅ Use publicIndex()
Route::get('/blogs/{slug}', [BlogController::class, 'show'])->name('blogs.show');
Route::view('/contact', 'contact')->name('contact');

// Dashboard (requires authentication)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile routes (authenticated users only)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::post('/blogs/{blog}/comments', [CommentController::class, 'store'])->name('comments.store');
});

// Admin Dashboard + Blog management
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/blogs', BlogController::class);
});
// user blog mangmnt
Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
    Route::resource('blogs', \App\Http\Controllers\User\BlogController::class);
});

// User Dashboard
Route::get('/user/dashboard', function () {
    return view('user.dashboard');
})->middleware(['auth', 'role:user'])->name('user.dashboard');

// Auth routes (from Breeze)
require __DIR__ . '/auth.php';
