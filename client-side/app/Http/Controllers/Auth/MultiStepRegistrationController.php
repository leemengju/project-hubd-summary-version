<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\VerificationCodeNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Models\User;

class MultiStepRegistrationController extends Controller
{


    //顯示email輸入頁面
    public function showEmailForm()
    {
        return view('auth.myregister');
    }


    //發送驗證碼
    public function sendVerificationCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
        ]);

        // 測試是否有進入這個函數
        //  dd('✅ sendVerificationCode() 方法執行成功', $request->email);

        //產生驗證碼
        $verificationCode = random_int(100000, 999999);


        // 確保 `registration_expires_at` 存入 `timestamp`，而不是 `Carbon`
        // $expiresAt = now()->addMinutes(5)->timestamp; //五分鐘有效

        // **清除舊的 `Carbon` 物件，確保 Session 內只有 Timestamp**
        // if (Session::has('registration_expires_at')) {
        //     $oldValue = Session::get('registration_expires_at');
        //     if ($oldValue instanceof \Illuminate\Support\Carbon) {
        //         Session::forget('registration_expires_at'); // **清除舊值**
        //     }
        // }


        //存入session
        Session::put('registration_verification_code', $verificationCode);
        //Session::put('registration_expires_at', $expiresAt);
        Session::put('registration_email', $request->email);
        Session::put('last_verification_request_time', now()->timestamp); //記錄請求時間

        //發送驗證碼
        Notification::route('mail', $request->email)->notifyNow(new VerificationCodeNotification($verificationCode));

        return redirect()->route('myverify');
    }






    //重新寄送驗證碼
    // public function resendVerificationCode(Request $request)
    // {
    //     $email = Session::get('registration_email');

    //     if (!$email) {
    //         return back()->withErrors(['email' => '無法重新寄送驗證碼，請重新註冊'])->withInput();
    //     }

    //     // **強制清除舊的 `Carbon` 物件，確保 Session 內不再有 `Carbon`**
    //     if (Session::has('last_verification_request_time')) {
    //         $oldValue = Session::get('last_verification_request_time');
    //         if ($oldValue instanceof \Illuminate\Support\Carbon) {
    //             Session::forget('last_verification_request_time'); // **清除舊值**
    //         }
    //     }

    //     // 防止短時間內重複發送

    //     $lastRequestTimestamp = (int) Session::get('last_verification_request_time', 0); //取得Unix Timestamp
    //     $currentTimestamp = now()->timestamp; //取得現在時間（秒）

    //     $timePassed = $currentTimestamp -  $lastRequestTimestamp; //計算時間差（秒）

    //     if ($timePassed < 60) {
    //         //確保 resend_cooldown存入整數
    //         $remainingCooldown = max(0, min(60, floor(60 - $timePassed)));
    //         Session::put('resend_cooldown', $remainingCooldown); //存入冷卻時間 讓前端可以顯示

    //         return back()->withErrors(['email' => '請等待' . $remainingCooldown . '秒在發送'])->withInput();
    //     }



    //     // 產生驗證碼
    //     $verificationCode = random_int(100000, 999999);

    //     // 存入 Session
    //     Session::put('registration_verification_code', $verificationCode);
    //     Session::put('registration_expires_at', now()->addMinutes(5));
    //     Session::put('last_verification_request_time', now()->timestamp);

    //     //確保存入新的60秒冷卻時間
    //     Session::put('resend_cooldown',60);

    //     Session::forget('resend_cooldown'); //清除冷卻時間 因為已成功發送

    //     // 發送驗證碼
    //     Notification::route('mail', $email)->notifyNow(new VerificationCodeNotification($verificationCode));

    //     return back()->with('status', '驗證碼已重新寄送，請在五分鐘內使用');
    // }
    public function resendVerificationCode(Request $request)
    {
        $email = Session::get('registration_email');

        if (!$email) {
            return back()->withErrors(['email' => '無法重新寄送驗證碼，請重新註冊'])->withInput();
        }

        // **確保 Session 內的 `last_verification_request_time` 是 Unix Timestamp**
        // if (Session::has('last_verification_request_time')) {
        //     $oldValue = Session::get('last_verification_request_time');
        //     if ($oldValue instanceof \Illuminate\Support\Carbon) {
        //         Session::forget('last_verification_request_time'); // **清除舊的 `Carbon` 物件**
        //     }
        // }

        // **取得上次發送驗證碼的時間**
        $lastRequestTimestamp = (int) Session::get('last_verification_request_time', 0);
        $currentTimestamp = now()->timestamp;

        // **計算剩餘冷卻時間**
        $timePassed = $currentTimestamp - $lastRequestTimestamp;
        if ($timePassed < 60) {
            $remainingCooldown = 60 - $timePassed;
            Session::put('resend_cooldown', $remainingCooldown);
            return back()->withErrors(['email' => '請等待 ' . $remainingCooldown . ' 秒後再發送'])->withInput();
        }

        // **產生新的驗證碼**
        $verificationCode = random_int(100000, 999999);

        // **存入新的 `last_verification_request_time` 和 `resend_cooldown = 60`**
        Session::put('registration_verification_code', $verificationCode);
        Session::put('last_verification_request_time', now()->timestamp);
        Session::put('resend_cooldown', 60); // **確保存入 60 秒倒數**

        // **發送驗證碼**
        Notification::route('mail', $email)->notifyNow(new VerificationCodeNotification($verificationCode));

        return back()->with('status', '驗證碼已重新寄送，請在五分鐘內使用');
    }




    // Step 2: 顯示驗證碼輸入頁面

    public function showVerificationForm()
    {
        return view('auth.myverify'); // 確保 view 名稱與你的 Blade 檔案相符
    }




    // Step 2: 驗證輸入的驗證碼
    public function verifyCode(Request $request)
    {
        //return redirect() -> route('mylaststep'); //暫時測試前端流程


        $request->validate([
            'verification_code' => 'required|numeric|digits:6', // 驗證碼應該是 6 位數
        ]);


        // 確保 `registration_expires_at` 不是 Carbon 物件
        // if (Session::has('registration_expires_at')) {
        //     $oldValue = Session::get('registration_expires_at');
        //     if ($oldValue instanceof \Illuminate\Support\Carbon) {
        //         Session::forget('registration_expires_at'); // **清除舊的 `Carbon`**
        //     }
        // }

        // 取得 session 中存的驗證碼
        $sessionCode = Session::get('registration_verification_code');
        // $expiresAt = (int) Session::get('registration_expires_at', 0); //確保轉成int
        // $currentTimestamp = now()->timestamp; //取得當前時間


        //確保驗證碼仍有效
        // if ($currentTimestamp > $expiresAt) {
        //     return back()->withErrors(['verification_code' => '驗證碼已過期，請重新請求'])->withInput();
        // }

        // 檢查驗證碼是否匹配
        if ($request->verification_code != $sessionCode) {
            return back()->withErrors(['verification_code' => '驗證碼錯誤，請重新輸入'])->withInput();
        }

        // ✅ 確認驗證成功後，將驗證狀態存入 Session
        Session::put('email_verified', true);

        // 驗證成功，清除 session 中的驗證碼
        Session::forget('registration_verification_code');
        //Session::forget('registration_expires_at');

        return redirect()->route('mylaststep');
    }


    //Step 3: 顯示個人資料輸入頁面
    public function showDetailsForm()
    {
        return view('auth.mylaststep'); // 確保 view 名稱與你的 Blade 檔案相符
    }


    //Step 3: 接收個人資料，完成註冊

    public function registerDetails(Request $request)
    {

       
        // 確保 session 中的 email 存在，避免 session 遺失
        $email = Session::get('registration_email');

        if (!$email) {
            return back()->withErrors(['email' => '信件遺失，請重新註冊'])->withInput();
        };

        // ✅ 確保 Email 已驗證
        if (!Session::get('email_verified')) {
            return back()->withErrors(['email' => 'Email 尚未驗證，請重新驗證'])->withInput();
        }



        // ✅ 使用語系檔案來處理錯誤訊息
        $request->validate([
            'name' => 'required|string|max:100|regex:/^[\p{Han}]+$/u',
            'phone' => 'required|digits:10|regex:/^09\d{8}$/',
            'password' => 'required|min:6|max:32',
            'year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'month' => 'nullable|integer|min:1|max:12',
            'day' => 'nullable|integer|min:1|max:31',
        ]);


        //檢查生日是否完整，並轉換成 YYYY-MM-DD 格式
        $birthday = null;
        if ($request->filled(['year', 'month', 'day'])) {
            $birthday = sprintf('%04d-%02d-%02d', $request->year, $request->month, $request->day);
        }
        


            // 創建新用戶
            $user = User::create([
                'name' => $request->name,
                'email' => Session::get('registration_email'),
                'birthday' => $birthday,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'email_verified_at' => now(), //將email設為已驗證
            ]);


            // 清除 Session 中的驗證碼與 Email
            Session::forget(['registration_verification_code', 'registration_email', 'email_verified']);

            //自動登入用戶
            Auth::login($user);

            return redirect()->route('user_profile');

            // ✅ 直接跳轉到「註冊成功」頁面 (dashboard)
            // return redirect()->route('dashboard')->with('success', '模擬註冊成功');
        }
    }

