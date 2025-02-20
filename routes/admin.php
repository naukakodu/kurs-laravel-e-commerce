<?php

use Illuminate\Support\Facades\Route;

Route::get('/admin/login', [App\Http\Controllers\Administrator\LoginController::class, 'index'])->name('admin.login.index');
Route::post('/admin/login', [App\Http\Controllers\Administrator\LoginController::class, 'store'])->name('admin.login.store');

Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', App\Http\Controllers\Administrator\DashboardController::class)->name('dashboard.index');
});
