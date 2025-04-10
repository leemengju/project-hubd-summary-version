<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponUsage extends Model
{
    use HasFactory;

    protected $fillable = [
        'coupon_id',
        'user_id',
        'order_id',
        'discount_amount',
        'used_at',
        'note'
    ];

    protected $casts = [
        'discount_amount' => 'decimal:2',
        'used_at' => 'datetime',
    ];

    /**
     * 關聯到優惠券
     */
    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    /**
     * 關聯到用戶
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 關聯到訂單
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
