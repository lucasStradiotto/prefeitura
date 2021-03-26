<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = [
		'material', 'marca', 'modelo', 'codigo_fabricante', 'unidade_compra', 'unidade_movimento', 'fator_conversao'
    ];
    
    protected $table = 'material';
}
