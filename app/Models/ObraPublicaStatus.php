<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ObraPublicaStatus extends Model
{
    protected $table = 'obras_publicas_status';

    protected $fillable = [
        'nome'
    ];
}
