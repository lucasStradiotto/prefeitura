<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolicitacaoPodaRetirada extends Model
{
    protected $table = 'solicitacao_poda_retirada';

    protected $fillable = [
    ];

    public function getEnderecoAttribute()
    {
        return ucwords($this->bairro) . " - " . ucwords($this->rua) . ", " . $this->numero;
    }

    public function getNomeSolicitanteAttribute($nome)
    {
        return ucwords($nome);
    }

    public function getTipoSolicitacaoAttribute($attr)
    {
        if ($attr == "retirada") $attr = "supressão";
        return ucfirst($attr);
    }

    public function Imagens()
    {
        return $this->hasMany('App\Models\SolicitacoesImagens', 'solicitacao_id', 'id');
    }
}
