<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $table = 'member';
    
    protected $primaryKey = 'memberID';

    protected $fillable = [
        'nama',
        'alamat',
        'nomorTelepon'
    ];
}
