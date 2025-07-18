<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiItem extends Model
{
    use HasFactory;

    protected $table = 'transaksi_item';
    protected $primaryKey = 'id';
    protected $fillable = [
        'destinasi_id', 'wahana_id', 'paket_id', 'transaksi_id', 'jumlah_tiket', 'tanggal_kunjungan'
    ];
}
