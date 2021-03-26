<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class extintor extends Model
{
    protected $table = 'extintores';

    protected $fillable = [
        'id',
        'inscricao',
        'validade',
        'tipo'
    ];

    public function tipoExtintor(){
        return $this->hasMany('App\Models\extintores_veiculo');
    }
}
