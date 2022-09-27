<?php

use App\Http\Controllers\invoiceController;
use App\Http\Controllers\customerController;
use App\Http\Controllers\productController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/get_all_invoice', [invoiceController::class, 'get_all_invoice']);
Route::get('/search_invoice', [invoiceController::class, 'search_invoice']);
Route::get('/create_invoice', [invoiceController::class, 'create_invoice']);
Route::get('/customers', [customerController::class, 'all_customers']);
Route::get('/customers', [customerController::class, 'all_customers']);
Route::get('/products', [productController::class, 'all_product']);
Route::post('/add_invoice', [invoiceController::class, 'add_invoice']);
Route::get('/show_invoice/{id}', [invoiceController::class, 'show_invoice']);
Route::get('/edit_invoice/{id}', [invoiceController::class, 'edit_invoice']);
Route::get('/delete_invoice_items/{id}', [invoiceController::class, 'delete_invoice_items']);
Route::get('/update_invoice/{id}', [invoiceController::class, 'update_invoice']);
Route::get('/delete_invoice/{id}', [invoiceController::class, 'delete_invoice']);
