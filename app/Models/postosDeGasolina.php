<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class postosDeGasolina extends Model
{
    protected $table = 'postos_de_gasolinas';

    protected $fillable = [
        'nome',
        'nome_fantasia',
        'cep',
        'endereco',
        'numero',
        'cidade',
        'bairro',
        'completemento',
        'cnpj',
        'inscricao_estadual',
        'inscricao_municipal',
        'telefone',
        'telefone_dois',
        'contato',
        'email',
        'caixa_postal',
        'status'
    ];

    public function posto(){
        return $this->hasMany('App\Models\fornecedorTipoCombustivel');
    }
}
