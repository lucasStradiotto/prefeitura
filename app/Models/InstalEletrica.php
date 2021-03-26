<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstalEletrica extends Model
{
    protected $table = 'instal_eletricas';

    protected $fillable = [
        'descricao'
    ];
}
