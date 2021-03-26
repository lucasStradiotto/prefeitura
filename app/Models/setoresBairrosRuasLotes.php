<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class setoresBairrosRuasLotes extends Model
{
    protected $table = 'setores_bairros_ruas_lotes';

    protected $fillable = [
        'setor_id', 'bairro_id','rua_id','sublote','codigo_imovel','numero','set_quad_lot_sub','proprietario_id','comissionario_id'
    ];

    public function Setores()
    {
        return $this->belongsTo('App\Models\Setores');
    }

    public function Bairros()
    {
        return $this->belongsTo('App\Models\Bairros');
    }

    public function Ruas()
    {
        return $this->belongsTo('App\Models\rua');
    }

    public function Lotes()
    {
        return $this->belongsTo('App\Models\lote');
    }

    public function endereco_correspondencia()
    {
        return $this->hasOne('App\Models\endereco_correspondencia', 'setores_bairros_ruas_lotes_id');
    }
}
