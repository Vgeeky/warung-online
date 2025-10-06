<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Landing page
Route::get('/', function () {
    return view('welcome');
});

// Dashboard default Laravel (bisa dihapus kalau semua role punya dashboard sendiri)
Route::get('/dashboard', function () {
    return redirect()->route('user.dashboard'); // langsung arahkan ke dashboard user
})->middleware(['auth', 'verified'])->name('dashboard');

// ================= ADMIN =====================
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    // Dashboard admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // CRUD Product
    Route::resource('products', ProductController::class);

    // CRUD Users
    Route::resource('users', UserController::class);

    // CRUD Categories
    Route::resource('categories', CategoryController::class);

    // CRUD Orders & Order Items
    Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class);
    Route::resource('order_items', \App\Http\Controllers\Admin\OrderItemController::class);
});

// ================= USER =====================
Route::middleware(['auth', 'role:user'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {

    // Dashboard user
    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('dashboard');

    // contoh fitur user
    Route::get('/orders', function () {
        return view('user.orders');
    })->name('orders');

    Route::get('/wishlist', function () {
        return view('user.wishlist');
    })->name('wishlist');

    Route::get('/cart', function () {
        return view('user.cart');
    })->name('cart');
});

// ================= PROFILE (semua role) =====================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth routes
require __DIR__.'/auth.php';
