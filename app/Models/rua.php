<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class rua extends Model
{
    protected $table='ruas';
    protected $fillable = [
        'nome'
    ];

//    public function SetoresBairrosRuas()
//    {
//        return $this->hasMany('App\Models\setores_bairros_ruas');
//    }

    public function SetoresBairrosRuasLotes()
    {
        return $this->hasMany('App\Models\setoresBairrosRuasLotes');
    }

}
