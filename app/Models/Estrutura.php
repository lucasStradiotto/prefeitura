<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estrutura extends Model
{
    protected $table = 'estruturas';

    protected $fillable = [
        'descricao'
    ];
}
