<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('about', [AboutController::class, 'about'])->name('about');

Route::get('contact', [ContactController::class, 'contact'])->name('contact');

//route for "all products" view
Route::get('products', [ProductController::class, 'index'])->name('products.index');

//restrict creating new product page to authenticated users only
Route::middleware(['auth', 'amazon.keyword.check'])->group(function () {
    
    Route::get('product/create', [ProductController::class, 'create'])->name('products.create');
});

//apply "amazon.keyword.check" MW to these routes
Route::middleware(['amazon.keyword.check'])->group(function () {

    //route for inserting data to db table
    Route::post('product/store', [ProductController::class, 'store'])->name('products.store');

    //route for "show" view
    Route::get('product/show/{id}', [ProductController::class, 'show'])->name('products.show');

    //route for "update-form" view
    Route::get('product/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');

    //route for updating data in db table
    Route::put('product/update/{id}', [ProductController::class, 'update'])->name('products.update');

    //route for deleting data from db table
    Route::delete('product/delete/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
});

//apply "amazon.keyword.check" MW to these routes
Route::middleware(['amazon.keyword.check'])->group(function () {
    //route for the category controller
    Route::resource('categories', CategoryController::class);
});
