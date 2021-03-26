<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class verticesCerca extends Model
{
    protected $table = 'vertices_cerca';
    protected $fillable = [
        'cerca_id',
        'latitude',
        'longitude'
    ];
}
