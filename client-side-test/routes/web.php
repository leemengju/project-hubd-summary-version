<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CouponController;


// 首頁
Route::get('/', [HomeController::class, 'home'])->name('home');

// 商品搜尋
Route::get('/search', [SearchController::class, 'search'])->name('search');

// 商品分類 飾品
Route::get('/categories_accessories', [CategoriesAccController::class, 'categoriesAcc'])
    ->name('categories_accessories');

// 商品分類 服飾
Route::get('/categories_clothes', [CategoriesCloController::class, 'categoriesClo'])
    ->name('categories_clothes');

//銀黏土課程
Route::get('/lessons', function () {
    return view('lessons');
})->name('lessons');


// 關於我們
Route::get('/about_us', function () {
    return view('about_us');
})->name('about_us');

// 收藏清單
Route::middleware(['auth'])->group(function () {
    Route::get('/wish-lists', [WishlistController::class, 'index'])->name('wish_lists');
    Route::post('/wishlist/toggle', [WishlistController::class, 'toggleWishlist'])->name('wishlist.toggle');
    Route::post('/wishlist/remove', [WishlistController::class, 'removeFromWishlist'])->name('wishlist.remove');
});

// 商品內頁
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product_details');

// 用戶相關頁面
// Route::prefix('user')->name('user.')->middleware(['auth'])->group(function () {
// Route::prefix('user')->name('user.')->group(function () {  // 暫時移除 middleware(['auth'])
Route::prefix('user')->name('user.')->middleware(['auth'])->group(function () {  // 恢復 auth 中間件
    // 個人檔案
    Route::get('/user_profile', [UserProfileController::class, 'index'])->name('user_profile');

    // 更新個人資料
    Route::put('/user_profile/update', function () {
        // 處理更新邏輯
        return redirect()->back()->with('success', '個人資料已更新');
    })->name('user_profile.update');

    // 編輯個人資料頁面
    Route::get('/edit_profile', function () {
        return view('user.edit_profile');
    })->name('edit_profile');

    // 變更密碼頁面
    Route::get('/change_password', function () {
        return view('user.change_password');
    })->name('change_password');

    // 處理密碼變更
    Route::post('/change_password', function () {
        // 處理密碼變更邏輯
        return redirect()->route('user.user_profile')->with('success', '密碼已成功變更');
    })->name('change_password.update');

    // 我的訂單
    Route::get('/orders', [OrderController::class, 'index'])->name('orders');

    // 收件地址
    Route::get('/address', function () {
        return view('user.address');
    })->name('address');

    // 付款資訊
    Route::get('/payment', function () {
        return view('user.payment');
    })->name('payment');

    // 新增付款方式頁面
    Route::get('/payment/add', function () {
        return view('user.payment_add');
    })->name('payment.add');

    // 編輯付款方式頁面
    Route::get('/payment/edit/{id}', function ($id) {
        return view('user.payment_edit', compact('id'));
    })->name('payment.edit');

    // 處理新增付款方式
    Route::post('/payment/store', function () {
        // 處理新增付款方式邏輯
        return redirect()->route('user.payment')->with('success', '付款方式已成功新增');
    })->name('payment.store');

    // 處理更新付款方式
    Route::put('/payment/update/{id}', function ($id) {
        // 處理更新付款方式邏輯
        return redirect()->route('user.payment')->with('success', '付款方式已成功更新');
    })->name('payment.update');

    // 處理刪除付款方式
    Route::delete('/payment/delete/{id}', function ($id) {
        // 處理刪除付款方式邏輯
        return redirect()->route('user.payment')->with('success', '付款方式已成功刪除');
    })->name('payment.delete');

    //
    Route::get('/coupons', [CouponController::class, 'index'])->name('coupons');
    Route::get('/coupons/switch-view', [CouponController::class, 'switchView'])->name('coupons.switch-view');
    Route::post('/coupons/redeem', [CouponController::class, 'redeem'])->name('coupons.redeem');
    Route::get('/coupons/{id}', [CouponController::class, 'show'])->name('coupons.show');

    // 新增收件地址頁面
    Route::get('/address/add', function () {
        return view('user.address_add');
    })->name('address.add');

    // 編輯收件地址頁面
    Route::get('/address/edit/{id}', function ($id) {
        return view('user.address_edit', compact('id'));
    })->name('address.edit');

    // 處理新增收件地址
    Route::post('/address/store', function () {
        // 處理新增收件地址邏輯
        return redirect()->route('user.address')->with('success', '收件地址已成功新增');
    })->name('address.store');

    // 處理更新收件地址
    Route::put('/address/update/{id}', function ($id) {
        // 處理更新收件地址邏輯
        return redirect()->route('user.address')->with('success', '收件地址已成功更新');
    })->name('address.update');

    // 處理刪除收件地址
    Route::delete('/address/delete/{id}', function ($id) {
        // 處理刪除收件地址邏輯
        return redirect()->route('user.address')->with('success', '收件地址已成功刪除');
    })->name('address.delete');

    // 訂單詳情頁面
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.detail');

    // 取消訂單
    Route::post('/orders/{id}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');

    // 申請退貨
    Route::get('/orders/{id}/return', [OrderController::class, 'returnOrder'])->name('orders.return');

    // 處理退貨申請
    Route::post('/orders/{id}/return', [OrderController::class, 'storeReturn'])->name('orders.return.store');
});

