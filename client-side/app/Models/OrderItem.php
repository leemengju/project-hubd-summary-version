<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'order_detail';
    
    /**
     * 定義與 Order 的關聯
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }
} 