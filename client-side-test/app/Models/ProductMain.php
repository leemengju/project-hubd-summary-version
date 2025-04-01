<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductMain extends Model
{
    protected $table = 'product_main';
    protected $primaryKey = 'product_id';
    protected $keyType = 'string';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'product_id',
        'category_id',
        'product_name',
        'product_price',
        'product_description',
        'product_img'
    ];

    // 一對多關聯到 ProductSpec（規格）
    public function specs(): HasMany
    {
        return $this->hasMany(ProductSpec::class, 'product_id', 'product_id');
    }

    public function information(): HasMany
    {
        return $this->hasMany(ProductInformation::class, 'product_id', 'product_id');
    }

    public function wishlists(): HasMany
    {
        return $this->hasMany(Wishlist::class, 'product_id'); //關聯wishlist Model  收藏清單用的
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImg::class, 'product_id', 'product_id');
    }

    public function displayImages(): HasMany
    {
        return $this->hasMany(ProductDisplayImg::class, 'product_id', 'product_id');
    }
}
