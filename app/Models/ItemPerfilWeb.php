<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemPerfilWeb extends Model
{
    protected $table = 'item_perfil_web';

    protected $fillable = [
        'item_id',
        'perfil_id'
    ];
}
