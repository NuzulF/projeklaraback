<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusTiket extends Model
{
    use HasFactory;

    protected $table = 'status_tiket';
    protected $primaryKey = 'id';
    protected $fillable = [
        'tikets_id', 'wahana_id', 'status_tiket'
    ];
}
