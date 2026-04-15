<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinancialTransaction extends Model
{
    protected $fillable = [
        'date',
        'description',
        'type',
        'amount',
        'category',
        'note',
    ];

    protected $casts = [
        'date' => 'date',
    ];
}
