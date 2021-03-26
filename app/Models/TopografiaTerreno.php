<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TopografiaTerreno extends Model
{
    protected $table = 'topografia_terrenos';

    protected $fillable = [
        'descricao'
    ];
}