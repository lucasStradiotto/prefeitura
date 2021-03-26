<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class log_cartao_mestre_abastecimento extends Model
{
    protected $table = 'log_cartao_mestre_abastecimento';

    protected $fillable = [
        'abastecimento_id',
        'cartao_mestre_id'
    ];
}
