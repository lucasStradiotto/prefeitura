<?php

namespace App\Http\Controllers;

use App\Models\Anomalia;
use App\Models\SolicitacaoRedeEletrica;
use App\Models\StatusSolicitacao;

class SolicitacaoRedeEletricaController extends Controller
{
    public function index()
    {
        $title = 'Solicitações de Intervenção na Rede Elétrica';

        $anomalias = Anomalia::orderBy('nome')->get();
        return view('solicitacaoRedeEletrica.index', compact('title', 'anomalias'));
    }

    public function getSolicitacoes()
    {
        $solicitacoes = SolicitacaoRedeEletrica::orderByDesc('data')
        ->join('ruas', 'ruas.id', '=', 'solicitacao_rede_eletrica.rua_id')
        ->join('bairros', 'bairros.id', '=', 'solicitacao_rede_eletrica.bairro_id')
        ->join('anomalias', 'anomalias.id', '=', 'solicitacao_rede_eletrica.anomalia_id')
        ->join('status_solicitacao', 'status_solicitacao.id', '=', 'solicitacao_rede_eletrica.status_solicitacao_id');

        $filter = request()->get('anomalia_id');
        if ($filter != 0)
            $solicitacoes = $solicitacoes->where('solicitacao_rede_eletrica.anomalia_id', '=', $filter);

        $solicitacoes = $solicitacoes
            ->selectRaw('solicitacao_rede_eletrica.numero_casa, solicitacao_rede_eletrica.data, 
                                   solicitacao_rede_eletrica.id, solicitacao_rede_eletrica.nome_solicitante, 
                                   anomalias.prazo as prazo_solicitacao, status_solicitacao.nome as status_solicitacao,
                                   ruas.nome as nome_rua, bairros.nome as nome_bairro, anomalias.nome as anomalia')
            ->get();

        return json_encode($solicitacoes);
    }

    public function finalizar()
    {
        $solicitacao_id = request()->get('solicitacao_id');
        $solicitacao = SolicitacaoRedeEletrica::find($solicitacao_id);
        $status = StatusSolicitacao::where('nome', '=', 'EXECUTADO')
            ->select('id')->first();
        $solicitacao->status_solicitacao_id = $status->id;
        $update = $solicitacao->save();

        if ($update)
            $ret = ['message' => 'Ok'];
        else
            $ret = ['message' => 'Fail'];

        return $ret;
    }

    public function cancelar()
    {
        $solicitacao_id = request()->get('solicitacao_id');
        $solicitacao = SolicitacaoRedeEletrica::find($solicitacao_id);
        $status = StatusSolicitacao::where('nome', '=', 'CANCELADO')
            ->select('id')->first();
        $solicitacao->status_solicitacao_id = $status->id;
        $update = $solicitacao->save();

        if ($update)
            $ret = ['message' => 'Ok'];
        else
            $ret = ['message' => 'Fail'];

        return $ret;
    }
}
