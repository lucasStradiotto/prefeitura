<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class alocacaoTipoCombustivel extends Model
{
    protected $table = 'alocacaoTipoCombustivel';

    protected $fillable = [
        'veiculoId',
        'tipoCombustivelId'
    ];
}
