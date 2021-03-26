<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolicitacaoRedeEletrica extends Model
{
    protected $table = 'solicitacao_rede_eletrica';

    protected $fillable = [
        'bairro_id',
        'rua_id',
        'numero_casa',
        'data',
        'nome_solicitante',
        'anomalia_id'
    ];

    protected $dates = [
        'data'
    ];
}
