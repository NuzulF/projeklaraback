<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketWahana extends Model
{
    use HasFactory;

    protected $table = 'paket_wahana';
    protected $primaryKey = 'id';
    protected $fillable = [
        'wahana_id', 'paket_id'
    ];
}
