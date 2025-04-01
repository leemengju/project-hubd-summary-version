<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'product_id', 'create_time'];
    public $timestamps = false; // 因為我們用的是 create_time，Laravel 預設的 timestamps 不需要

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    // 定義關聯：讓 Wishlist 可以直接存取 Product
    public function product()
    {
        return $this->belongsTo(ProductMain::class, 'product_id', 'product_id');
    }
}
