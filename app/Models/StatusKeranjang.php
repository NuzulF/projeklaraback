<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusKeranjang extends Model
{
    use HasFactory;

    protected $table = 'status_keranjang';
    protected $primaryKey = 'id';
    protected $fillable = [
        'status'
    ];

    public function keranjang()
    {
        return $this->hasMany(Keranjang::class);
    }
}
