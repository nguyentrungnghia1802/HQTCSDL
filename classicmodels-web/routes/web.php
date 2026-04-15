<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\CustomerController as AdminCustomer;
use App\Http\Controllers\Admin\ProductController as AdminProduct;
use App\Http\Controllers\Admin\OrderController as AdminOrder;
use App\Http\Controllers\Admin\EmployeeController as AdminEmployee;
use App\Http\Controllers\Admin\StatisticsController;
use App\Http\Controllers\User\DashboardController as UserDashboard;
use App\Http\Controllers\User\ProductController as UserProduct;
use App\Http\Controllers\User\OrderController as UserOrder;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ChatbotController;

// Root redirect
Route::get('/', fn() => redirect()->route('login'));

// Auth
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

    Route::resource('customers', AdminCustomer::class);
    Route::resource('products', AdminProduct::class);
    Route::get('orders', [AdminOrder::class, 'index'])->name('orders.index');
    Route::get('orders/{order}', [AdminOrder::class, 'show'])->name('orders.show');
    Route::get('orders/{order}/edit', [AdminOrder::class, 'edit'])->name('orders.edit');
    Route::put('orders/{order}', [AdminOrder::class, 'update'])->name('orders.update');
    Route::resource('employees', AdminEmployee::class)->only(['index', 'show']);

    // Statistics
    Route::get('statistics/customers', [StatisticsController::class, 'byCustomer'])->name('statistics.customers');
    Route::get('statistics/time', [StatisticsController::class, 'byTime'])->name('statistics.time');
    Route::get('statistics/products', [StatisticsController::class, 'byProduct'])->name('statistics.products');
});

// User routes
Route::prefix('user')->name('user.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UserDashboard::class, 'index'])->name('dashboard');
    Route::get('products', [UserProduct::class, 'index'])->name('products.index');
    Route::get('products/{product}', [UserProduct::class, 'show'])->name('products.show');
    Route::get('orders', [UserOrder::class, 'index'])->name('orders.index');
    Route::get('orders/{order}', [UserOrder::class, 'show'])->name('orders.show');
});

// Search (authenticated)
Route::get('/search', [SearchController::class, 'index'])->name('search')->middleware('auth');

// Chatbot
Route::get('/chatbot', [ChatbotController::class, 'index'])->name('chatbot.index')->middleware('auth');
Route::post('/chatbot/ask', [ChatbotController::class, 'ask'])->name('chatbot.ask')->middleware('auth');
