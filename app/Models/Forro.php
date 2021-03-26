<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Forro extends Model
{
    protected $table = 'forros';

    protected $fillable = [
        'descricao'
    ];
}
