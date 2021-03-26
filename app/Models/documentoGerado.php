<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class documentoGerado extends Model
{
    protected $dates = [
        'data_emissao',
        'data_inicio',
        'data_fim'
    ];
    protected $table = 'documentos_gerados';
    protected $fillable = [
        'tipo_documento',
        'numero_documento',
        'nome_eng',
        'crea_eng',
        'numero_protocolo',
        'nome_solicitante',
        'end_rua',
        'end_numero',
        'end_setor',
        'end_quadra',
        'end_lote',
        'area_construida',
        'data_emissao',
        'numero_matricula',
        'tipo_predio',
        'tipo_construcao',
        'metragem_com',
        'metragem_res',
        'comodos',
        'comodos_com',
        'comodos_res',
        'obs',
        'pagina',
        'livro',
        'data_inicio',
        'data_fim'
    ];
}
