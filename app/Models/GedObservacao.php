<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GedObservacao extends Model
{
    protected $table = 'ged_observacoes';

    protected $fillable = [
        'ged_id',
        'nome_observacao',
        'valor_observacao'
    ];
}
