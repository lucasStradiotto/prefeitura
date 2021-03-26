<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class log_abastecimento_manual extends Model
{
    protected $table = 'log_abastecimentos_manual';

    protected $fillable = [
        'data_insercao',
        'abastecimento_id',
        'user_id',
        'veiculo_id',
        'motorista',
        'tipo_combustivel',
        'valor_unitario',
        'litros',
        'kilometragem',
        'posto_id',
        'frentista',
        'data_abastecimento',
        'motivo'
    ];
}
