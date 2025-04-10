<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductMain;
use App\Models\ProductSpecs;

class CategoriesCloController extends Controller
{
    public function categoriesClo()
    {
        // 取得短袖
        $shorts = ProductMain::withSum('specs', 'product_stock')
            ->where('product_id', 'LIKE', 'ps%')
            ->orderBy('product_id', 'asc')->get();

        // 取得長袖
        $longs = ProductMain::withSum('specs', 'product_stock')
            ->where('product_id', 'LIKE', 'pl%')
            ->orderBy('product_id', 'asc')->get();

        // 取得外套
        $jackets = ProductMain::withSum('specs', 'product_stock')
            ->where('product_id', 'LIKE', 'pj%')
            ->orderBy('product_id', 'asc')->get();

        return view('categories_clothes', compact('shorts', 'longs', 'jackets'));
    }
}
