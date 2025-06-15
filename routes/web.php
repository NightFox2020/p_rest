<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\IngredientController;
use App\Http\Controllers\Backend\SupplierController;
use App\Http\Controllers\Backend\PurchaseController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
  return view('admin.index');
})->middleware(['auth'])->name('admin.dashboard');

Route::get('/dashboard', function () {
  return view('admin.index');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
  Route::controller(AdminController::class)->group(function(){
    Route::get('/admin/logout', 'destroy')->name('admin.logout');
    Route::get('/edit/profile','EditProfile')->name('edit.profile');
    Route::post('/store/profile/{id}','StoreProfile')->name('store.profile');
    Route::get('/change/password','ChangePassword')->name('change.password');
    Route::post('/update/password','UpdatePassword')->name('update.password');
  });

  Route::controller(CategoryController::class)->group(function () {
    Route::get('/category/all', 'CategoryAll')->name('category.all');
    Route::get('/category/add', 'CategoryAdd')->name('category.add');
    Route::post('/category/store', 'CategoryStore')->name('category.store');
    Route::get('/category/edit/{id}', 'CategoryEdit')->name('category.edit');
    Route::post('/category/update', 'CategoryUpdate')->name('category.update');
    Route::get('/category/delete/{id}', 'CategoryDelete')->name('category.delete');
  });

  Route::controller(ProductController::class)->group(function () {
    Route::get('/product/all', 'ProductAll')->name('product.all');
    Route::get('/product/add', 'ProductAdd')->name('product.add');
    Route::post('/product/store', 'ProductStore')->name('product.store');
    Route::get('/product/edit/{id}', 'ProductEdit')->name('product.edit');
    Route::post('/product/update', 'ProductUpdate')->name('product.update');
    Route::get('/product/delete/{id}', 'ProductDelete')->name('product.delete');
  });

  Route::controller(IngredientController::class)->group(function () {
    // Gestionar Ingredientes
    Route::get('/ingredient/all', 'IngredientAll')->name('ingredient.all');
    Route::post('/ingredient/store', 'IngredientStore')->name('ingredient.store');
    Route::get('/ingredient/edit/{id}', 'IngredientEdit')->name('ingredient.edit');
    Route::post('/ingredient/update', 'IngredientUpdate')->name('ingredient.update');
    Route::get('/ingredient/delete/{id}', 'IngredientDelete')->name('ingredient.delete');

    // Gestionar Ingredientes añadidos a Productos
    Route::get('/ingredient/product/all', 'IngredientProductAll')->name('ingredient.product.all');
    Route::get('/ingredient/product/add', 'IngredientProductAdd')->name('ingredient.product.add');
    Route::post('/ingredient/product/store', 'IngredientProductStore')->name('ingredient.product.store');
    Route::get('/ingredient/product/edit/{id}', 'IngredientProductEdit')->name('ingredient.product.edit');
    Route::post('/ingredient/product/update/{id}', 'IngredientProductUpdate')->name('ingredient.product.update');
    Route::get('/ingredient/product/delete/{id}', 'IngredientProductDelete')->name('ingredient.product.delete');
  });

  Route::controller(SupplierController::class)->group(function(){
    Route::get('/supplier/all', 'SupplierAll')->name('supplier.all');
    Route::post('/supplier/store', 'SupplierStore')->name('supplier.store');
    Route::get('/supplier/edit/{id}', 'SupplierEdit')->name('supplier.edit');
    Route::post('/supplier/update', 'SupplierUpdate')->name('supplier.update');
    Route::get('/supplier/delete/{id}', 'SupplierDelete')->name('supplier.delete');
  });

  Route::controller(PurchaseController::class)->group(function () {
    Route::get('/purchase/all', 'PurchaseAll')->name('purchase.all');
    Route::get('/purchase/add', 'PurchaseAdd')->name('purchase.add');
    Route::post('/purchase/store', 'PurchaseStore')->name('purchase.store');
    Route::get('/purchase/delete/{id}', 'PurchaseDelete')->name('purchase.delete');
    Route::get('/purchase/pending/details/{id}', 'PurchasePendingDetails')->name('purchase.pending.details');
    Route::get('/purchase/approve/{id}', 'PurchaseApprove')->name('purchase.approve');
  });
});

require __DIR__.'/auth.php';
