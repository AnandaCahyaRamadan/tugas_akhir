<?php

namespace App\Models;

use App\Models\Pengajuan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Katalog extends Model
{
    use HasFactory;
    protected $table = 'katalog_lagu';
    protected $primaryKey = 'id';
    protected $fillable = [
        'judul',
        'pencipta_lagu',
        'pembawa_lagu',
        'link_vidio_lagu',
        'publisher_id',
    ];
    public function User()
    {
        return $this->belongsTo(User::class, 'publisher_id');
    }
    public function pengajuan()
    {
        return $this->hasMany(Pengajuan::class, 'id');
    }
}
