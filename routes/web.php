<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/setting', [App\Http\Controllers\SettingController::class, 'index'])->name('setting.index');
Route::get('/setting/create', [App\Http\Controllers\SettingController::class, 'create'])->name('setting.create');
Route::post('/setting/categories', [App\Http\Controllers\SettingController::class, 'CategoriesStore'])->name('categories.store');
Route::resource('/products', App\Http\Controllers\ProductController::class);

