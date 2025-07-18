<?php

/*
 * This file is part of the IndoRegion package.
 *
 * (c) Azis Hapidin <azishapidin.com | azishapidin@gmail.com>
 *
 */

namespace App\Models;

use AzisHapidin\IndoRegion\Traits\RegencyTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * Regency Model.
 */
class Regency extends Model
{
    use RegencyTrait;

    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'regencies';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'province_id'
    ];

    /**
     * Regency belongs to Province.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    /**
     * Regency has many districts.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function district()
    {
        return $this->hasMany(District::class);
    }

    public function destinasi()
    {
        return $this->hasMany(Destinasi::class);
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function profilDesa()
    {
        return $this->hasMany(ProfilDesa::class);
    }

    public function profilKabupaten()
    {
        return $this->hasOne(ProfilKabupaten::class);
    }

    // Cek apakah Kabupaten/Kota memiliki destinasi yang aktif
    public function scopedestinasiAktif(Builder $query): void
    {
        $query->whereHas('district.destinasi', function ($query) {
            $query->where('aktif', true); // Menambahkan kondisi ini untuk memeriksa 'aktif'
        });
    }

    // Cek id kabupaten/kota
    public function scopeid(Builder $query, $id): void
    {
        $query->where('id', $id);
    }
}
