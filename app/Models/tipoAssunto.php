<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tipoAssunto extends Model
{
    protected $fillable=[
      'grupo'
    ];

    public function assunto(){
        return $this->hasMany('App\Models\assunto');
    }
}
