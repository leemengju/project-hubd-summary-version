<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductInformation extends Model
{
    protected $table = 'product_information';
    public $timestamps = true;

    protected $fillable = [
        'product_id',
        'title',
        'content',
    ];
}
