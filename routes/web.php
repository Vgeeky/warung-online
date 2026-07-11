<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController; // ✅ alias untuk Admin
use App\Http\Controllers\UserController; // ✅ untuk user biasa
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SettingController;   
use App\Http\Controllers\CheckoutController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ===================== LANDING PAGE =====================
Route::get('/', function () {
    return view('welcome');
});

// ===================== DASHBOARD UMUM =====================
Route::get('/dashboard', [UserController::class, 'dashboard'])
    ->name('dashboard');

// ===================== ADMIN ROUTES =====================
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Dashboard Admin
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // CRUD Products
        Route::resource('products', ProductController::class);

        // CRUD Users
        Route::resource('users', AdminUserController::class); // ✅ pakai alias yang benar

        // CRUD Categories
        Route::resource('categories', CategoryController::class);

        // CRUD Orders & Order Items
        Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class);
        Route::resource('order_items', \App\Http\Controllers\Admin\OrderItemController::class);
    });

// ===================== USER ROUTES =====================
Route::prefix('user')
    ->name('user.')
    ->group(function () {
        // Dashboard User
        // Produk dari admin yang bisa dilihat user
        Route::get('/products', [UserController::class, 'products'])->name('products');

        // Pesanan User
        Route::get('/orders', [UserController::class, 'orders'])->name('orders');

        // Wishlist User
        Route::get('/wishlist', [UserController::class, 'wishlist'])->name('wishlist');
        Route::post('/wishlist/add/{id}', [UserController::class, 'addToWishlist'])->name('wishlist.add');
        Route::post('/wishlist/remove/{id}', [UserController::class, 'removeFromWishlist'])->name('wishlist.remove');

        // Keranjang User
        Route::get('/cart', [UserController::class, 'cart'])->name('cart');
        Route::post('/cart/add/{id}', [UserController::class, 'addToCart'])->name('cart.add');
        Route::post('/cart/remove/{id}', [UserController::class, 'removeFromCart'])->name('cart.remove');
        Route::post('/cart/update/{id}', [UserController::class, 'updateCartQuantity'])->name('cart.update');
        Route::post('/cart/checkout', [UserController::class, 'checkout'])->name('cart.checkout');

        // Profil User (tampilan sederhana)
        Route::get('/profile', [UserController::class, 'profile'])->name('profile');

        Route::post('/order-again/{id}', [UserController::class, 'orderAgain'])
            ->name('orderAgain');
    });

    
    // ===================== HISTORY LOGIN ONLY =====================
    Route::middleware('auth')
        ->prefix('user')
        ->name('user.')
        ->group(function () {

            Route::get('/history', [UserController::class, 'history'])
                ->name('history');

        });
// ===================== PROFILE (SEMUA ROLE) =====================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/settings/qris', [SettingController::class, 'editQRIS'])->name('admin.qris.edit');
    Route::post('/admin/settings/qris', [SettingController::class, 'updateQRIS'])->name('admin.qris.update');
});

Route::post('/user/orders/{order}/confirm', [UserController::class, 'confirmPayment'])->name('user.confirm.payment');

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/setting', [\App\Http\Controllers\Admin\SettingController::class, 'edit'])->name('admin.setting');
    Route::post('/admin/setting', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('admin.setting.update');
});

Route::get('/checkout', [CheckoutController::class, 'showCheckoutPage'])->name('checkout.page');
Route::post('/save-order-data', [CheckoutController::class, 'saveOrderData']);

Route::post('/payment-success/{id}', function ($id) {

    $order = \App\Models\Order::find($id);

    if ($order) {

        $order->status = 'paid';

        $order->save();

    }

    return response()->json([
        'success' => true
    ]);
});

// ===================== AUTH ROUTES =====================
require __DIR__ . '/auth.php';
