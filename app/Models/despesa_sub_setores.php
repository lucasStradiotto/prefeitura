<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class despesa_sub_setores extends Model
{
    protected $fillable = [
        'despesa_setor_id',
        'nome'
    ];
}
