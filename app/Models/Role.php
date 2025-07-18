<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Role extends Model
{
    use HasFactory;

    protected $table = 'role';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_role'
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }

    //Cek bila role bukan pengunjung
    public function scopenotPengunjung(Builder $query)
    {
        return $query->where('id', '!=', 5);
    }
}
