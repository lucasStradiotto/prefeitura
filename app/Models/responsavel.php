<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class responsavel extends Model
{
    protected $table = 'responsaveis';

    protected $fillable = [
        'nome',
        'email'
    ];
}
