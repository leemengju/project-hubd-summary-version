<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist;
use App\Models\ProductMain;


class WishlistController extends Controller
{
  // 顯示收藏清單
  public function index()
  {
      if (!Auth::check()) {
          return redirect()->route('login')->with('error', '請先登入');
      }

      $wishlistItems = Wishlist::where('id', Auth::id())->with('product')->get();
      return view('wish_lists', compact('wishlistItems'));
  }

  // 加入或移除收藏
  public function toggleWishlist(Request $request)
  {
      if (!Auth::check()) {
          return response()->json(['error' => '請先登入'], 401);
      }

      $productId = $request->input('product_id');
      $wishlistItem = Wishlist::where('id', Auth::id())->where('product_id', $productId)->first();

      if ($wishlistItem) {
          $wishlistItem->delete();
          return response()->json(['status' => 'removed']);
      } else {
          Wishlist::create([
              'id' => Auth::id(),
              'product_id' => $productId,
          ]);
          return response()->json(['status' => 'added']);
      }
  }

  // 移除收藏
  public function removeFromWishlist(Request $request)
  {
      if (!Auth::check()) {
          return response()->json(['error' => '請先登入'], 401);
      }

      $productId = $request->input('product_id');
      Wishlist::where('id', Auth::id())->where('product_id', $productId)->delete();

      return response()->json(['status' => 'removed']);
  }
}


// https://www.104.com.tw/job/5qwcs?jobsource=index_job_r