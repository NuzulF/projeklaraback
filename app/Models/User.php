<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Builder;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'role_id',
        'province_id',
        'regency_id',
        'district_id',
        'village_id',
        'destinasi_id',
        'aktif',
        'edit_admin_desa',
        'approve_wisata',
        'tambah_edit_admin_destinasi',
        'mengajukan_destinasi',
        'konfirmasi_tiket',
        'verifikasi_token',
        'forgot_password_token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function socialAccounts()
    {
        return $this->hasMany(SocialAccount::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function regency()
    {
        return $this->belongsTo(Regency::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function village()
    {
        return $this->belongsTo(Village::class);
    }

    public function destinasi()
    {
        return $this->belongsTo(Destinasi::class);
    }

    public function profilKabupaten()
    {
        return $this->hasMany(ProfilKabupaten::class, 'admin_id');
    }

    public function profilDesa()
    {
        return $this->hasMany(ProfilDesa::class, 'admin_id');
    }
    
    public function keranjang()
    {
        return $this->hasMany(Keranjang::class);
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }

    public function riwayatEdit()
    {
        return $this->hasMany(RiwayatEdit::class);
    }

    //Cek apakah user terautentikasi
    public function scopeisAuth(Builder $query): void
    {
        $user_id = optional(auth()->user())->id;
        $query->where('id', $user_id);
    }

    //Cek apakah user aktif
    public function scopeaktif(Builder $query): void
    {
        $query->where('aktif', true);
    }

    //Cek apakah user admin desa
    public function scopeisAdminDesa(Builder $query): void
    {
        $query->where('role_id', 3);
    }

    //Cek apakah user admin destinasi
    public function scopeisAdminDestinasi(Builder $query): void
    {
        $query->where('role_id', 4);
    }

    //Cek apakah user admin kabupaten
    public function scopeisAdminKabupaten(Builder $query): void
    {
        $query->where('role_id', 2);
    }

    //Cek apakah user admin super
    public function scopeisSuperadmin(Builder $query): void
    {
        $query->where('role_id', 1);
    }

    //Cek apakah user pengunjung
    public function scopeisPengunjung(Builder $query): void
    {
        $query->where('role_id', 5);
    }
}
