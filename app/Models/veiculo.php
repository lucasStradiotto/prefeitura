<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class veiculo extends Model
{
    protected $fillable = [
        'placa',
        'n_serie_rastreador',
        'empresa_id',
        'id_tipo_veiculo',
        'fabricante',
        'modelo',
        'ano',
        'cor',
        'secretaria_id',
        'horario_programado_id',
        'prefixo',
        'imagem',
        'extensao_imagem',
        'imagem_placa',
        'codigo_barra',
        'despesa_sub_setor_id',
        'renavam',
        'patrimonio',
        'localizacao',
        'status',
        'categoria',
        'vencDPVAT',
        'vencLicenciamento'
    ];
    
    public function tituloPagar(){
        return $this->hasMany('App\Models\TituloPagar');
    }

    public function tipoVeiculo(){
        return $this->hasMany('App\Models\extintores_veiculo');
    }
}
