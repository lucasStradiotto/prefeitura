<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class log_delete_abastecimento extends Model
{
    protected $table = 'log_delete_abastecimentos';

    protected $fillable = [
        'data_exclusao',
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
        'data_abastecimento'
    ];
}
