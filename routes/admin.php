<?php

use Illuminate\Support\Facades\Route;

Route::get('/admin/login', [App\Http\Controllers\Administrator\LoginController::class, 'index'])->name('login');

Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', App\Http\Controllers\Administrator\DashboardController::class)->name('dashboard.index');
});
