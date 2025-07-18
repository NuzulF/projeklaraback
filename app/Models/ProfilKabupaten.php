<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilKabupaten extends Model
{
    use HasFactory;

    protected $table = 'profil_kabupaten';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_kabupaten', 'foto_kabupaten', 'admin_id', 'province_id', 'regency_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function regency()
    {
        return $this->belongsTo(Regency::class);
    }
}
