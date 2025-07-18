<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class JenisPembayaran extends Model
{
    use HasFactory;

    protected $table = 'jenis_pembayaran';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama',
        'kode',
        'enabled_payment',
        'identifikasi_transaksi',
        'id_parent_jenis_pembayaran',
        'status'
    ];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }
    
    public function parent()
    {
        return $this->belongsTo(JenisPembayaran::class, 'id_parent_jenis_pembayaran');
    }

    public function children()
    {
        return $this->hasMany(JenisPembayaran::class, 'id_parent_jenis_pembayaran');
    }

    //Cek apakah jenis pembayaran aktif
    public function scopeaktif(Builder $query): void
    {
        $query->where('status', true);
    }

    //Cek apakah jenis pembayaran adalah enabled payment
    public function scopeenabledPayment(Builder $query): void
    {
        $query->where('enabled_payment', true);
    }

    //Cek apakah jenis pembayaran adalah identifikasi transaksi
    public function scopeidentifikasiTransaksi(Builder $query): void
    {
        $query->where('identifikasi_transaksi', true);
    }

    //Cek kode
    public function scopekode(Builder $query, string $kode): void
    {
        $query->where('kode', $kode);
    }
}
