<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'review'; // nama tabel eksplisit

    protected $fillable = [
        'destinasi_id',
        'reviewer_id',
        'review_text',
        'tanggal',
        'status',
        'rating',
        'jempol',
    ];

    protected $casts = [
        'tanggal' => 'datetime',
        'rating' => 'float',
        'jempol' => 'integer',
    ];

    // Relasi ke Destinasi
    public function destinasi()
    {
        return $this->belongsTo(Destinasi::class);
    }

    // (Opsional) Relasi ke Reviewer
    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewer_id'); // sesuaikan jika model pengguna bukan User
    }

}
