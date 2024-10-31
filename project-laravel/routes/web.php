<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SuppliersController;
use App\Models\Suppliers;

Route::get('/product',[ProductController::class, 'index'])-> name('product-index');
Route::get('/product/create',[ProductController::class, 'create'])->name("product-create");
Route::post('/product',[ProductController::class, 'store'])->name("product-store");
Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name("product-edit");
Route::put('/product/{id}', [ProductController::class, 'update'])-> name("product-update");



Route::get('/suppliers',[SuppliersController::class, 'index'])-> name('suppliers-index');
Route::get('/suppliers/create',[SuppliersController::class, 'create'])->name("suppliers-create");
Route::post('/suppliers',[SuppliersController::class, 'store'])->name("suppliers-store");
Route::get('/suppliers/{id}/edit', [SuppliersController::class, 'edit'])->name("suppliers-edit");
Route::put('/suppliers/{id}', [SuppliersController::class, 'update'])-> name("suppliers-update");

// Route::get('/product/{id}',[ProductController::class, 'show']);
// Route::get('/product/{id}/edit',[ProductController::class, 'edit']);
// Route::put('/product/{id}',[ProductController::class, 'update']);
// Route::delete('/product/{id}',[ProductController::class, 'destroy']);

//Route::resource(name: 'product', controller: ProductController::class);

Route::get('/', function () {
    return view('welcome');
});

// // Route::get('/product', function () {
// //     return view('product');
// });

Route::get('/home', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified','RoleCheck:admin'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
