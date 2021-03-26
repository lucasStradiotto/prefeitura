<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerfilItemCidadeFacil extends Model
{
    protected $table = 'perfil_item_cidade_facil';

    protected $fillable = [
        'role_id',
        'item_id'
    ];
}
