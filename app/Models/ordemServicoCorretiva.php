<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ordemServicoCorretiva extends Model
{
    protected $table = "ordem_servico_corretivas";

    protected $dates=[
        'data_execucao'
    ];

    protected $fillable = [
        'data_execucao',
        'horario_inicio',
        'horario_fim',
        'veiculo_id',
        'descricao',
        'servico',
        'ferramenta',
        'valor_total',
        'numero_orcamento',
        'numero_empenho',
        'numero_autorizacao',
        'nf',
        'numero_orcamento_doc',
        'numero_empenho_doc',
        'numero_autorizacao_doc',
        'nf_doc'
    ];
}
