<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductSpec extends Model
{
    protected $table = 'product_spec';
    public $timestamps = true;
    public $incrementing = true;

    protected $fillable = [
        'product_id',
        'product_size',
        'product_color',
        'product_stock',
    ];

    // 多對一關聯到 ProductMain（商品）
    public function product(): BelongsTo
    {
        return $this->belongsTo(ProductMain::class, 'product_id', 'product_id');
    }
}
