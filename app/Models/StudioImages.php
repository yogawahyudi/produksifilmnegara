<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudioImages extends Model
{
    use HasFactory, Uuid;

    public $incrementing = false;
    protected $keyType = 'uuid';
    protected $table = "studioimages";
    protected $fillable = [
        'studio_id',
        'img'
    ];


    public function studio()
    {
        return $this->belongsTo(Studio::class, 'studio_id', 'id');
    }
}
