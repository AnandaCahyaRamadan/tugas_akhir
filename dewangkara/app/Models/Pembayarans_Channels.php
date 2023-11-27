<?php

namespace App\Models;

use App\Models\Channel;
use App\Models\Pembayaran;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayarans_Channels extends Model
{
    use HasFactory;
    protected $table = 'pembayarans_channels';
    protected $primaryKey = 'id';
    protected $fillable = [
        'pembayaran_id',
        'channel_id',
    ];
    public function pembayarans()
    {
        return $this->belongsTo(Pembayaran::class);
    }
    public function channels()
    {
        return $this->belongsTo(Channel::class);
    }
}
