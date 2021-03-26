<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Elevador extends Model
{
    protected $table = 'elevadores';

    protected $fillable = [
        'descricao'
    ];
}
