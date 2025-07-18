<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ProfilDesa extends Model
{
    use HasFactory;

    protected $table = 'profil_desa';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_desa', 'foto_desa', 'deskripsi_desa', 'alamat_desa', 'admin_id', 'province_id', 'regency_id', 'district_id', 'village_id'
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

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function village()
    {
        return $this->belongsTo(Village::class);
    }

    //Check if village have destinasi aktif
    public function scopedestinasiAktif(Builder $query) :void
    {
        $query->whereHas('village.destinasi', function ($query) {
            $query->where('aktif', true);
        });
    }

}
