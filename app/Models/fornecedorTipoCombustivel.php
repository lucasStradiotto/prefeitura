<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class fornecedorTipoCombustivel extends Model
{
    protected $fillable = ['posto_id', 'tipo_combustivel_id'];

    public function posto_id(){
        return $this->belongsTo('App\Models\postosDeGasolina');
    }

    public function tipo_combustivel_id(){
        return $this->belongsTo('App\Models\tipoCombustivel');
    }
}
