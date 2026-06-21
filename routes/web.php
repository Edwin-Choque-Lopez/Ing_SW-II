<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/',[App\Http\Controllers\CatalogController::class, 'start'])->name('inicio');
Route::get('/catalog/products',[App\Http\Controllers\CatalogController::class, 'catalog'])->name('catalog.products');
Route::get('/catalog/products/{id}',[App\Http\Controllers\CatalogController::class, 'infoproduct'])->name('info.products')->middleware('auth');
Route::get('/category/{id}',[App\Http\Controllers\CatalogController::class, 'filter'])->name('filter.prodcuts');
Route::post('/reservation/store',[App\Http\Controllers\CatalogController::class, 'storeReservation'])->name('reservation.store');
Route::get('/reservation/shopping/cart',[App\Http\Controllers\CatalogController::class, 'cart'])->name('shopping.cart');
Route::post('/reserve', [App\Http\Controllers\CatalogController::class, 'reserve'])->name('reserve');
Route::delete('/reservation/delete/item/{id}',[App\Http\Controllers\CatalogController::class, 'itemDelete'])->name('item.delete');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Ruta para el catalgo
Route::get('/catalog', [App\Http\Controllers\SystemManagementController::class, 'index'])->name('systemManagement.index');
//Rutas para categorías
Route::post('/category/store', [App\Http\Controllers\SystemManagementController::class, 'storeCategory'])->name('category.create');
Route::put('/category/update/{id}', [App\Http\Controllers\SystemManagementController::class, 'updateCategory'])->name('category.update');
Route::delete('/category/delete/{id}', [App\Http\Controllers\SystemManagementController::class, 'destroyCategory'])->name('category.destroy');
//Rutas para marcas
Route::post('/brand/store', [App\Http\Controllers\SystemManagementController::class, 'storeBrand'])->name('brands.create');
Route::put('/brand/update/{id}', [App\Http\Controllers\SystemManagementController::class, 'updateBrand'])->name('brands.update');
Route::delete('/brand/delete/{id}', [App\Http\Controllers\SystemManagementController::class, 'destroyBrand'])->name('brands.destroy');
//Ruta para parámetros
Route::get('/parameters', [App\Http\Controllers\ParameterController::class, 'index'])->name('parameters.index');

Route::post('/productstatus/store', [App\Http\Controllers\ParameterController::class, 'storeProductStatus'])->name('productStatus.create');
Route::put('/productstatus/update/{id}', [App\Http\Controllers\ParameterController::class, 'updateProductStatus'])->name('productStatus.update');
Route::delete('/productstatus/delete/{id}', [App\Http\Controllers\ParameterController::class, 'destroyProductStatus'])->name('productStatus.destroy');  

Route::post('/reservtionstatus/store', [App\Http\Controllers\ParameterController::class, 'storeReservationStatus'])->name('reservationStatus.create');
Route::put('/reservationstatus/update/{id}', [App\Http\Controllers\ParameterController::class, 'updateReservationStatus'])->name('reservationStatus.update');
Route::delete('/reservationstatus/delete/{id}', [App\Http\Controllers\ParameterController::class, 'destroyReservationStatus'])->name('reservationStatus.destroy');  


Route::get('/company',[App\Http\Controllers\CompanyController::class,'InstitutionData'])->name('company');
Route::put('/company/edit/{id}',[App\Http\Controllers\CompanyController::class,'dataEditing'])->name('company.edit');

Route::get('/profile',[App\Http\Controllers\ProfileController::class,'profileData'])->name('profile');
Route::put('/profile/edit/{id}',[App\Http\Controllers\ProfileController::class,'dataEditing'])->name('profile.edit');

Route::get('/clients',[App\Http\Controllers\ClientsController::class,'index'])->name('clients.index');
Route::post('/clients/store',[App\Http\Controllers\ClientsController::class,'storeClient'])->name('client.store');
Route::put('/client/edti/{id}',[App\Http\Controllers\ClientsController::class,'updateClient'])->name('client.update');
Route::delete('/client/delete/{id}',[App\Http\Controllers\ClientsController::class,'clientDestroy'])->name('client.destroy');

Route::resource('/products',App\Http\Controllers\ProductsController::class);