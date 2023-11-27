<?php

namespace App\Models;

use App\Models\Bank;
use App\Models\Channel;
use App\Models\Katalog;
use App\Models\Regency;
use App\Models\Pengajuan;
use App\Models\Pembayaran;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasRoles, HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'avatar',
        'nik',
        'alamat_ktp',
        'kota',
        'email',
        'password',
        'no_wa',
        'bank_id',
        'no_rekening',
        'foto_ktp',
        'is_active',
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

    public function Katalog()
    {
        return $this->hasMany(Katalog::class, 'id');
    }
    public function Channels()
    {
        return $this->hasMany(Channel::class, 'user_id');
    }
    public function Pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'id');
    }
    public function Bank()
    {
        return $this->belongsTo(Bank::class, 'bank_id');
    }
    public function Kota()
    {
        return $this->belongsTo(Regency::class, 'kota');
    }
    public function pengajuan()
    {
        return $this->hasMany(Pengajuan::class, 'created_by');
    }
}
