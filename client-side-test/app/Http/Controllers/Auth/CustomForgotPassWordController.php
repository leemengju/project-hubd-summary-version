<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\PasswordResetCodeNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\password;

class CustomForgotPassWordController extends Controller
{

    //顯示Email頁面
    public function showEmailForm()
    {
        return view('auth.myforget-password');
    }




    //寄送驗證碼
    public function sendVerificationCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email', //l 測試不用這段連接資料庫
        ]);

        // **清除舊的 Session**
        Session::forget(['password_reset_code', 'password_reset_expires_at']);

        //生成六位數驗證碼
        $verificationCode = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

        // 存入 Session
        Session::put('reset_email', $request->email);
        Session::put('password_reset_code', $verificationCode);
        Session::put('password_reset_expires_at', now()->addMinutes(5));


        // 發送驗證碼到信箱 發送忘記密碼驗證碼
        Notification::route('mail', $request->email)->notifyNow(new PasswordResetCodeNotification($verificationCode));
        return redirect()->route('myenter-confirmation-code');
    }



    //確認驗證碼頁面
    public function showVerificationForm()
    {
        // 對應 resources/views/auth/myenter-confirmation-code.blade.php
        return view('auth.myenter-confirmation-code');
    }



    //確認驗證碼
    public function verifyCode(Request $request)
    {
        // return Redirect(route('mychange-password')); //檢視前端用的
        $request->validate([
            'code' => 'required|numeric|digits:6',
        ]);

        // 取得 Session 中的驗證碼和過期時間
        $expiresAt = Session::get('password_reset_expires_at');
        $storedCode = Session::get('password_reset_code');

        // dd($request->all(), Session::all());


        // 確保驗證碼存在
        if (!$storedCode) {
            return back()->withErrors(['code' => '驗證碼無效，請重新發送']);
        }



        // 檢查驗證碼是否過期
        if (!$expiresAt || now()->greaterThan(\Illuminate\Support\Carbon::parse($expiresAt))) {
            return back()->withErrors(['code' => '驗證碼已過期，請重新發送驗證碼']);
        }



        //確保 `code` 的型別一致
        if ((string) $request->code !== (string) $storedCode) {
            return back()->withErrors(['code' => '驗證碼錯誤，請重新輸入']);
        }

        //驗證成功，設置標記讓用戶能進入重設密碼頁面
        Session::put('password_reset_verified', true);

        return redirect()->route('mychange-password');
    }

    //重新發送驗證碼
    public function resendCode()
    {
        $email = Session::get('reset_email');
        // 🛠 測試 Session 是否有 email
        // dd($email); 
        if (!$email) {
            return back()->withErrors(['email' => '無法重新發送驗證碼，請先輸入 Email 進行驗證']);
        }

        // 產生新驗證碼
        $newCode = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $expiresAt = now()->addMinutes(5);
        // 儲存驗證碼到 Session（可設定 5 分鐘內有效）
        Session::put('password_reset_code', $newCode);
        Session::put('password_reset_expires_at', $expiresAt);



        // 發送驗證碼到信箱 發送忘記密碼驗證碼
        Notification::route('mail', $email)->notifyNow(new PasswordResetCodeNotification($newCode));


        return back()->with('success', '新的驗證碼已發送至您的信箱');
    }






    //更改密碼的頁面
    public function showResetForm()
    {
        // 對應 resources/views/auth/mychange-password.blade.php
        if (!Session::get('password_reset_verified')) {
            return redirect()->route('myenter-confirmation-code')->withErrors(['code' => '請先輸入驗證碼']);
        }
        return view('auth.mychange-password');
    }








    // 重設密碼
    public function resetPassword(Request $request)
    {
        // 確保用戶已經通過驗證碼驗證
        if (!Session::get('password_reset_verified')) {
            return redirect()->route('myenter-confirmation-code')->withErrors(['code' => '請先輸入驗證碼']);
        }

        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);

        //確保 session 內還有 email
        if (!Session::has('reset_email')) {
            return redirect()->route('login')->withErrors(['email' => '密碼重設連結已失效，請重新申請密碼重設']);
        }


        // 取得 Session 中的 email
        $email = Session::get('reset_email');

        //如果 email 不存在，導回登入頁，避免不正確的密碼重設
        if (!$email) {
            return redirect()->route('login')->withErrors(['email' => '密碼重設連結已失效，請重新申請密碼重設']);
        }


        //查找使用者
        $user = User::where('email', Session::get('reset_email'))->first();
        //確保找到使用者
        if (!$user) {
            return redirect()->route('login')->withErrors(['email' => '無法找到該 Email，請重新申請密碼重設']);
        }

        // 確保新密碼與舊密碼不同
        if (Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => '新密碼不能與舊密碼相同，請輸入不同的密碼']);
        }


        //更新密碼
        $user->password = Hash::make($request->password);
        $user->save();

        //清除 Session 中的驗證碼和 Email
        Session::forget(['password_reset_code', 'reset_email', 'password_reset_verified']);



        return redirect()->route('login')->with('status', '密碼重設成功，請重新登入');
    }
}
