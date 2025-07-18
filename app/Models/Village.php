<?php

/*
 * This file is part of the IndoRegion package.
 *
 * (c) Azis Hapidin <azishapidin.com | azishapidin@gmail.com>
 *
 */

namespace App\Models;

use AzisHapidin\IndoRegion\Traits\VillageTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * Village Model.
 */
class Village extends Model
{
    use VillageTrait;

    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'villages';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $fillable = [
        'district_id'
    ];

    /**
     * Village belongs to District.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function district()
    {
        return $this->belongsTo(District::class);
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
        return $this->hasOne(ProfilDesa::class);
    }

    //Cek id desa
    public function scopeid(Builder $query, $id): void
    {
        $query->where('id', $id);
    }
    //Cek apakah desa memiliki destinasi aktif
    public function scopedestinasiAktif(Builder $query): void
    {
        $query->whereHas('destinasi', function ($query) {
            $query->where('aktif', true);
        });
    }

    //Cek id kabupaten/kota dari desa
    public function scopeisKabupaten(Builder $query, $id): void
    {
        $query->whereHas('district', function ($query) use ($id) {
            $query->where('regency_id', $id);
        });
    }
}
