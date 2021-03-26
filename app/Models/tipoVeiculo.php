<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tipoVeiculo extends Model
{
    protected $fillable = [
        'nome',
        'icone',
        'instrumento_medida'
    ];
}
