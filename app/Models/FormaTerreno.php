<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormaTerreno extends Model
{
    protected $table = 'forma_terrenos';

    protected $fillable = [
        'descricao'
    ];
}