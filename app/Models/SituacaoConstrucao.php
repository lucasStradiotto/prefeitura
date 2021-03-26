<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SituacaoConstrucao extends Model
{
    protected $table = 'situacao_construcao';

    protected $fillable = [
        'descricao'
    ];
}
