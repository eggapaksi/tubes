<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
    use Illuminate\Database\Eloquent\Relations\HasMany;

class Booking extends Model
{
    
    protected $table = 'bookings'; // GANTI sesuai nama tabel asli
    protected $primaryKey = 'id_booking'; // ← SESUAIKAN
    public $incrementing = true;
    protected $keyType = 'int';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function katalog(): BelongsTo
    {
        return $this->belongsTo(Katalog::class);
    }

    public function invoice(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    protected $fillable = [
    'user_id',
    'nama_pemesan',
    'nama_katalog',
    "tanggal_booking",
    'jumlah',
    'total_biaya',
    // 'metode_pembayaran',
    'catatan',
    'status_pembayaran'
    

    ];
}
