<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProtecaoCalcada extends Model
{
    protected $table = 'protecao_calcadas';

    protected $fillable = [
        'descricao'
    ];
}