<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pattern extends Model
{
    use HasFactory, Uuid;
    public $incrementing = false;
    protected $keyType = 'uuid';
    protected $table = "pattern";
    protected $fillable = [
        'respon_id',
        'pattern',
        'label'
    ];

    public function respon()
    {
        return $this->belongsTo(Respon::class);
    }
}
