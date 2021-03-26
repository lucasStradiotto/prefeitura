<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ordemServicoPreventiva extends Model
{
    protected $table = "ordem_servico_preventivas";

    protected $dates=[
        'data_execucao'
    ];

    protected $fillable = [
        'data_execucao',
        'data_prevista',
        'horario_inicio',
        'horario_fim',
        'veiculo_id',
        'preventiva_id',
        'descricao',
        'servico',
        'ferramenta',
        'valor_total'
    ];
}
