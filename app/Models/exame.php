<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class exame extends Model
{
    protected $fillable = [
        'nome',
        'tipo_exame_id',
        'tipo_padroes_id',
        'padrao_esperado_id',
        'padrao_nao_esperado_id',
        'min_esperado_id',
        'max_esperado_id'
    ];
}
