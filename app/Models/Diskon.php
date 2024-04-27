<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diskon extends Model
{
    use HasFactory;

    protected $table = 'diskon';

    protected $primaryKey = 'diskonID';

    protected $fillable = [
        'nominal',
        'persen'
    ];

    // public function user(): BelongsTo {
    //     return $this->belongsTo(User::class, 'userID', 'userID');
    // }
}
