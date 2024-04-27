<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LogStok extends Model
{
    use HasFactory;

    protected $table = 'log_stok';

    protected $primaryKey = 'detailLog';

    protected $fillable = [
        'produkID',
        'jumlah',
        'aksi',
    ];

    public function produk(): BelongsTo {
        return $this->belongsTo(Produk::class, 'produkID', 'produkID');
    }
}
