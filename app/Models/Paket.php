<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Paket extends Model
{
    use HasFactory;

    protected $table = 'paket';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_paket', 'harga_paket', 'jenis', 'destinasi_id', 'aktif'
    ];

    public function fromDestinasi()
    {
        return $this->belongsTo(Destinasi::class);
    }

    public function destinasi()
    {
        return $this->belongsToMany(Destinasi::class, 'paket_destinasi');
    }

    public function wahana()
    {
        return $this->belongsToMany(Wahana::class, 'paket_wahana');
    }

    public function keranjangDestinasi()
    {
        return $this->belongsToMany(Keranjang::class, 'keranjang_item','paket_destinasi_id','keranjang_id')
        ->withPivot('index','paket_wahana_id','destinasi_id','tikets_id');
    }

    public function keranjangWahana()
    {
        return $this->belongsToMany(Keranjang::class, 'keranjang_item','paket_wahana_id','keranjang_id')
        ->withPivot('index','paket_destinasi_id','destinasi_id','tikets_id');
    }

    public function tiketDestinasi()
    {
        return $this->belongsToMany(Keranjang::class, 'keranjang_item','paket_destinasi_id','tikets_id')
        ->withPivot('index','paket_wahana_id','destinasi_id','keranjang_id');
    }

    public function tiketWahana()
    {
        return $this->belongsToMany(Keranjang::class, 'keranjang_item','paket_wahana_id','tikets_id')
        ->withPivot('index','paket_destinasi_id','destinasi_id','keranjang_id');
    }

    public function destinasiDestinasi() {
        return $this->belongsToMany(Destinasi::class, 'keranjang_item', 'paket_destinasi_id', 'destinasi_id')
        ->withPivot('index','paket_wahana_id','keranjang_id','tikets_id');
    }

    public function wahanaDestinasi() {
        return $this->belongsToMany(Destinasi::class, 'keranjang_item', 'paket_wahana_id', 'destinasi_id')
        ->withPivot('index','paket_destinasi_id','keranjang_id','tikets_id');
    }

    //Cek id paket
    public function scopeid(Builder $query, $id): void
    {
        $query->where('id', $id);
    }

    //Cek bila paket memiliki destinasi aktif
    public function scopedestinasiAktif(Builder $query): void
    {
        $query->whereHas('destinasi', function ($query) {
            $query->where('aktif', true);
        });
    }

    //Cek desa dari paket wahana
    public function scopeisVillage(Builder $query, $village): void
    {
        $query->where(function ($query) use ($village) {
            // Mencari paket melalui relasi 'destinasi'.
            $query->whereHas('destinasi', function ($subquery) use ($village) {
                $subquery->whereHas('village', function ($subsubquery) use ($village) {
                    $subsubquery->where('id', $village->id);
                })
                    ->where('aktif', true); // Kondisi "Aktif" pada destinasi
            })
                ->where('aktif', true); // Kondisi "Aktif" pada paket
        });
    }

    //Cek destinasi dari paket wahana
    public function scopeisDestinasiByWahana(Builder $query, $destinasi): void
    {
        $query->where(function ($subquery) use ($destinasi) {
            $subquery->whereHas('wahana', function ($subsubquery) use ($destinasi) {
                $subsubquery->whereHas('destinasi', function ($subsubsubquery) use ($destinasi) {
                    $subsubsubquery->where('id', $destinasi->id)->where('aktif', true); // Kondisi "Aktif" pada destinasi
                })->where('aktif', true); // Kondisi "Aktif" pada wahana
            });
        });
    }

    //Cek bila paket aktif
    public function scopeaktif(Builder $query): void
    {
        $query->where('aktif', true);
    }

    //Cek bila paket merupakan paket destinasi
    public function scopeisDestinasi(Builder $query): void
    {
        $query->where('jenis', 'destinasi');
    }

    //Cek bila paket merupakan paket wahana
    public function scopeisWahana(Builder $query): void
    {
        $query->where('jenis', 'wahana');
    }
}

