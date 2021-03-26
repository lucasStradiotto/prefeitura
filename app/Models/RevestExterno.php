<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RevestExterno extends Model
{
    protected $table = 'revest_externo';
    protected $fillable = [
        'id',
        'tipo_revest'
    ];
}
