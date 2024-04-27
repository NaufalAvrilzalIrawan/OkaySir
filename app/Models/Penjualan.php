<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Penjualan extends Model
{
    use HasFactory;
    
    protected $table = 'penjualan';

    protected $primaryKey = 'penjualanID';

    protected $fillable = [
        'userID',
        'tanggal',
        'namaMember',
        'total',
        'totalAkhir',
        'bayar',
        'kembalian'
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'userID', 'userID');
    }

    public function detailPenjualan(): HasMany {
        return $this->hasMany(DetailPenjualan::class, 'penjualanID', 'penjualanID');
    }

    public function nomor($no) {
        return number_format($no, 2, ',', '.');
    }
}