//確保 /user_profile 只能在登入 (auth) 狀態下訪問，如果未登入，Laravel 會自動導向 mylogin。
Route::middleware(['auth'])->group(function () {
    Route::get('/user_profile', [UserProfileController::class, 'index'])->name('user_profile');
});

//確保 /cart 只能在登入 (auth) 狀態下訪問，如果未登入，Laravel 會自動導向 mylogin。
Route::middleware(['auth'])->group(function () {
    Route::match(['get', 'post'], '/cart', [CartController::class, 'index'])->name('cart');
});

require __DIR__ . '/auth.php';

//購物車獲取資料
Route::get('/getCartData', [CartController::class, 'getCartData'])->name('getCartData');

// 購物車更新資料
Route::match(['get', 'post'], '/insertCart', [CartController::class, 'insertCart'])->name('insertCart');
Route::post('/updateCart', [CartController::class, 'updateCart'])->name('updateCart');

//購物車獲取coupons
Route::get('/getCoupons', [CartController::class, 'getCoupons'])->name('getCoupons');

// 購物清單頁
Route::match(['get', 'post'], '/check_out', function () {
    return view('check_out');
})->name('check_out');

//購物清單頁_新增一筆訂單_orderMain
Route::post('/InsertOrderMain', [CheckoutController::class, 'InsertOrderMain']);

//購物清單頁_新增一筆訂單_orderdetail
Route::post('/InsertOrderDetail', [CheckoutController::class, 'InsertOrderDetail']);

//購物清單頁_刪除購物車
Route::post('/DeleteCart', [CheckoutController::class, 'DeleteCart']);
//購物清單頁_更新庫存
Route::post('/UpdateProductStock', [CheckoutController::class, 'UpdateProductStock']);

// 成功頁
Route::match(['get', 'post'], '/successful_transaction', function () {
    return view('successful_transaction');
})->name('successful_transaction');

// 失敗頁
Route::match(['get', 'post'], '/failed_transaction', function () {
    return view('failed_transaction');
})->name('failed_transaction');

// 維護頁
Route::match(['get', 'post'], '/system-maintenance', function () {
    return view('system-maintenance');
})->name('system-maintenance');
// 維護頁調資料庫資料
Route::get('/maintenance', [SystemMaintenanceController::class, 'showMaintenance'])->name('system.maintenance');

// 購物車無商品
Route::match(['get', 'post'], '/cart_empty', function () {
    return view('cart_empty');
})->name('cart_empty');
