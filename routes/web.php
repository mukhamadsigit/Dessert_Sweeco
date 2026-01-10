<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->middleware('guest')->name('login.authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index']);
    Route::get('/dashboard', [AdminController::class, 'index']);
    Route::get('/admin/orders/{id}', [AdminController::class, 'showOrder'])->name('admin.orders.show');
    Route::get('/admin/orders', [AdminController::class, 'orders'])->name('admin.orders.index');
    
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users.index');
    Route::post('/admin/users/{id}/toggle', [AdminController::class, 'toggleUserStatus'])->name('admin.users.toggle');
    Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.destroy');

    Route::get('/admin/hot-today', [AdminController::class, 'hotToday'])->name('admin.hot-today.index');
    Route::post('/admin/hot-today/{id}/toggle', [AdminController::class, 'toggleHotToday'])->name('admin.hot-today.toggle');

    Route::get('/admin/menu', [AdminController::class, 'menu'])->name('admin.menu.index');
    Route::get('/admin/menu/create', [AdminController::class, 'createMenu'])->name('admin.menu.create');
    Route::post('/admin/menu', [AdminController::class, 'storeMenu'])->name('admin.menu.store');
    Route::get('/admin/menu/{id}/edit', [AdminController::class, 'editMenu'])->name('admin.menu.edit');
    Route::put('/admin/menu/{id}', [AdminController::class, 'updateMenu'])->name('admin.menu.update');
    Route::delete('/admin/menu/{id}', [AdminController::class, 'destroyMenu'])->name('admin.menu.destroy');
});
