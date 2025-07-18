<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Tikets extends Model
{
    use HasFactory;

    protected $table = 'tikets';
    protected $primaryKey = 'id';
    protected $fillable = [
        'kode_tiket'
    ];

    public function keranjang()
    {
        return $this->belongsToMany(Keranjang::class, 'keranjang_item')
        ->withPivot('index','paket_wahana_id','paket_destinasi_id','destinasi_id');
    }

    public function status()
    {
        return $this->hasMany(StatusTiket::class);
    }

    public function paketWahana()
    {
        return $this->belongsToMany(Paket::class, 'keranjang_item', 'tikets_id', 'paket_wahana_id')
        ->withPivot('index','paket_destinasi_id','destinasi_id','keranjang_id');
    }

    public function destinasi()
    {
        return $this->belongsToMany(Destinasi::class, 'keranjang_item')
        ->withPivot('index','paket_wahana_id','paket_destinasi_id','keranjang_id');
    }

    public function paketDestinasi()
    {
        return $this->belongsToMany(Paket::class, 'keranjang_item', 'tikets_id', 'paket_destinasi_id')
        ->withPivot('index','paket_wahana_id','destinasi_id','keranjang_id');
    }

    public function wahana()
    {
        return $this->belongsToMany(Wahana::class, 'status_tiket')->withPivot('status_tiket');
    }

    //Cek id tiket
    public function scopeid(Builder $query, int $id): void
    {
        $query->where('id', $id);
    }
}
