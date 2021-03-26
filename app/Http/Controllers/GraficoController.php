<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use App\Models\prefeitura;

class GraficoController extends Controller
{
    public function __construct()
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth')
            ->except(['getGastoManutencao', 'getManutencaoSecretaria', 'getManutencaoMes', 'getManutencaoVeiculo']);
    }

    public function index()
    {
        $title = 'Gráficos';

        return view('graficos.index', compact('title'));
    }

    public function gastoManutencao()
    {
        $title = 'Gastos com Manutenção';
        $prefeitura = prefeitura::find(1);
        return view('graficos.gastoManutencao', compact('title','prefeitura'));
    }

    public function getGastoManutencao()
    {
        return json_encode(
            DB::select(
                DB::raw(
                    "SELECT fake_corretivas.valor_corretiva, fake_preventivas.valor_preventiva 
                            FROM
                            (SELECT SUM(ordem_servico_corretivas.valor_total) as valor_corretiva
                            FROM ordem_servico_corretivas
                            WHERE date_format(ordem_servico_corretivas.data_execucao, '%Y') = date_format(CURRENT_TIMESTAMP, '%Y')
                            ) as fake_corretivas,
                            (SELECT SUM(ordem_servico_preventivas.valor_total) as valor_preventiva
                            FROM ordem_servico_preventivas
                            WHERE date_format(ordem_servico_preventivas.data_execucao, '%Y') = date_format(CURRENT_TIMESTAMP, '%Y')
                            ) as fake_preventivas"
                ),
                array()
            )
        );
    }

    public function getManutencaoSecretaria()
    {
        $manutencao = request()->get('manutencao');
        $tabela = "ordem_servico_".$manutencao;
        $query = "
        SELECT SUM($tabela.valor_total) as valor,
		                    secretarias.nome as nome,
		                    secretarias.id as secretaria
                            FROM $tabela
                            INNER JOIN veiculos ON veiculos.id = $tabela.veiculo_id
                            INNER JOIN secretarias ON secretarias.id = veiculos.secretaria_id
                            WHERE date_format($tabela.data_execucao, '%Y') = date_format(CURRENT_TIMESTAMP, '%Y')
                            GROUP BY nome, secretaria
        ";
        return json_encode(
            DB::select(
                DB::raw(
                    $query
                ),
                array()
            )
        );
    }

    public function getManutencaoMes()
    {
        $manutencao = request()->get('manutencao');
        $secretaria = request()->get('secretaria');
        $tabela = "ordem_servico_".$manutencao;
        $query = "SELECT SUM($tabela.valor_total) as valor,
                            date_format($tabela.data_execucao, '%m') as mes
                            FROM $tabela
                            INNER JOIN veiculos ON veiculos.id = $tabela.veiculo_id
                            INNER JOIN secretarias ON secretarias.id = veiculos.secretaria_id
                            WHERE date_format($tabela.data_execucao, '%Y') = date_format(CURRENT_TIMESTAMP, '%Y')
                            AND secretarias.id = $secretaria
                            GROUP BY mes";
        return json_encode(
            DB::select(
                DB::raw(
                    $query
                ),
                array()
            )
        );
    }

    public function getManutencaoVeiculo()
    {
        $manutencao = request()->get('manutencao');
        $secretaria = request()->get('secretaria');
        $mes = request()->get('mes');
        $tabela = "ordem_servico_".$manutencao;
        $query = "SELECT SUM($tabela.valor_total) as valor,
							veiculos.placa as veiculo
                            FROM $tabela
                            INNER JOIN veiculos ON veiculos.id = $tabela.veiculo_id
                            INNER JOIN secretarias ON secretarias.id = veiculos.secretaria_id
                            WHERE date_format($tabela.data_execucao, '%Y') = date_format(CURRENT_TIMESTAMP, '%Y')
                            AND date_format($tabela.data_execucao, '%m') = '$mes'
                            AND secretarias.id = $secretaria
                            GROUP BY veiculo";
        return json_encode(
            DB::select(
                DB::raw(
                    $query
                ),
                array()
            )
        );
    }


    public function arrecadacaoProtocolo()
    {
        $title = 'Arrecadação com Protocolo';
        $prefeitura = prefeitura::find(1);
        return view('graficos.arrecadacaoProtocolo', compact('title','prefeitura'));
    }

    public function getArrecadacaoProtocolo()
    {
        return json_encode(
            DB::select(
                DB::raw(
                    "SELECT SUM(taxa) as valor, date_format(data_inicio, '%m') as mes
                            FROM protocolos 
                            WHERE date_format(data_inicio, '%Y') = date_format(CURRENT_TIMESTAMP, '%Y')
                            GROUP BY mes"
                ),
                array()
            )
        );
    }

    public function getProtocoloMes()
    {
        $mes = request()->get('mes');
        $query = "
            SELECT SUM(taxa) as valor, assunto
            FROM protocolos 
            WHERE date_format(data_inicio, '%Y') = date_format(CURRENT_TIMESTAMP, '%Y')
            AND date_format(data_inicio, '%m') = $mes
            GROUP BY assunto
        ";
        return json_encode(
            DB::select(
                DB::raw(
                    $query
                ),
                array()
            )
        );
    }
