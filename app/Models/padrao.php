<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class padrao extends Model
{
    protected $table = 'padroes';

    protected $fillable = [
        'nome',
        'tipo_padrao_id'
    ];
}
