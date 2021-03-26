<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoConservacao extends Model
{
    protected $table = 'estado_conservacao';

    protected $fillable = [
        'descricao'
    ];
}