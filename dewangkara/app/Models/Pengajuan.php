<?php

namespace App\Models;

use App\Models\Katalog;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;
    protected $table = 'pengajuan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_channel',
        'link_channel',
        'status',
        'katalog_id',
        'created_by',
        'audio',
        'art_track',
        'is_active',
        'keterangan',
    ];
    public function katalog()
    {
        return $this->belongsTo(Katalog::class, 'katalog_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
