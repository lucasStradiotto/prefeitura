<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class motorista extends Model
{
    protected $fillable = [
        'empresa_id',
        'nome',
        'cnh_numero',
        'cnh_categoria',
        'cpf',
        'rg',
        'secretaria_id',
        'jornada_trabalho_id',
        'senha'
    ];
}
