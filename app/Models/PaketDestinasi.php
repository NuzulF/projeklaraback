<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketDestinasi extends Model
{
    use HasFactory;

    protected $table = 'paket_destinasi';
    protected $primaryKey = 'id';
    protected $fillable = [
        'destinasi_id', 'paket_id'
    ];
}
