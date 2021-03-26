<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tipoCombustivel extends Model
{
    protected $fillable = [
        'id',
        'descricao'
    ];

    public function combustivel(){
        return $this->hasMany('App\Models\fornecedorTipoCombustivel');
    }
}
