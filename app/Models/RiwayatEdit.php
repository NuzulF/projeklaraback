<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatEdit extends Model
{
    use HasFactory;

    protected $table = 'riwayat_edit';
    protected $primaryKey = 'id';
    protected $fillable = [
        'admin_id', 'bagian', 'aksi', 'deskripsi'
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id', 'id');
    }
}
