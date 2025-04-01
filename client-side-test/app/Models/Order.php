<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order_main';
    protected $primaryKey = 'order_id';
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * 定義與 User 的關聯
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    /**
     * 定義與 OrderItem 的關聯
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'order_id');
    }

    /**
     * 獲取訂單狀態的中文名稱
     */
    public function getStatusNameAttribute()
    {
        $statusMap = [
            'pending' => '待付款',
            'processing' => '處理中',
            'shipped' => '已出貨',
            'completed' => '已完成',
            'cancelled' => '已取消',
            'refunded' => '已退款'
        ];

        return $statusMap[$this->trade_status] ?? $this->trade_status;
    }

    /**
     * 獲取付款方式的中文名稱
     */
    public function getPaymentMethodNameAttribute()
    {
        $methodMap = [
            'credit_card' => '信用卡',
            'line_pay' => 'LINE Pay',
            'bank_transfer' => '銀行轉帳',
            'cash' => '現金'
        ];

        return $methodMap[$this->payment_type] ?? $this->payment_type;
    }
} 