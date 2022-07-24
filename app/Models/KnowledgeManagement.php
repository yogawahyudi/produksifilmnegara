<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KnowledgeManagement extends Model
{
    use HasFactory, Uuid;

    protected $table = "knowledge_management";
    protected $keyType = "uuid";
    public $incrementing = false;

    protected $fillable = [
        'pattern',
        'respon',
        'label',
    ];
}
