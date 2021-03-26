<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cartaoMestre extends Model
{
    protected $table = 'cartao_mestre';
    
    protected $fillable = [
        'numero'
    ];
}
