<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class abastecimento extends Model
{
    protected $fillable = [
        'veiculo_id',
        'data',
        'tipo_combustivel',
        'litros',
        'valor_unitario',
        'motorista',
        'kilometragem',
        'posto_id',
        'frentista_nome',
        'descricao'
    ];

    protected $dates = [
        'data'
    ];
}
