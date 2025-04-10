<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'code',
        'discount_type',
        'discount_value',
        'min_purchase',
        'start_date',
        'end_date',
        'usage_limit',
        'description',
        'products',
        'categories',
        'users',
        'applicable_products',
        'applicable_categories',
        'buy_quantity',
        'free_quantity',
        'status',
        'can_combine',
        'usage_count'
    ];

    protected $casts = [
        'products' => 'array',
        'categories' => 'array',
        'users' => 'array',
        'applicable_products' => 'array',
        'applicable_categories' => 'array',
        'start_date' => 'date',
        'end_date' => 'date',
        'discount_value' => 'decimal:2',
        'min_purchase' => 'decimal:2',
        'usage_limit' => 'integer',
        'buy_quantity' => 'integer',
        'free_quantity' => 'integer',
        'can_combine' => 'boolean',
        'usage_count' => 'integer',
    ];

    protected $appends = ['calculated_status'];

    /**
     * 獲取優惠券的計算狀態
     */
    public function getCalculatedStatusAttribute()
    {
        // 如果已手動設置為停用
        if ($this->status === 'disabled') {
            return 'disabled';
        }

        $now = Carbon::now();
        $startDate = $this->start_date ? Carbon::parse($this->start_date) : null;
        $endDate = $this->end_date ? Carbon::parse($this->end_date) : null;

        // 檢查是否已過期
        if ($endDate && $now->greaterThan($endDate)) {
            return 'expired';
        }
        
        // 檢查是否尚未開始
        if ($startDate && $now->lessThan($startDate)) {
            return 'scheduled';
        }
        
        // 其他情況為啟用狀態
        return 'active';
    }
    
    /**
     * 關聯到使用記錄
     */
    public function usages()
    {
        return $this->hasMany(CouponUsage::class);
    }
    
    /**
     * 檢查優惠券是否可用於特定用戶
     */
    public function isAvailableForUser($userId = null)
    {
        // 檢查基本狀態
        if ($this->calculated_status !== 'active') {
            return false;
        }
        
        // 檢查使用限制
        if ($this->usage_limit && $this->usage_count >= $this->usage_limit) {
            return false;
        }
        
        // 檢查是否限定用戶
        if ($userId && !empty($this->users)) {
            $users = is_array($this->users) ? $this->users : json_decode($this->users, true);
            
            // 檢查用戶 ID 是否在允許的用戶列表中
            if (!empty($users) && !$this->isUserInList($userId, $users)) {
                return false;
            }
        }
        
        return true;
    }
    
    /**
     * 檢查用戶是否在優惠券的用戶列表中
     */
    private function isUserInList($userId, $users)
    {
        if (empty($users)) {
            return true;  // 空列表表示對所有用戶開放
        }
        
        foreach ($users as $user) {
            if (is_array($user) && isset($user['id']) && $user['id'] == $userId) {
                return true;
            } elseif (!is_array($user) && $user == $userId) {
                return true;
            }
        }
        
        return false;
    }
    
    /**
     * 計算優惠券到期還剩幾天
     */
    public function getDaysLeftAttribute()
    {
        if (!$this->end_date) {
            return null;  // 沒有結束日期
        }
        
        $today = Carbon::now()->startOfDay();
        $endDate = Carbon::parse($this->end_date)->startOfDay();
        
        return $today->diffInDays($endDate, false);
    }
    
    /**
     * 判斷優惠券是否即將到期（7天內）
     */
    public function getIsExpiringAttribute()
    {
        $daysLeft = $this->getDaysLeftAttribute();
        
        if ($daysLeft === null) {
            return false;
        }
        
        return $daysLeft >= 0 && $daysLeft <= 7;
    }
} 