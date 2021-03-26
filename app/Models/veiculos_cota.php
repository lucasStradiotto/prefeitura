<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class veiculos_cota extends Model
{
    protected $fillable = [
        'veiculo_id',
        'cota_litros',
        'ano',
        'mes'
    ];

}
