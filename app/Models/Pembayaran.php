<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory, Uuid;
    public $incrementing = false;
    protected $keyType = 'uuid';
    protected $table = "pembayaran";
    protected $fillable = [
        'tagihan_id',
        'users_id',
        'bukti_img',
        'nominal',
        'verified',
    ];

    public function tagihan()
    {
        return $this->belongsTo(Tagihan::class, 'tagihan_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
