<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

// Display a list of products
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// Show the form for creating a new product
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');

// Store a newly created product in the database
Route::post('/products', [ProductController::class, 'store'])->name('products.store');

// Show the form for editing the specified product
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');

// Update the specified product in the database
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');

// Remove the specified product from the database
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
