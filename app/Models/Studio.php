<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    use HasFactory, Uuid;
    public $incrementing = false;
    protected $keyType = 'uuid';
    protected $table = "studio";
    protected $fillable = [
        'studio',
        'harga_setting',
        'harga_shooting',
        'overcharge_setting',
        'overcharge_shooting',
        'luas',
        'tinggi',
        'fasilitas',
    ];

    public function studioImage()
    {
        return $this->hasMany(StudioImages::class, 'studio_id', 'id');
    }

    public function studioImageFirst()
    {
        return $this->hasMany(StudioImages::class, 'studio_id', 'id')->take(1);
    }
}
