<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class numeroDocumento extends Model
{
    protected $fillable = [
        'nome',
        'numero_atual'
    ];
}
