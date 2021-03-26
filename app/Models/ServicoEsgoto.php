<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicoEsgoto extends Model
{
    protected $table = 'servico_esgoto';
    protected $fillable = [
        'id',
        'tipo_esgoto'
    ];
}
