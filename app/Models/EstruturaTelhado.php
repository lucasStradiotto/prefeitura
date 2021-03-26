<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstruturaTelhado extends Model
{
    protected $table = 'estrutura_telhados';

    protected $fillable = [
        'descricao'
    ];
}
