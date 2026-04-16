<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $fillable = [
        'code',
        'type',
        'value',
        'limit',
        'used',
        'expires_at',
        'is_active',
    ];
}
