<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaUso extends Model
{
    protected $table = 'categoria_uso';

    protected $fillable = [
        'tipo_categoria'
    ];
}
