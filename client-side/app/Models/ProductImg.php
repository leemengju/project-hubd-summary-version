<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImg extends Model
{
    
    protected $table = 'product_img';
    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'product_img_URL',
        'product_display_order',
        'product_alt_text',
    ];
}


