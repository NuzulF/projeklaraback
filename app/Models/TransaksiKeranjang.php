<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiKeranjang extends Model
{
    use HasFactory;

    protected $table = 'transaksi_keranjang';
    protected $primaryKey = 'id';
    protected $fillable = [
        'transaksi_id', 'keranjang_id'
    ];
}
