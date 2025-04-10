<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductMain; // Assuming you need to import the ProductMain model
class CategoryController extends Controller
{
    public function BackToCgy()

    {
        return redirect()->route('categories_clothes');
    }

}
