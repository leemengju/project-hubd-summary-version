<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductMain;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $keywords = $request->input('keywords');
        $results = ProductMain::where('product_name', 'like', "%{$keywords}%")->get();

        return view('search', compact('results', 'keywords'));
    }
}
