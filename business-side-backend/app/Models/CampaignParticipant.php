<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignParticipant extends Model
{
    use HasFactory;

    protected $fillable = [
        'campaign_id',
        'user_id',
        'order_id',
        'joined_at',
        'status',
        'discount_amount',
        'note'
    ];

    protected $casts = [
        'discount_amount' => 'decimal:2',
        'joined_at' => 'datetime',
    ];

    /**
     * 關聯到行銷活動
     */
    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    /**
     * 關聯到用戶
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 關聯到訂單（如果存在）
     */
    public function order()
    {
        // 如果有訂單模型，請取消註釋並使用正確的模型名稱
        // return $this->belongsTo(Order::class);
        return null;
    }
} 