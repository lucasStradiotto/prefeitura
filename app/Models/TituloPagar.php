<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TituloPagar extends Model
{
    protected $fillable = [
        'veiculoId',
        'ano',
        'vencDPVA',
        'vencIPVA',
        'vencLicenciamento',
        'valorIPVA',
        'valorDPVA',
        'valorLicenciamento',
        'status'
    ];
    public function veiculoID(){
        return $this->belongsTo('App\Models\veiculo');
    }
}
