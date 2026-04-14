<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'external_id',
        'user_id',
        'catalog_id',
        'customer_name',
        'customer_phone',
        'groom_name',
        'bride_name',
        'slug',
        'amount',
        'status',
        'checkout_url',
    ];

    public function catalog()
    {
        return $this->belongsTo(Catalog::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
