<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IconeWeb extends Model
{
    protected $table = 'icone_web';

    protected $fillable = [
        'id',
        'nome'
    ];
}
