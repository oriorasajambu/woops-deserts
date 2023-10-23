<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\PublicController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ExpenseReportController;
use App\Http\Controllers\Admin\InvoicesController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\PostageCostController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SalesReportController;

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
    Route::get('/', [PublicController::class, 'index']);
});


Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::resource('category', CategoryController::class);
Route::resource('product', ProductController::class);
Route::resource('postage-cost', PostageCostController::class);
Route::resource('expense', ExpenseReportController::class);
Route::resource('sales', SalesReportController::class);
Route::resource('order', OrderController::class);
Route::resource('payment', PaymentController::class);
Route::resource('invoices', InvoicesController::class);