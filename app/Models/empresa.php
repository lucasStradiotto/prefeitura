<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class empresa extends Model
{
    protected $fillable = [
        'razao_social',
        'nome_fantasia',
        'cnpj',
        'inscricao_municipal',
        'inscricao_estadual',
        'estado',
        'cidade',
        'logradouro',
        'numero',
        'bairro',
        'responsavel',
        'cep',
        'telefone'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
