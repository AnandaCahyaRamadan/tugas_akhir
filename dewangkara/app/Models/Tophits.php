<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tophits extends Model
{
    use HasFactory;
    protected $table = 'tophits';
    protected $primaryKey = 'id';
    protected $fillable = [
        'link',
    ];
}
