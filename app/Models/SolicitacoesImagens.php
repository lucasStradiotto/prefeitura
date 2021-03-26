<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolicitacoesImagens extends Model
{
    protected $table = 'solicitacoes_imagens';

    public function getCaminhoAttribute()
    {
        $path = asset("img/solicitacoes/" . $this->tipo_solicitacao . "/" . $this->nome);
        return str_replace("controleobras", "dashboard", $path);
    }

    public function getTipoImagemAttribute($attr)
    {
        return ucfirst($attr);
    }
}
