<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReplyAduan extends Model
{
    use HasFactory;

    protected $table = 'reply_aduan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'admin_id', 'reschedule_id', 'jawaban'
    ];

    public function admin()
    {
        return $this->belongsTo(User::class);
    }

    public function reschedule()
    {
        return $this->belongsTo(Reschedule::class);
    }
}
