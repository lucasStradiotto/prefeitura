<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusSolicitacao extends Model
{
    protected $table = 'status_solicitacao';

    protected $fillable = [
        'nome'
    ];
}
