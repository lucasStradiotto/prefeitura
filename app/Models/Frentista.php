<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Frentista extends Model
{
    protected $fillable = [
        'nome',
        'posto_id',
        'senha'
    ];
}
