<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Destinasi extends Model
{
    use HasFactory;

    protected $table = 'destinasi';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_destinasi', 'kategori_id', 'foto_destinasi', 'logo', 'province_id', 'regency_id',
        'district_id', 'village_id', 'deskripsi_destinasi', 'maps_destinasi', 'maps_zoom',
        'alamat_destinasi', 'htm_destinasi', 'approve','aktif'
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }
    
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function regency()
    {
        return $this->belongsTo(Regency::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function village()
    {
        return $this->belongsTo(Village::class);
    }

    public function wahana()
    {
        return $this->hasMany(Wahana::class);
    }

    public function paket()
    {
        return $this->belongsToMany(Paket::class, 'paket_destinasi');
    }

    public function paketWahana()
    {
        return $this->hasMany(Paket::class);
    }

    public function keranjang()
    {
        return $this->belongsToMany(Keranjang::class, 'keranjang_item')
                    ->withPivot('index','paket_wahana_id','paket_destinasi_id','tikets_id');
    }

    public function tikets()
    {
        return $this->belongsToMany(Tikets::class, 'keranjang_item')
                    ->withPivot('index','paket_wahana_id','paket_destinasi_id','keranjang_id');
    }

    public function keranjangPaketDestinasi()
    {
        return $this->belongsToMany(Paket::class, 'keranjang_item','destinasi_id','paket_destinasi_id')
                    ->withPivot('index','paket_wahana_id','tikets_id','keranjang_id');
    }

    public function keranjangPaketWahana()
    {
        return $this->belongsToMany(Paket::class, 'keranjang_item','destinasi_id','paket_wahana_id')
                    ->withPivot('index','paket_destinasi_id','tikets_id','keranjang_id');
    }

    //Cek id destinasi
    public function scopeid(Builder $query, $id): void
    {
        $query->where('id', $id);
    }

    //Cek apakah destinasi aktif
    public function scopeaktif(Builder $query): void
    {
        $query->where('aktif', true);
    }

    //Cek apakah destinasi di approve
    public function scopeapprove(Builder $query): void
    {
        $query->where('approve', '1');
    }
}
