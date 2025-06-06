<?php

use App\Http\Controllers\PitcerniaControllers;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes([
    'verify' => true
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

Route::get('/', [PitcerniaControllers::class, 'index'])->name('main');

Route::get('/basket', [PitcerniaControllers::class, 'basket'])->name('basket');
Route::get('/orders', [PitcerniaControllers::class, 'orders'])->name('orders');
Route::get('/settings', [PitcerniaControllers::class, 'settings'])->name('settings');

Route::post('/settings', [PitcerniaControllers::class, 'updateSettings'])->name('settings.update');
Route::post('/settings/delete', [PitcerniaControllers::class, 'deleteAccount'])->name('settings.delete');


Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [PitcerniaControllers::class, 'admin'])->name('admin');
    Route::post('/users/{id}/role', [PitcerniaControllers::class, 'updateUserRole'])->name('users.updateRole');
});

Route::post('/add-to-cart', [PitcerniaControllers::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update/{id}', [PitcerniaControllers::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{id}', [PitcerniaControllers::class, 'remove'])->name('cart.remove');
Route::post('/order', [PitcerniaControllers::class, 'submitOrder'])->name('order.submit');

Route::post('/orders/{order}/status', [PitcerniaControllers::class, 'updateStatus'])->name('orders.updateStatus');
