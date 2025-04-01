<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\Models\Coupon;
use App\Models\CouponUsage;
use Carbon\Carbon;

class CouponController extends Controller
{
    /**
     * 顯示用戶的優惠券列表
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // 從 session 獲取視圖偏好，如果沒有則使用 list 作為默認值
        $viewPreference = session('couponViewPreference', 'list');
        
        // 獲取當前用戶
        $user = Auth::user();
        
        // 獲取當前日期和時間
        $today = Carbon::now();
        
        // 查詢可用的優惠券（活躍狀態且未過期）
        $activeCouponsQuery = Coupon::where('status', 'active')
            ->where(function($query) use ($today) {
                $query->whereNull('end_date')
                      ->orWhere('end_date', '>=', $today->format('Y-m-d'));
            })
            ->where(function($query) use ($today) {
                $query->whereNull('start_date')
                      ->orWhere('start_date', '<=', $today->format('Y-m-d'));
            });
            
        // 處理用戶特定的優惠券
        $activeCoupons = $activeCouponsQuery->get()
            ->filter(function($coupon) use ($user) {
                // 檢查該優惠券是否可用於當前用戶
                return $coupon->isAvailableForUser($user->id);
            })
            ->map(function($coupon) {
                // 計算剩餘天數並檢查是否即將到期
                $daysLeft = $coupon->getDaysLeftAttribute();
                $isExpiring = $coupon->getIsExpiringAttribute();
                
                return [
                    'id' => $coupon->id,
                    'title' => $coupon->title,
                    'description' => $coupon->description,
                    'expiry_date' => $coupon->end_date ? $coupon->end_date->format('Y/m/d') : '永久有效',
                    'status' => $coupon->calculated_status,
                    'days_left' => $daysLeft,
                    'is_expiring' => $isExpiring
                ];
            })
            ->toArray();
        
        // 查詢已使用的優惠券
        $usedCoupons = CouponUsage::where('user_id', $user->id)
            ->with('coupon')
            ->orderBy('used_at', 'desc')
            ->get()
            ->map(function($usage) {
                return [
                    'id' => $usage->coupon->id,
                    'title' => $usage->coupon->title,
                    'description' => $usage->coupon->description,
                    'expiry_date' => $usage->coupon->end_date ? $usage->coupon->end_date->format('Y/m/d') : '永久有效',
                    'used_date' => $usage->used_at->format('Y/m/d'),
                    'status' => 'used'
                ];
            })
            ->toArray();
        
        // 查詢已過期但未使用的優惠券
        $expiredCoupons = Coupon::where(function($query) use ($today) {
                $query->where('end_date', '<', $today->format('Y-m-d'))
                      ->where('status', 'active');
            })
            ->orWhere('status', 'disabled')
            ->get()
            ->filter(function($coupon) use ($user) {
                // 檢查該優惠券是否適用於當前用戶
                if (!empty($coupon->users)) {
                    $users = is_array($coupon->users) ? $coupon->users : json_decode($coupon->users, true);
                    if (!empty($users)) {
                        $userIds = collect($users)->pluck('id')->toArray();
                        if (!in_array($user->id, $userIds)) {
                            return false;
                        }
                    }
                }
                
                // 確保該優惠券未被用戶使用過
                $used = CouponUsage::where('coupon_id', $coupon->id)
                    ->where('user_id', $user->id)
                    ->exists();
                    
                return !$used;
            })
            ->map(function($coupon) {
                return [
                    'id' => $coupon->id,
                    'title' => $coupon->title,
                    'description' => $coupon->description,
                    'expiry_date' => $coupon->end_date ? $coupon->end_date->format('Y/m/d') : '未設定',
                    'status' => 'expired'
                ];
            })
            ->toArray();
        
        return view('user.coupons', compact('activeCoupons', 'usedCoupons', 'expiredCoupons', 'viewPreference'));
    }
    
    /**
     * 兌換優惠碼
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redeem(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required|string|max:50'
        ]);
        
        $couponCode = $request->input('coupon_code');
        $user = Auth::user();
        
        // 查找優惠碼
        $coupon = Coupon::where('code', $couponCode)->first();
        
        if (!$coupon) {
            return redirect()->route('user.coupons')
                ->with('error', '無效的優惠碼');
        }
        
        // 檢查優惠券是否可用
        if ($coupon->calculated_status !== 'active') {
            return redirect()->route('user.coupons')
                ->with('error', '此優惠碼已過期或尚未啟用');
        }
        
        // 檢查使用限制
        if ($coupon->usage_limit && $coupon->usage_count >= $coupon->usage_limit) {
            return redirect()->route('user.coupons')
                ->with('error', '此優惠碼已達使用上限');
        }
        
        // 檢查是否已使用過
        $hasUsed = CouponUsage::where('coupon_id', $coupon->id)
            ->where('user_id', $user->id)
            ->exists();
            
        if ($hasUsed) {
            return redirect()->route('user.coupons')
                ->with('error', '您已經使用過此優惠碼');
        }
        
        // 檢查是否針對特定用戶
        if (!empty($coupon->users)) {
            $users = is_array($coupon->users) ? $coupon->users : json_decode($coupon->users, true);
            if (!empty($users)) {
                $isUserSpecific = true;
                $userIds = collect($users)->pluck('id')->toArray();
                if (!in_array($user->id, $userIds)) {
                    return redirect()->route('user.coupons')
                        ->with('error', '此優惠碼不適用於您的帳戶');
                }
            }
        }
        
        // 如果所有檢查都通過，則成功兌換
        return redirect()->route('user.coupons')
            ->with('success', "優惠碼 {$couponCode} 兌換成功！");
    }
    
    /**
     * 顯示優惠券詳情
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $user = Auth::user();
        
        // 從資料庫獲取優惠券詳情
        $couponModel = Coupon::findOrFail($id);
        
        // 檢查該優惠券是否適用於當前用戶
        if (!empty($couponModel->users)) {
            $users = is_array($couponModel->users) ? $couponModel->users : json_decode($couponModel->users, true);
            if (!empty($users)) {
                $userIds = collect($users)->pluck('id')->toArray();
                if (!in_array($user->id, $userIds)) {
                    return redirect()->route('user.coupons')
                        ->with('error', '您無權查看此優惠券');
                }
            }
        }
        
        // 檢查該優惠券是否已被使用
        $hasUsed = CouponUsage::where('coupon_id', $id)
            ->where('user_id', $user->id)
            ->exists();
        
        // 準備視圖需要的數據
        $coupon = [
            'id' => $couponModel->id,
            'title' => $couponModel->title,
            'description' => $couponModel->description,
            'expiry_date' => $couponModel->end_date ? $couponModel->end_date->format('Y/m/d') : '永久有效',
            'terms' => $this->getTermsText($couponModel),
            'code' => $couponModel->code,
            'status' => $couponModel->calculated_status,
            'is_used' => $hasUsed
        ];
        
        return view('user.coupon_detail', compact('coupon'));
    }

    /**
     * 切換優惠券顯示視圖
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function switchView(Request $request)
    {
        $viewType = $request->input('view_type', 'list');
        
        // 使用 session 來存儲視圖偏好
        session(['couponViewPreference' => $viewType]);
        
        // 檢查是否為 AJAX 請求
        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }
        
        // 非 AJAX 請求時重定向
        return redirect()->route('user.coupons');
    }
    
    /**
     * 生成優惠券使用條款文字
     *
     * @param Coupon $coupon
     * @return string
     */
    private function getTermsText($coupon)
    {
        $terms = [];
        
        // 描述
        if ($coupon->description) {
            $terms[] = $coupon->description;
        }
        
        // 折扣類型和值
        switch ($coupon->discount_type) {
            case 'percentage':
                $terms[] = "享 {$coupon->discount_value}% 折扣";
                break;
            case 'fixed':
                $terms[] = "折抵 NT$ {$coupon->discount_value}";
                break;
            case 'shipping':
                $terms[] = "免運費優惠";
                break;
            case 'buy_x_get_y':
                $terms[] = "買 {$coupon->buy_quantity} 件送 {$coupon->free_quantity} 件";
                break;
        }
        
        // 最低消費
        if ($coupon->min_purchase) {
            $terms[] = "最低消費 NT$ {$coupon->min_purchase}";
        }
        
        // 使用限制
        if ($coupon->usage_limit == 1) {
            $terms[] = "每個帳號限用一次";
        } elseif ($coupon->usage_limit > 1) {
            $terms[] = "每個帳號最多可使用 {$coupon->usage_limit} 次";
        }
        
        // 是否可與其他優惠合併使用
        if ($coupon->can_combine) {
            $terms[] = "可與其他優惠同時使用";
        } else {
            $terms[] = "不可與其他優惠同時使用";
        }
        
        // 有效期限
        if ($coupon->start_date && $coupon->end_date) {
            $startDate = $coupon->start_date->format('Y/m/d');
            $endDate = $coupon->end_date->format('Y/m/d');
            $terms[] = "有效期限：{$startDate} 至 {$endDate}";
        } elseif ($coupon->end_date) {
            $endDate = $coupon->end_date->format('Y/m/d');
            $terms[] = "使用期限至 {$endDate}";
        } elseif ($coupon->start_date) {
            $startDate = $coupon->start_date->format('Y/m/d');
            $terms[] = "{$startDate} 起可使用";
        }
        
        // 適用商品/分類限制
        if (!empty($coupon->products) || !empty($coupon->categories) || 
            !empty($coupon->applicable_products) || !empty($coupon->applicable_categories)) {
            $terms[] = "限指定商品/分類使用，詳情請見商品頁面";
        }
        
        return implode("\n", $terms);
    }
} 