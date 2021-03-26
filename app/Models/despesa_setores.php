<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class despesa_setores extends Model
{
    protected $fillable = [
        'nome',
        'secretaria_id'
    ];
}
