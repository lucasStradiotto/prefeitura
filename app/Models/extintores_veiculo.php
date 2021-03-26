<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class extintores_veiculo extends Model
{
    protected $table = 'extintores_veiculos';

    protected $fillable = [
        'id',
        'veiculo_id',
        'extintor_id',
        'data_vigencia'
    ];

    public function tipoVeiculo(){
        return $this->belongsTo('App\Models\veiculo');
    }

    public function tipoExtintor(){
        return $this->belongsTo('App\Models\extintor');
    }
}
