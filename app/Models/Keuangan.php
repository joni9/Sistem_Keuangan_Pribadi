<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keuangan extends Model
{
    use HasFactory;
    protected $primaryKey = 'id'; // set primary key to 'id'
    public $incrementing = false; // set auto-increment to false
    protected $keyType = 'string'; // set primary key data type to 'string'
    protected $fillable = [
        'id',
        'nominal',
        'jenis',
        'keterangan',
        'user_id',
    ];
}
