<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PossivelObservacao extends Model
{
    protected $table = 'possiveis_observacoes';

    protected $fillable = [
        'secretaria_id',
        'nome_observacao'
    ];

    public function secretaria()
    {
        return $this->hasOne('App\Models\secretaria', 'id', 'secretaria_id');
    }
}
