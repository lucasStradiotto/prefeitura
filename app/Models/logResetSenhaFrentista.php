<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class logResetSenhaFrentista extends Model
{
    protected $table = 'log_reset_senha_frentistas';

    protected $fillable = [
        'frentista_id',
        'user_id',
        'data_alteracao'
    ];
}
