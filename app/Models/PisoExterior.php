<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PisoExterior extends Model
{
    protected $table = 'piso_ext';
    protected $fillable = [
        'id',
        'tipo_piso'
    ];
}
