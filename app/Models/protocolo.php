<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class protocolo extends Model
{
    protected $dates=[
        'data_retirada',
        'data_inicio',
        'data_fim',
        'dataStatus'
    ];

    protected $fillable = [
        'endereco',
        'numero',
        'status',
        'dataStatus',
        'observacaoStatus',
        'responsavel',
        'responsavel_email',
        'protF',
        'retiradoPor',
        'assunto',
        'comodos',
        'proprietario',
        'proprietario_email',
        'setor',
        'quadra',
        'lote',
        'l',
        'livro',
        'pagina',
        'm2',
        'taxa',
        'dt',
        'data_retirada',
        'data_inicio',
        'data_fim',
        'setor_protocolo'
    ];

    public function documentoAnexado(){
        return $this->hasMany('App\Models\documentoAnexado');
    }
}
