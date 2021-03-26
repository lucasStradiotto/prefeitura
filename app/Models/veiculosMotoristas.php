<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class veiculosMotoristas extends Model
{
    protected $fillable = [
        'id',
        'veiculo_id',
        'data_utilizacao'
    ];
}
