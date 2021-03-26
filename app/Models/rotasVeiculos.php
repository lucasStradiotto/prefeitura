<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class rotasVeiculos extends Model
{
    protected $table = 'rotas_veiculos';

    protected $fillable = [
        'rota_id',
        'veiculo_id'
    ];
}
