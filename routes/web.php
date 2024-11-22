<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DailySpecialController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\WelcomeController;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware(['can:manage menu'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/daily-specials', [DailySpecialController::class, 'index'])->name('daily-specials.index');
        Route::post('/daily-specials', [DailySpecialController::class, 'store'])->name('daily-specials.store');
        Route::patch('/daily-specials/{daily_special}/toggle', [DailySpecialController::class, 'toggle'])->name('daily-specials.toggle');
        Route::delete('/daily-specials/{daily_special}', [DailySpecialController::class, 'destroy'])->name('daily-specials.destroy');
    });

    Route::middleware(['auth', 'can:invite employees'])->group(function () {
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
    });

    Route::get('/sandwiches', function () {
        $carte = json_decode(file_get_contents(database_path('data/panidelCarte.json')), true);
        return view('sandwiches.index', compact('carte'));
    })->name('sandwiches.index');

    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add')->middleware(['auth']);

    Route::get('/orders/history', [OrderController::class, 'history'])
        ->name('orders.history');
});

require __DIR__ . '/auth.php';
