<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Wahana extends Model
{
    use HasFactory;

    protected $table = 'wahana';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_wahana', 'foto_wahana', 'htm_wahana',
        'destinasi_id', 'aktif', 'deskripsi_wahana'
    ];

    public function destinasi()
    {
        return $this->belongsTo(Destinasi::class);
    }

    public function paket()
    {
        return $this->belongsToMany(Paket::class, 'paket_wahana');
    }

    public function tikets()
    {
        return $this->belongsToMany(Tikets::class, 'status_tiket')
        ->withPivot('status_tiket','id');
    }

    //Cek id wahana
    public function scopeid(Builder $query, $id) :void
    {
        $query->where('id', $id);
    }

    //Cek apakah wahana aktif
    public function scopeaktif(Builder $query): void
    {
        $query->where('aktif', true);
    }
}
