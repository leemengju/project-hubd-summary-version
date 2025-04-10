<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Codec\TimestampLastCombCodec;

class Banner extends Model
{
    protected $table = 'banner';
    protected $primaryKey = 'banner_id';
    protected $keyType = 'string';
    public $timestamps = true;
    public $incrementing = true;

    protected $fillable = [
        'banner_title',
        'banner_img',
        'banner_description',
        'banner_link',
    ];
}
