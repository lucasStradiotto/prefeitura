<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PisoInterior extends Model
{
    protected $table = 'piso_int';
    protected $fillable = [
        'id',
        'tipo_piso'
    ];
}
