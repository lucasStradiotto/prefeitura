<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pintura extends Model
{
    protected $table = "pintura_ext";
    protected $fillable = [
        'id',
        'tipo_pintura'
    ];
}
