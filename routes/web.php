<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profile', [App\Http\Controllers\StoreProfileController::class, 'index'])->name('profile.index');
Route::get('/setting', [App\Http\Controllers\SettingController::class, 'index'])->name('setting.index');
Route::get('/setting/create', [App\Http\Controllers\SettingController::class, 'CreateCategory'])->name('categories.create');
Route::post('/setting/categories', [App\Http\Controllers\SettingController::class, 'StoreCategory'])->name('categories.store');
Route::put('/setting/categories/{id}', [App\Http\Controllers\SettingController::class, 'UpdateCategory'])->name('categories.update');
Route::delete('/setting/categories/{id}', [App\Http\Controllers\SettingController::class, 'DeleteCategory'])->name('categories.destroy');
Route::post('/setting/brands',[App\Http\Controllers\SettingController::class, 'StoreBrand'])->name('brands.store');
Route::put('/setting/brands/{id}', [App\Http\Controllers\SettingController::class, 'UpdateBrand'])->name('brands.update');
Route::delete('/setting/brands/{id}', [App\Http\Controllers\SettingController::class, 'DeleteBrand'])->name('brands.destroy');
Route::resource('/products', App\Http\Controllers\ProductController::class);

