<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CasaRecuada extends Model
{
    protected $table = 'casa_recuadas';

    protected $fillable = [
        'descricao'
    ];
}