<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class iconesCidadeFacil extends Model
{
    protected $table = 'icones_cidade_facil';

    protected $fillable = [
        'nome',
        'display_name',
        'icone'
    ];
}
