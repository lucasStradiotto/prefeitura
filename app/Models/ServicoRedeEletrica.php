<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicoRedeEletrica extends Model
{
    protected $table = 'servico_rede_eletrica';
    protected $fillable = [
        'id',
        'tipo_rede_eletrica'
    ];
}
