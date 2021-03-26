<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RevestInterno extends Model
{
    protected $table = 'revest_interno';
    protected $fillable = [
        'id',
        'tipo_revest'
    ];
}
