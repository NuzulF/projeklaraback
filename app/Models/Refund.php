<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    use HasFactory;

    protected $table = 'refund';
    protected $primaryKey = 'id';
    protected $fillable = [
        'jenis_aduan_id',
        'order_id',
        'user_id',
        'detail',
        'tindakan_diinginkan',
        'lampiran',
    ];
}
