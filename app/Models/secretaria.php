<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class secretaria extends Model
{
    protected $fillable = [
        'nome',
        'horario_programado_id',
        'parent_id'
    ];
}
