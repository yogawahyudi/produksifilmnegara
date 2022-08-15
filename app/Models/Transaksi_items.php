<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi_items extends Model
{
    use HasFactory, Uuid;

    public $incrementing = false;
    protected $keyType = 'uuid';
    protected $table = "transaksi_items";
    protected $fillable = [
        'transaksi_id',
        'studio',
        'harga_setting',
        'harga_shooting',
        'overcharge_setting',
        'overcharge_shooting',
        'durasi_shooting',
        'durasi_setting',
        't_harga',
        'tanggal',
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id', 'id');
    }

    function scopeLatest($query)
    {
        return $query->orderBy('created_at')->get();
    }
}
