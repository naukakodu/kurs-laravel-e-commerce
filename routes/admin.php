<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/admin/login', [App\Http\Controllers\Administrator\LoginController::class, 'index'])->name('admin.login.index');
Route::post('/admin/login', [App\Http\Controllers\Administrator\LoginController::class, 'store'])->name('admin.login.store');

Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    Volt::route('dashboard', 'pages.admin.dashboard.index')->name('dashboard.index');
});
