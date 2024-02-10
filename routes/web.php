<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Permission;
use Illuminate\Support\Facades\Auth;
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

# part rander view
Route::get('/admin/dashboard', function () {
    return view('Back-office.dashboard');
})->middleware('Permission');
Route::get('/login', function () {
    return view('Front-office.login');
});
Route::get('/registre', function () {
    return view('Front-office.registre');
});
Route::get('/forgot', function () {
    return view('Front-office.forgot_password');
});
# part home or guest
Route::get('/', [HomeController::class, 'index'])->middleware('Permission');
Route::get('/home', [HomeController::class, 'index'])->middleware('Permission');
# part admin categorie 
Route::get('/admin/categories', [CategoryController::class, 'index_category'])->middleware('Permission');
Route::post('/admin/newCategory', [CategoryController::class, 'new_category'])->middleware('Permission');
Route::post('/admin/updateCategory', [CategoryController::class, 'update_category'])->middleware('Permission');
Route::post('/admin/deleteCategory', [CategoryController::class, 'delete_category'])->middleware('Permission');
# part admin Product 
Route::get('/admin/product', [ProductController::class, 'index_product'])->middleware('Permission');
Route::post('/admin/newProduct', [ProductController::class, 'new_product'])->middleware('Permission');
Route::post('/admin/updateProduct', [ProductController::class, 'update_product'])->middleware('Permission');
Route::post('/admin/deletePproduct', [ProductController::class, 'delete_product'])->middleware('Permission');
# part admin User 
Route::post('/admin/users', [UserController::class, 'index_user'])->middleware('Permission');
Route::post('/admin/newUser', [UserController::class, 'new_user'])->middleware('Permission');
Route::post('/admin/updateUser', [UserController::class, 'update_user'])->middleware('Permission');
Route::post('/admin/deleteUser', [UserController::class, 'delete_user'])->middleware('Permission');
# part Auth 
Route::post('/register', [AuthController::class, 'register'])->middleware('Permission');
Route::post('/login', [AuthController::class, 'login'])->middleware('Permission');
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/forgotPassword', [AuthController::class, 'forgotPassword']);
Route::get('/reset/{token}', [AuthController::class, 'reset']);
Route::post('/reset/{token}', [AuthController::class, 'resetPassword']);
