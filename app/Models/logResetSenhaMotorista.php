<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class logResetSenhaMotorista extends Model
{
    protected $table = 'log_reset_senha_motorista';

    protected $fillable = [
        'motorista_id',
        'user_id',
        'data_alteracao'
    ];
}
