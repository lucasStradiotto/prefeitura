<?php

namespace App\Http\Controllers;

use App\Models\SolicitacaoRedeEletrica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;

class RelatorioOrdemDeServicoController extends Controller
{
    public function __construct()
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
    }

    public function index($id)
    {
        $title = "Lista Manuteções";
        $registros = SolicitacaoRedeEletrica::join('bairros', 'bairros.id', '=', 'solicitacao_rede_eletrica.bairro_id')
            ->join('ruas', 'ruas.id', '=', 'solicitacao_rede_eletrica.rua_id')
            ->join('anomalias', 'anomalias.id', '=', 'solicitacao_rede_eletrica.anomalia_id')
            ->where('solicitacao_rede_eletrica.id', '=', $id)
            ->selectRaw('anomalias.nome as tipo_anomalia, ruas.nome as nome_rua, bairros.nome as nome_bairro, 
                        nome_solicitante, solicitacao_rede_eletrica.data, 
                        solicitacao_rede_eletrica.id as id_solicitacao, solicitacao_rede_eletrica.numero_casa,
                        solicitacao_rede_eletrica.foto, solicitacao_rede_eletrica.cidade')
            ->get();
        $prefeitura = DB::select(
            DB::raw(
                "SELECT *
                        FROM prefeituras
                        LIMIT 1
                        "
            ),
            array(
            )
        );

        $dashboardAssets = str_replace('controleobras', 'dashboard', asset(''));
        return view('relatorioManutencaoEletrico.index', compact('title','registros','prefeitura', 'dashboardAssets'));
    }
}
