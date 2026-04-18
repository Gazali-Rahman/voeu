<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class rsvp extends Model
{
    protected $fillable = [
        'invitation_id',
        'name',
        'attendance',
        'message',
    ];

    /**
     * Relasi ke Undangan
     */
    public function invitation(): BelongsTo
    {
        return $this->belongsTo(Invitation::class);
    }
}
