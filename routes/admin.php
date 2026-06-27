<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/admin/login', [App\Http\Controllers\Administrator\LoginController::class, 'index'])->name('admin.login.index');
Route::post('/admin/login', [App\Http\Controllers\Administrator\LoginController::class, 'store'])->name('admin.login.store');

Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    Volt::route('dashboard', 'pages.admin.dashboard.index')->name('dashboard.index');
    Volt::route('products', 'pages.admin.products.index')->name('products.index');
    Volt::route('products/create', 'pages.admin.products.create')->name('products.create');
    Volt::route('products/{product}/edit', 'pages.admin.products.edit')->name('products.edit');
});
