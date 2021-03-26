<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocalizacaoVertical extends Model
{
    protected $table = 'localizacao_vertical';

    protected $fillable = [
        'descricao'
    ];
}
