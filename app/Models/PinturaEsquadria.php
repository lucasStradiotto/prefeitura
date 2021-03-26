<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PinturaEsquadria extends Model
{
    protected $table = 'pintura_esquadrias';

    protected $fillable = [
        'descricao'
    ];
}
