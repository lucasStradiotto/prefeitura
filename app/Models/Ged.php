<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ged extends Model
{
    protected $table = 'ged';

    protected $fillable = [
        'secretaria',
        'data',
        'nome_usuario',
        'nome_arquivo',
        'caminho_arquivo',
        'obs1',
        'obs2',
        'obs3'
    ];

    public function observacoes()
    {
        return $this->hasMany('App\Models\GedObservacao', 'ged_id', 'id');
    }
}
