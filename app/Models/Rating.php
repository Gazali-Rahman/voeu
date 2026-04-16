<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [
        'order_id',
        'catalog_id',
        'user_id',
        'stars',
        'comment'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function catalog()
    {
        return $this->belongsTo(Catalog::class);
    }
}
