<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PinturaInt extends Model
{
    protected $table = 'pintura_int';
    protected $fillable = [
        'id',
        'tipo_pintura'
    ];
}
