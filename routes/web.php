<?php

use App\Http\Controllers\HomeController;
use App\Http\Livewire\Admin\AdminDashboard;
use App\Http\Livewire\Admin\Dashboard;
use App\Http\Livewire\Admin\Order;
use App\Http\Livewire\Admin\Product;
use App\Http\Livewire\User\Cart;
use App\Http\Livewire\User\Checkout;
use App\Http\Livewire\User\UserDashboard;
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

Auth::routes();

Route::get('/', UserDashboard::class)->name('userDashboard')->middleware('user');
Route::get('/cart', Cart::class)->name('cart');
Route::get('/checkout', Checkout::class)->name('checkout');

Route::group(['middleware' => 'admin'], function () {
    Route::get('/admin', AdminDashboard::class)->name('adminDashboard');
    Route::get('/product', Product::class)->name('product');
    Route::get('/order', Order::class)->name('order');
    Route::get('/category', Category::class)->name('category');
});