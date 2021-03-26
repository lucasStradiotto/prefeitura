<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AbastecimentoAgua extends Model
{
    protected $table = 'abastecimento_agua';
    protected $fillable = [
        'id',
        'tipo_abastecimento'
    ];
}
