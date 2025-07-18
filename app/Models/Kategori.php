<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_kategori', 'icon', 'deskripsi','aktif'
    ];

    public function destinasi()
    {
        return $this->hasMany(Destinasi::class);
    }

    //Cek id kategori
    public function scopeid(Builder $query, int $id): void
    {
        $query->where('id', $id);
    }
    //Cek apakah kategori aktif
    public function scopeaktif(Builder $query): void
    {
        $query->where('aktif', true);
    }
}
