<?php

/*
 * This file is part of the IndoRegion package.
 *
 * (c) Azis Hapidin <azishapidin.com | azishapidin@gmail.com>
 *
 */

namespace App\Models;

use AzisHapidin\IndoRegion\Traits\ProvinceTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * Province Model.
 */
class Province extends Model
{
    use ProvinceTrait;
    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'provinces';

    /**
     * Province has many regencies.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function regency()
    {
        return $this->hasMany(Regency::class);
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
        return $this->hasMany(ProfilKabupaten::class);
    }
}
