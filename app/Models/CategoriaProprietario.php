<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaProprietario extends Model
{
    protected $table = 'cat_proprietario';
    protected $fillable = [
        'id',
        'tipo_categoria'
    ];
}
