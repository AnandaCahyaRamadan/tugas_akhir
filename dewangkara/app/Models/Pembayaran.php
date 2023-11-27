<?php

namespace App\Models;

use App\Models\Channel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $table = 'pembayarans';
    protected $primaryKey = 'id';
    protected $fillable = [
        'status',
        'user_id',
        'tanggal_pembayaran',
        'bukti_pembayaran',
        'detail_pembayaran',
        'rincian_pembayaran',
        'nominal_pembayaran',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function pivot_channels()
    {
        return $this->belongsToMany(Channel::class, 'pembayarans_channels');
    }
}