//
    public function getManutencaoAssunto()
    {
        $assunto = request()->get('assunto');
        $query = "
            SELECT SUM(taxa) as valor, date_format(data_inicio, '%m') as mes
            FROM protocolos 
            WHERE date_format(data_inicio, '%Y') = date_format(CURRENT_TIMESTAMP, '%Y')
            AND assunto = '$assunto'
            GROUP BY mes
        ";
        return json_encode(
            DB::select(
                DB::raw(
                    $query
                ),
                array()
            )
        );
    }

    public function cacambaEntregue()
    {
        $title = 'Caçambas Entregues';
        $prefeitura = prefeitura::find(1);
        return view('graficos.cacambaEntregue', compact('title','prefeitura'));
    }

    public function getCacambaEntregue()
    {
        return json_encode(
            DB::select(
                DB::raw(
                    "SELECT date_format(data_finalizada, '%m') as mes, count(id) as qtd
                            FROM ordem_coletas
                            WHERE date_format(data_finalizada, '%Y') = date_format(CURRENT_TIMESTAMP, '%Y')
                            GROUP BY mes"
                ),
                array()
            )
        );
    }

    public function getCacambaMes()
    {
        $mes = request()->get('mes');
        $query = "
            SELECT empresas.nome_fantasia as nome, count(ordem_coletas.id) as qtd
            FROM ordem_coletas
            INNER JOIN veiculos ON veiculos.id = ordem_coletas.veiculo_id
            INNER JOIN empresas ON empresas.id = veiculos.empresa_id
            WHERE date_format(ordem_coletas.data_finalizada, '%Y') = date_format(CURRENT_TIMESTAMP, '%Y')
            AND date_format(ordem_coletas.data_finalizada, '%m') = $mes
            GROUP BY nome
        ";
        return json_encode(
            DB::select(
                DB::raw(
                    $query
                ),
                array()
            )
        );
    }

    public function getCacambaEmpresa()
    {
        $empresa = request()->get('empresa');
        $query = "
            SELECT date_format(ordem_coletas.data_finalizada, '%m') as mes, count(ordem_coletas.id) as qtd
            FROM ordem_coletas
            INNER JOIN veiculos ON veiculos.id = ordem_coletas.veiculo_id
            INNER JOIN empresas ON empresas.id = veiculos.empresa_id
            WHERE date_format(ordem_coletas.data_finalizada, '%Y') = date_format(CURRENT_TIMESTAMP, '%Y')
            AND empresas.nome_fantasia = '$empresa'
            GROUP BY mes
        ";
        return json_encode(
            DB::select(
                DB::raw(
                    $query
                ),
                array()
            )
        );
    }

    public function getPrefeitura()
    {
        $prefeitura = prefeitura::find(1);
        return $prefeitura;
    }

}
