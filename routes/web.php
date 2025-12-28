<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

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
Route::get('/products', function () {
    return view('components.products');
})->name('products');
Route::get('/users', function () {
    return view('components.users');
})->name('users');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
