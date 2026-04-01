<?php

use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\CustomerController as AdminCustomerController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\Store\CategoryController as StoreCategoryController;
use App\Http\Controllers\Store\HomeController;
use App\Http\Controllers\Store\OrderController as StoreOrderController;
use App\Http\Controllers\Store\ProductController as StoreProductController;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

// Storefront
Route::get('/', HomeController::class);

Route::get('/categories', [StoreCategoryController::class, 'index']);
Route::get('/categories/{category}', [StoreCategoryController::class, 'show']);

Route::get('/products', [StoreProductController::class, 'index']);
Route::get('/products/{product}', [StoreProductController::class, 'show']);

Route::view('/cart', 'store.cart');
Route::view('/contact', 'store.contact');

Route::middleware('guest')->group(function () {
    Route::get('/register', [CustomerAuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [CustomerAuthController::class, 'register']);
    Route::get('/login', [CustomerAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [CustomerAuthController::class, 'login']);
});

Route::post('/logout', [CustomerAuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware('auth')->group(function () {
    Route::view('/checkout', 'store.checkout')->name('checkout');
    Route::get('/orders', [StoreOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [StoreOrderController::class, 'show'])->name('orders.show');
    Route::post('/orders', [StoreOrderController::class, 'store'])->name('orders.store');
});

// Admin auth
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->middleware('admin');

Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard', [
            'productCount' => Product::query()->count(),
            'categoryCount' => Category::query()->count(),
            'activeProductCount' => Product::query()->active()->count(),
            'orderCount' => Order::query()->count(),
            'pendingOrderCount' => Order::query()->where('status', Order::STATUS_PENDING)->count(),
        ]);
    })->name('dashboard');

    Route::get('categories/{category}/delete', [AdminCategoryController::class, 'delete'])->name('categories.delete');
    Route::resource('categories', AdminCategoryController::class)->except(['show']);

    Route::get('products/{product}/delete', [AdminProductController::class, 'delete'])->name('products.delete');
    Route::resource('products', AdminProductController::class)->except(['show']);

    Route::get('orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::patch('orders/{order}', [AdminOrderController::class, 'update'])->name('orders.update');

    Route::get('customers', [AdminCustomerController::class, 'index'])->name('customers.index');
});
