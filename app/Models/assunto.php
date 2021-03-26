<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class assunto extends Model
{
    protected $fillable = [
        'nome',
        'tipo_assunto_id'
    ];

    public function tipoAssunto(){
        return $this->belongsTo('App\Models\tipoAssunto');
    }
}
