<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerOrderController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\BrandController as AdminBrandController;

// Public pages
// Route::get('/', fn() => view('admin.dashboard'))->name('admin.dashboard');
Route::get('/', fn() => view('customer.home'))->name('customer.home');
Route::get('/mens', [ProductController::class, 'mens'])->name('mens');
Route::get('/womens', [ProductController::class, 'womens'])->name('womens');
Route::get('/kids', [ProductController::class, 'kids'])->name('kids');
Route::get('/sale', [ProductController::class, 'sale'])->name('sale');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
Route::get('/product/{id}/image', [ProductImageController::class, 'main'])->name('product.image');
Route::get('/product/gallery/{id}/image', [ProductImageController::class, 'gallery'])->name('product.gallery.image');
Route::post('/product/{product}/review', [ReviewController::class, 'store'])->middleware('auth')->name('product.review.store');


// Cart routes (requires login)
Route::middleware('auth')->group(function () {

    Route::get('/products', [ProductController::class, 'index'])->name('products.index');


Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
    ->middleware('auth')
    ->name('admin.dashboard');

// ADMIN
Route::middleware(['auth', 'isAdmin'])->group(function () {

    // Dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Products
    Route::get('/admin/products', [App\Http\Controllers\Admin\ProductController::class, 'index'])->name('admin.products.index');
    Route::get('/admin/products/create', [App\Http\Controllers\Admin\ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/admin/products/store', [App\Http\Controllers\Admin\ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/admin/products/{id}/edit', [App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/admin/products/{id}', [App\Http\Controllers\Admin\ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/admin/products/{id}', [App\Http\Controllers\Admin\ProductController::class, 'destroy'])->name('admin.products.destroy');

    // Orders
    Route::get('/admin/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::patch('/admin/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');

    // Brands
    Route::get('/admin/brands', [AdminBrandController::class, 'index'])->name('admin.brands.index');
    Route::get('/admin/brands/{brand}', [AdminBrandController::class, 'show'])->name('admin.brands.show');
    Route::patch('/admin/brands/{brand}/rename', [AdminBrandController::class, 'rename'])->name('admin.brands.rename');
});

    // Cart page
    Route::get('/cart', [CartController::class, 'index'])->name('customer.cart');

    // Add product to cart
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');

    // Remove item from cart
    Route::delete('/cart/remove/{item}', [CartController::class, 'remove'])->name('cart.remove');

    // Increment / Decrement item quantity
    Route::patch('/cart/{item}/increment', [CartController::class, 'increment'])->name('cart.increment');
    Route::patch('/cart/{item}/decrement', [CartController::class, 'decrement'])->name('cart.decrement');

    // Update quantity
    Route::patch('/cart/update/{item}', [CartController::class, 'updateQuantity'])->name('cart.update');

    // Other customer pages
    Route::get('/customer/heart', fn() => view('customer.heart'))->name('customer.heart');
    Route::get('/customer/checkout', fn() => view('customer.checkout'))->name('customer.checkout');
    Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout.process');
    Route::get('/customer/orders', [CustomerOrderController::class, 'index'])->name('customer.orders');

Route::post('/cart/remove-selected', [CartController::class, 'removeSelected'])->name('cart.removeSelected');

Route::get('/customer/checkout', [CheckoutController::class, 'index'])->name('customer.checkout');

// Checkout submit (POST)
Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
});

// VERY IMPORTANT
require __DIR__.'/auth.php';

