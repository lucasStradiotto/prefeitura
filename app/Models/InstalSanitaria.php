<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstalSanitaria extends Model
{
    protected $table = 'instal_sanitarias';

    protected $fillable = [
        'descricao'
    ];
}
