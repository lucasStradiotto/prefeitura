<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cercasVeiculo extends Model
{
    protected $fillable = [
        'veiculo_id',
        'cerca_id',
        'data_inicio',
        'data_fim',
        'acao',
    ];
}
