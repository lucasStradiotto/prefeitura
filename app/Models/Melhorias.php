<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Melhorias extends Model
{
    protected $table = 'melhorias';
    protected $fillable = [
        'id',
        'tipo_melhoria'
    ];
}
