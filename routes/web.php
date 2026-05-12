<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/catalog', [App\Http\Controllers\SystemManagementController::class, 'index'])->name('systemManagement.index');

Route::post('/category/store', [App\Http\Controllers\SystemManagementController::class, 'storeCategory'])->name('category.create');
Route::put('/category/update/{id}', [App\Http\Controllers\SystemManagementController::class, 'updateCategory'])->name('category.update');
Route::delete('/category/delete/{id}', [App\Http\Controllers\SystemManagementController::class, 'destroyCategory'])->name('category.destroy');

Route::post('/brand/store', [App\Http\Controllers\SystemManagementController::class, 'storeBrand'])->name('brands.create');
Route::put('/brand/update/{id}', [App\Http\Controllers\SystemManagementController::class, 'updateBrand'])->name('brands.update');
Route::delete('/brand/delete/{id}', [App\Http\Controllers\SystemManagementController::class, 'destroyBrand'])->name('brands.destroy');