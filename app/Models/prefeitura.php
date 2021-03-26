<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class prefeitura extends Model
{
    protected $fillable = [
        'nome',
        'cidade',
        'telefone',
        'endereco',
        'cnpj',
        'logo',
        'lat',
        'lng',
        'relatorio',
        'exibe_filtro_tipo',
        'termo_compromisso'
    ];
}
