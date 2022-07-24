<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respon extends Model
{
    use HasFactory, Uuid;
    public $incrementing = false;
    protected $keyType = 'uuid';
    protected $table = "respon";
    protected $fillable = [
        'respon',
    ];

    public function respon()
    {
        return $this->hasMany(Pattern::class);
    }
}
