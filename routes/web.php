<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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
    return view('components.dashboard');
})->name('dashboard');
Route::get('/products', [ProductController::class,'index'])->name('products');
Route::get('/users', [UserController::class, 'index'])->name('users');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
