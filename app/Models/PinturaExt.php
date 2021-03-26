<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PinturaExt extends Model
{
    protected $table = 'pintura_ext';
    protected $fillable = [
        'id',
        'tipo_pintura'
    ];
}
