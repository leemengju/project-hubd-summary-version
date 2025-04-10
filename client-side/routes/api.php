<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;


// 首頁
Route::get('/', function () {
    return view('home');
})->name('home');

// 測試頁
Route::get('/test1', function () {
    return view('test1');
})->name('test1');

// 登入才看得到頁
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// 購物車頁_
Route::match(['get', 'post'],'/cart', function () {
    return view('cart');
})->name('cart');


//購物車獲取資料
// Route::get('/getCartData', [CartController::class, 'getCartData']);
//購物車更新資料
// Route::match(['get', 'post'],'/insertCart', [CartController::class, 'insertCart']);

// 購物清單頁
Route::match(['get', 'post'],'/checkOut', function () {
    return view('checkOut');
})->name('checkOut');


//購物清單頁_新增一筆訂單_orderMain
Route::post('/InsertOrderMain', [CheckoutController::class, 'InsertOrderMain']);
//購物清單頁_新增一筆訂單_orderdetail
Route::post('/InsertOrderDetail', [CheckoutController::class, 'InsertOrderDetail']);
//購物清單頁_刪除購物車
Route::post('/DeleteCart', [CheckoutController::class, 'DeleteCart']);

// 成功頁
Route::match(['get', 'post'],'/successful_transaction', function () {
    return view('successful_transaction');
})->name('successful_transaction');
// 失敗頁
Route::match(['get', 'post'],'/failed_transaction', function () {
    return view('failed_transaction');
})->name('failed_transaction');
// 維護頁
Route::match(['get', 'post'],'/system-maintenance', function () {
    return view('system-maintenance');
})->name('system-maintenance');


