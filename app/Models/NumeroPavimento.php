<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NumeroPavimento extends Model
{
    protected $table = 'numero_pavimento';
    protected $fillable = [
        'id',
        'tipo_pavimento'
    ];
}
