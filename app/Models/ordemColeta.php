<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class ordemColeta extends Model
{
    protected $fillable = [
        'nome_solicitante',
        'cnpj',
        'cpf',
        'data',
        'data_entrega',
        'data_retirada',
        'valor',
        'inscricao_estadual',
        'rg',
        'telefone',
        'numero_ctr',
        'tipo_entulho_id',
        'material_predominante_id',
        'endereco_cobranca_id',
        'bairro_cobranca_id',
        'numero_casa_cobranca',
        'endereco_obra_id',
        'bairro_obra_id',
        'numero_obra',
        'veiculo_id',
        'user_id'
    ];

    public function User()
    {
        return $this->hasMany(User::class);
    }
}
