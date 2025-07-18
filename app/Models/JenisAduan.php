<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisAduan extends Model
{
    use HasFactory;

    protected $table = 'jenis_aduan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama', 'status'
    ];

    public function refund()
    {
        return $this->hasMany(Refund::class);
    }

    public function reschedule()
    {
        return $this->hasMany(Reschedule::class);
    }
}
