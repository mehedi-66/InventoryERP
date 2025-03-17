<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\AuthController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [AuthController::class, 'loginForm'])->middleware('isAlredyLoggedIn');

// ---------------------------- Authentication --------------------------------


Route::get('login', [AuthController::class, 'loginForm'])->middleware('isAlredyLoggedIn');
Route::post('login', [AuthController::class, 'login'])->middleware('isAlredyLoggedIn');
Route::get('logout', [AuthController::class, 'logout']);

// ------------------------- Dashboard Routes ------------------------

Route::get('/dashboard',[DashboardController::class, 'index'])->middleware('isLoggedIn');
Route::get('/unauthorized',[DashboardController::class, 'unauthorized'])->middleware('isLoggedIn');


// ------------------------- Registration Routes ------------------------

Route::group(['prefix' => 'reg','middleware' => ['isLoggedIn','roleCheck:Admin']], function () {
    Route::get('register', [AuthController::class, 'registerForm']);
    Route::post('register', [AuthController::class, 'register']);
});
Route::group(['prefix' => 'product','middleware' => ['isLoggedIn','roleCheck:Admin']], function () {
    Route::get('list', [ProductController::class, 'show']);
    Route::get('create', [ProductController::class, 'create']);
    Route::post('create', [ProductController::class, 'store']);
    Route::get('delete/{id}', [ProductController::class, 'delete']);
    Route::get('edit/{id}', [ProductController::class, 'edit']);
    Route::post('update/{id}', [ProductController::class, 'update']);

    // APIs
    Route::get('getList', [ProductController::class, 'getList']);
});
Route::group(['prefix' => 'purchase','middleware' => ['isLoggedIn','roleCheck:Admin']], function () {
    Route::get('list', [PurchaseController::class, 'show']);
    Route::get('create', [PurchaseController::class, 'create']);
    Route::post('create', [PurchaseController::class, 'store']);
    Route::get('delete/{id}', [PurchaseController::class, 'delete']);
    Route::get('edit/{id}', [PurchaseController::class, 'edit']);
    Route::post('update/{id}', [PurchaseController::class, 'update']);

    // APIs
    Route::get('getList', [PurchaseController::class, 'getList']);
});
Route::group(['prefix' => 'sales','middleware' => ['isLoggedIn','roleCheck:Admin,Account']], function () {
    Route::get('list', [SalesController::class, 'show']);
    Route::get('create', [SalesController::class, 'create']);
    Route::post('create', [SalesController::class, 'store']);
    Route::get('delete/{id}', [SalesController::class, 'delete']);
    Route::get('edit/{id}', [SalesController::class, 'edit']);
    Route::post('update/{id}', [SalesController::class, 'update']);
    Route::post('salesDetailsCreate/{sales_id}', [SalesController::class, 'salesDetailsCreate']);
    
    // APIs
    Route::get('getList', [SalesController::class, 'getList']);
});
Route::group(['prefix' => 'report','middleware' => ['isLoggedIn','roleCheck:Admin']], function () {
    Route::get('allSalesMonthly/{currDate}', [SalesController::class, 'allSalesMonthly']);
    Route::get('byProducthMontlySales/{currDate}/{product_id}', [SalesController::class, 'byProducthMontlySales']);
   
});

