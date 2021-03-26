<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemCidadeFacil extends Model
{
    protected $table = 'itens_cidade_facil';

    protected $fillable = [
        'nome',
        'display_name',
        'description'
    ];
}
