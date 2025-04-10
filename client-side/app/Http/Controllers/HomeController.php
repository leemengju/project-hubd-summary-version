<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductMain;
use App\Models\Banner;

class HomeController extends Controller
{
    public function home(Request $request)
    {
        // 是否顯示首頁廣告（若 cookie 不存在，就代表第一次進入）
        $noAdCookie = !$request->cookie('show_cover_ad');

        // 取得 banner
        $banners = Banner::whereIn('banner_id', [1, 2, 3])->orderBy('banner_id')->get();

        // 取得主打商品（外套6件）
        $hitItems = ProductMain::with(['specs' => function ($query) {
            $query->select('product_id', 'product_color')->distinct();
        }])
            ->whereBetween('product_id', ['pj001', 'pj006'])
            ->orderBy('product_id', 'asc')
            ->get();

        // 首頁 顯示商品（飾品＋服飾各4個）
        // 庫存為 0 時顯示 sold out
        $accessories = ProductMain::withSum('specs', 'product_stock')
            ->whereBetween('product_id', ['pa001', 'pa004'])
            ->orderBy('product_id', 'asc')
            ->get();

        $clothes = ProductMain::withSum('specs', 'product_stock')
            ->whereBetween('product_id', ['pl001', 'pl004'])
            ->orderBy('product_id', 'asc')
            ->get();

        return response()
            ->view('home', compact('banners', 'accessories', 'clothes', 'hitItems', 'noAdCookie'))
            ->cookie('show_cover_ad', true, 60); // 設定一小時不再顯示
    }
}
