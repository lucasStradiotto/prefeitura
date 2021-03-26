<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusCacamba extends Model
{
    protected $table = 'status_cacambas';

    protected $fillable = [
        'descricao'
    ];
}
