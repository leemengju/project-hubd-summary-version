<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    use HasFactory;

    protected $table = 'cart'; // 确保模型与表名一致
    protected $fillable = [ 'product_id', 'quantity', 'product_color', 'product_size','id']; // 填充属性

    public $timestamps = false;
}
