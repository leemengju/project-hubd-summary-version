<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Coupons extends Model
{
    protected $table = 'coupons';
   
 
    public $timestamps = true;
    public $incrementing = true;

    protected $fillable = [
        'title',
        'description',
        'expiry_date',
        'terms',
        'code',
        'status',
    ];
}
