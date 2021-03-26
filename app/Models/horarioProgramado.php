<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class horarioProgramado extends Model
{
    protected $fillable = [
      'inicio',
      'fim'
    ];
}
