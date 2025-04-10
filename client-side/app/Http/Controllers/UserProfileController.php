<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    /**
     * 顯示用戶個人檔案頁面
     */
    public function index()
    {
        $user = Auth::user(); // 獲取當前登入用戶
        return view('user.user_profile', compact('user'));
    }
}
