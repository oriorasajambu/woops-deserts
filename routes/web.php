<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\PublicController;
use App\Http\Controllers\Admin\AdminController;

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

Route::middleware(['guest'])->group(function () {
    Route::get('/', [PublicController::class, 'index'])->name('dashboard');
    Route::get('/cart', [PublicController::class, 'cart'])->name('cart');
});

Route::controller(AdminController::class)->group(function () {
    Route::get('/admin', 'index')->name('admin');
    Route::get('/category', 'category')->name('category');
    Route::get('/product', 'product')->name('product');
    Route::get('/config', 'config')->name('config');
    Route::get('/postage', 'postage')->name('postage');
    Route::get('/expense', 'expense')->name('expense');
    Route::get('/sales', 'sales')->name('sales');
    Route::get('/order', 'order')->name('order');
    Route::get('/payment', 'payment')->name('payment');
    Route::get('/invoices', 'invoices')->name('invoices');
    Route::get('/download/{invoice}/invoice', 'downloadInvoice')->name('invoices.download');
    Route::get('/download/{payment}/payment', 'downloadReceipt')->name('receipt.download');
    Route::get('/logout', 'logout')->name('logout');
});