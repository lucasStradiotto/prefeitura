<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class preventiva extends Model
{
    protected $dates = [
        'data_ultima_manutencao'
    ];

    protected $fillable = [
        'intervalo',
        'veiculo_id',
        'tipo_preventiva_id',
        'unidade_intervalo_id',
        'data_ultima_manutencao',
        'visto'
    ];
}
