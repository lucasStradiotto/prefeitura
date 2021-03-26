<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class veiculosExames extends Model
{
    protected $fillable = [
        'veiculo_id',
        'exame_id'
    ];
}
