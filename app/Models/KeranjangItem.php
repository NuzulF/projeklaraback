<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeranjangItem extends Model
{
    use HasFactory;

    protected $table = 'keranjang_item';
    protected $primaryKey = 'id';
    protected $fillable = [
        'keranjang_id', 'destinasi_id', 'paket_destinasi_id', 'paket_wahana_id', 'index', 'tiket_id'
    ];

    public function keranjang()
    {
        return $this->belongsTo(Keranjang::class);
    }

    public function destinasi()
    {
        return $this->belongsTo(Destinasi::class);
    }
}
