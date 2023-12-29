<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\PublicController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Public\AuthenticateController;

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

Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/cart', [PublicController::class, 'cart'])->name('cart');
Route::get('/customer-order', [PublicController::class, 'customerOrders'])->name('customer.orders');
Route::get('/login', [PublicController::class, 'signin'])->name('login');
Route::post('/order', [PublicController::class, 'storeOrder'])->name('order.store');
Route::post('/signin', [AuthenticateController::class, 'authenticate'])->name('signin.auth');

Route::get('/download/{invoice}/invoice', [AdminController::class, 'downloadInvoice'])->name('invoices.download');
Route::get('/download/{payment}/payment', [AdminController::class, 'downloadReceipt'])->name('receipt.download');

Route::middleware(['auth'])->group(function () {
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
        Route::get('/logout', 'logout')->name('logout');
    });
}); 