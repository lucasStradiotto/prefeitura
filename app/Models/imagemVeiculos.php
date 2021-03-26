<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class imagemVeiculos extends Model
{
    protected $fillable = [
      'caminho',
      'veiculo_id'
    ];
}
