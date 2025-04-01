<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductMain; // 確保這裡的 Model 與你的資料表對應


class ProductController extends Controller
{
    public function show($id)
    {
        $product = ProductMain::with([
            'specs',            // 商品規格（尺寸、顏色、庫存）
            'information',      // 商品說明（材質、出貨等）
            'images',           // 商品圖片
            'displayImages'     // 展示圖片
        ])->findOrFail($id);

        

        return view('product_details', compact('product'));
    }



}

