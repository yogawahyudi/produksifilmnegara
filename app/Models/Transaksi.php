<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory, Uuid;
    public $incrementing = false;
    protected $keyType = 'uuid';
    protected $table = "transaksi";
    protected $fillable = [
        'users_id',
        'status_tran',
        'tanggal',
        'nama',
        'email',
        'no_hp',
        'nama_per',
        'email_per',
        'no_hp_per',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function transaksi_items()
    {
        return $this->hasMany(Transaksi_items::class, 'transaksi_id', 'id');
    }

    public function tagihan()
    {
        return $this->hasMany(Tagihan::class, 'transaksi_id', 'id');
    }
}
