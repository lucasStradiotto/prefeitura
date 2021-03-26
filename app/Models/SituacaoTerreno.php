<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SituacaoTerreno extends Model
{
    protected $table = 'situacao_terrenos';

    protected $fillable = [
        'descricao'
    ];
}
