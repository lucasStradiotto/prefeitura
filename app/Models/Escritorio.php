<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Escritorio extends Model
{
    protected $table = 'escritorios';

    protected $fillable = [
        'descricao'
    ];
}
