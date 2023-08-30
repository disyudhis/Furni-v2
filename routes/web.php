<?php

use App\Http\Controllers\HomeController;
use App\Http\Livewire\Admin\Order;
use App\Http\Livewire\Admin\Product;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Admin\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/redirect', [HomeController::class, 'redirect'])->middleware('auth', 'verified');

Auth::routes();

// LiveWire
Route::get('/product', Product::class)->name('product');
Route::get('/order', Order::class)->name('order');
Route::get('/category', Category::class)->name('category');