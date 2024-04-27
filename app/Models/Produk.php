<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $primaryKey = 'produkID';

    protected $fillable = [
        'nama',
        'harga',
        'stok',
    ];

    public function detailPenjualan(): BelongsTo {
        return $this->belongsTo(DetailPenjualan::class, 'produkID', 'produkID');
    }
    
    public function logStok(): HasMany {
        return $this->hasMany(LogStok::class, 'produkID', 'produkID');
    }
}
