<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invitation extends Model
{
    /**
     * Properti yang bisa diisi massal (mass assignable).
     */
    protected $fillable = [
        'order_id',
        'catalog_id',
        'slug',
        'content',
        'is_active',
    ];

    /**
     * Casting atribut.
     * Sangat penting agar kolom 'content' otomatis menjadi array saat dipanggil,
     * dan otomatis menjadi JSON saat disimpan ke database.
     */
    protected $casts = [
        'content' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Relasi ke model Order.
     * Setiap undangan pasti berasal dari satu pesanan.
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Relasi ke model Catalog.
     * Undangan ini menggunakan template yang ada di katalog.
     */
    public function catalog(): BelongsTo
    {
        return $this->belongsTo(Catalog::class);
    }
    public function getPhoto($label)
    {
        $photo = collect($this->content['dynamic_photos'] ?? [])->firstWhere('label', $label);
        return $photo ? asset('storage/' . $photo['path']) : asset('assets/img/placeholder.png');
    }
    public function getMusic()
    {
        return isset($this->content['music'])
            ? asset('storage/' . $this->content['music'])
            : null;
    }
    public function rsvps(): HasMany
    {
        return $this->hasMany(rsvp::class);
    }
}
