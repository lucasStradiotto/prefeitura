<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PedologiaTerreno extends Model
{
    protected $table = 'pedologia_terrenos';

    protected $fillable = [
        'descricao'
    ];
}