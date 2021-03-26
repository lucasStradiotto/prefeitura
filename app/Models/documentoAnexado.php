<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class documentoAnexado extends Model
{
    protected $fillable = [
      'caminho',
      'protocolo_id'
    ];

    public function protocolo(){
        return $this->belongsTo('App\Models\protocolo');
    }
}
