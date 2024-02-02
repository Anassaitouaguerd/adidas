<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
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
    return view('dashboard');
});
Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/categories', [CategoryController::class, 'index_category']);
Route::post('/new_category', [CategoryController::class, 'new_category']);
Route::post('/update_category', [CategoryController::class, 'update_category']);
Route::post('/delete_category', [CategoryController::class, 'delete_category']);
Route::get('/product', [ProductController::class, 'index_product']);
Route::post('/new_product', [ProductController::class, 'new_product']);
Route::post('/update_product', [ProductController::class, 'update_product']);
Route::post('/delete_product', [ProductController::class, 'delete_product']);

