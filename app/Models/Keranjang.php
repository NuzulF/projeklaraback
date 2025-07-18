<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Keranjang extends Model
{
    use HasFactory;

    protected $table = 'keranjang';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id', 'tipe','jumlah', 'total_pembayaran',
        'tanggal_kunjungan', 'status_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->belongsTo(StatusKeranjang::class);
    }

    public function transaksi()
    {
        return $this->belongsToMany(Transaksi::class, 'transaksi_keranjang');
    }

    public function paketWahana()
    {
        return $this->belongsToMany(Paket::class, 'keranjang_item', 'keranjang_id', 'paket_wahana_id')
            ->withPivot('index','destinasi_id','paket_destinasi_id','tikets_id');
    }

    public function destinasi()
    {
        return $this->belongsToMany(Destinasi::class, 'keranjang_item')
            ->withPivot('index','paket_wahana_id','paket_destinasi_id','tikets_id');
    }

    public function paketDestinasi()
    {
        return $this->belongsToMany(Paket::class, 'keranjang_item', 'keranjang_id', 'paket_destinasi_id')
            ->withPivot('index','destinasi_id','paket_wahana_id','tikets_id');
    }

    public function tikets()
    {
        return $this->belongsToMany(Tikets::class, 'keranjang_item')
            ->withPivot('index','destinasi_id','paket_wahana_id','paket_destinasi_id');
    }

    public function reschedule()
    {
        return $this->hasMany(Reschedule::class);
    }

    public function keranjangItem()
    {
        return $this->hasMany(KeranjangItem::class);
    }

    //Cek status keranjang
    public function scopestatus(Builder $query, $id) : void
    {
        $query->where('status_id', $id);
    }
}
