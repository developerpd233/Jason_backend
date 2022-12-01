<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    use HasFactory;


    protected $fillable = [
        'imageUrl',
        'userId',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
