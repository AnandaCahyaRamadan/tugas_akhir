<?php

namespace App\Models;

use App\Models\Pembayaran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Channel extends Model
{
    use HasFactory;
    protected $table = 'channels';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'link_channel',
        'nama_channel'
    ];
    public function pivot_channels()
    {
        return $this->belongToMany(Pembayaran::class, 'pembayarans_channels');
    }
}
