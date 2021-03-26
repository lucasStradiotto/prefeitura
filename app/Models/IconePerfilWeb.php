<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IconePerfilWeb extends Model
{
    protected $table = 'icone_perfil_web';

    protected $fillable = [
        'perfil_id',
        'icone_id'
    ];
}
