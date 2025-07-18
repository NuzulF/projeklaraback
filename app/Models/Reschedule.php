<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reschedule extends Model
{
    use HasFactory;

    protected $table = 'reschedule';
    protected $primaryKey = 'id';
    protected $fillable = [
        'jenis_aduan_id',
        'order_id',
        'keranjang_id',
        'user_id',
        'tanggalAwal',
        'tanggalBaru',
        'detail',
        'lampiran',
    ];

    public function jenis_aduan()
    {
        return $this->belongsTo(JenisAduan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function keranjang()
    {
        return $this->belongsTo(Keranjang::class);
    }

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }

    public function reply_aduan()
    {
        return $this->hasOne(ReplyAduan::class);
    }
}
