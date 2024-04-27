<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DetailPenjualan extends Model
{
    use HasFactory;

    protected $table = 'detailpenjualan';

    protected $primaryKey = 'detailID';

    protected $fillable = [
        'penjualanID',
        'produkID',
        'jumlah',
        'subtotal'
    ];

    public function penjualan(): BelongsTo {
        return $this->belongsTo(Penjualan::class, 'penjualanID', 'penjualanID');
    }

    public function produk(): HasOne {
        return $this->hasOne(Produk::class, 'produkID', 'produkID');
    }
}
