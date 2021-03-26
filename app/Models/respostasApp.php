<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class respostasApp extends Model
{
    protected $table = 'respostas_app';
    protected $fillable = [
        'resposta',
        'cidade'
    ];
}
