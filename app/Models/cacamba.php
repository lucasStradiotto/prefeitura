<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cacamba extends Model
{
    protected $fillable = [
        'codigo',
        'empresa_id',
        'status_cacamba_id'
    ];

    public function Empresa()
    {
        return $this->belongsTo('App\Models\Empresa', 'empresa_id', 'id');
    }

    public function Status()
    {
        return $this->belongsTo('App\Models\StatusCacamba', 'status_cacamba_id', 'id');
    }
}