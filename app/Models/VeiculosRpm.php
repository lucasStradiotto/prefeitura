<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VeiculosRpm extends Model
{
    protected $table = "veiculos_rpm";
    protected $fillable = [
        'id',
        'veiculo_id',
        'rpm'
    ];
}
