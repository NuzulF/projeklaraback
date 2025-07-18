<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_pemesan', 'email_pemesan', 'no_telp_pemesan',
        'user_id', 'total_pembayaran', 'jenis_pembayaran_id',
        'status', 'order_id'
    ];

    public function jenisPembayaran()
    {
        return $this->belongsTo(JenisPembayaran::class);
    }

    public function keranjang()
    {
        return $this->belongsToMany(Keranjang::class, 'transaksi_keranjang');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Cek kabupaten transaksi
    public function scopeisKabupaten(Builder $query, $kabupaten) :void
    {
        $query->where(function ($subquery) use ($kabupaten) {
            $subquery->whereHas('keranjang.destinasi.regency', function ($subsubquery) use ($kabupaten) {
                $subsubquery->where('regencies.id', $kabupaten->id);
            });
        });
    }

    //Cek desa transaksi
    public function scopeisDesa(Builder $query, $desa) :void
    {
        $query->where(function ($subquery) use ($desa) {
            $subquery->whereHas('keranjang.destinasi.village', function ($subsubquery) use ($desa) {
                $subsubquery->where('villages.id', $desa->id);
            });
        });
    }

    //Cek salah satu destinasi transaksi
    public function scopeisDestinasi(Builder $query, $destinasi) :void
    {
        $query->where(function ($subquery) use ($destinasi) {
            $subquery->whereHas('keranjang.destinasi', function ($subsubquery) use ($destinasi) {
                $subsubquery->where('destinasi.id', $destinasi->id);
            });
        });
    }
}
