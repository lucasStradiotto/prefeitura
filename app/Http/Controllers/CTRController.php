<?php

namespace App\Http\Controllers;

use App\Models\empresa;
use App\Models\ordemColeta;
use App\Models\ruas;
use App\Models\SolicitacaoCacamba;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class CTRController extends Controller
{
    public function __construct()
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
    }

    public function index()
    {
        $title = 'Solicitações de Caçamba';

        $solicitacoes = SolicitacaoCacamba::join('ruas', 'ruas.id', '=', 'solicitacoes_cacambas.rua_id_obra')
            ->orderBy('solicitacoes_cacambas.data_solicitacao')
            ->select('solicitacoes_cacambas.*', 'ruas.nome as nome_rua')
            ->get();

        return view('ctr.index', compact('title', 'solicitacoes'));
    }

    public function formulario_ctr($id)
    {
        $id_ordem = $id;

        $ordem = ordemColeta::join('ruas', 'ordem_coletas.endereco_obra_id', '=', 'ruas.id')
            ->join('bairros', 'ordem_coletas.bairro_obra_id', '=', 'bairros.id')
            ->join('tipo_entulhos', 'ordem_coletas.tipo_entulho_id', '=', 'tipo_entulhos.id')
            ->join('users', 'ordem_coletas.user_id', '=', 'users.id')
            ->join('empresas', 'users.empresa_id', '=', 'empresas.id')
            ->where('ordem_coletas.numero_ctr', '=', $id_ordem)
            ->select(DB::raw('ordem_coletas.*, ruas.nome AS nome_rua, bairros.nome AS nome_bairro,
             tipo_entulhos.nome AS tipo_material, empresas.nome_fantasia AS nome_fantasia, empresas.razao_social AS razao_social'))->first();

        $title = 'formulario';
        return view('ctr.formulario', compact('title', 'ordem'));
    }

    public function aceitar()
    {
        $solicitacao_id = request()->get('solicitacao_id');
        $solicitacao = SolicitacaoCacamba::find($solicitacao_id);
        $solicitacao->aceito = 1;
        $solicitacao->data_aceitacao = Carbon::now();
        $update = $solicitacao->save();

        $dataFormatada = $solicitacao->data_aceitacao->format("d/m/Y à\s H:i");
        $mensagem = "Sua solicitação foi aceita em $dataFormatada!";
        $titulo = "Solicitação aceita";
        $player_ids = [$solicitacao->celular_solicitante];

        $this->sendNotification($mensagem, $titulo, $player_ids);

        $empresa = empresa::find($solicitacao->empresa_id);

        $ordemColeta = [
            "nome_solicitante" => $solicitacao->nome_solicitante,
            "cnpj" => $empresa->cnpj,
            "cpf" => $solicitacao->cpf_solicitante,
            "data" => $solicitacao->data_aceitacao,
            "valor" => request()->get('valor') ?
                        str_replace(',', '.', request()->get('valor')) : 0,
            "inscricao_estadual" => $empresa->inscricao_estadual,
            "telefone" => $solicitacao->telefone,
            "numero_ctr" => $solicitacao_id,
            "tipo_entulho_id" => $solicitacao->tipo_entulho_id,
            "endereco_cobranca_id" => $solicitacao->rua_id_cobranca,
            "bairro_cobranca_id" => $solicitacao->bairro_id_cobranca,
            "numero_casa_cobranca" => $solicitacao->numero_cobranca,
            "numero_obra" => $solicitacao->numero_obra,
            "endereco_obra_id" => $solicitacao->rua_id_obra,
            "bairro_obra_id" => $solicitacao->bairro_id_obra,
            "user_id" => $solicitacao->usuario_id
        ];

        ordemColeta::create($ordemColeta);

        if ($update)    $ret = ['message' => 'Ok'];
        else            $ret = ['message' => 'Fail'];

        return $ret;
    }

    public function recusar()
    {
        $solicitacao_id = request()->get('solicitacao_id');
        $solicitacao = SolicitacaoCacamba::find($solicitacao_id);
        $solicitacao->aceito = 0;
        $solicitacao->data_aceitacao = Carbon::now();
        $update = $solicitacao->save();

        $dataFormatada = $solicitacao->data_aceitacao->format("d/m/Y à\s H:i");
        $mensagem = "Sua solicitação foi recusada em $dataFormatada!";
        $titulo = "Solicitação recusada";
        $player_ids = [$solicitacao->celular_solicitante];

        $this->sendNotification($mensagem, $titulo, $player_ids);

        if ($update)    $ret = ['message' => 'Ok'];
        else            $ret = ['message' => 'Fail'];

        return $ret;
    }

    public function sendNotification($mensagem, $titulo, $player_ids)
    {
        //SEND ONESIGNAL PUSH NOTIFICATION
        $content = array(
            "en" => $mensagem
        );

        $fields = array(
            'app_id' => "866a4c5b-26e4-435f-9593-d398e80cadce",
            'include_player_ids' => $player_ids,
            'data' => array("mensagem" => $mensagem),
            'headings' => array("en" => $titulo),
            'android_group'  => 'Cidade Fácil',
            'contents' => $content
        );

        $fields = json_encode($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
            'Authorization: Basic MDllZTZlOTgtMjFkMi00MGY0LTk3M2QtZmYyY2Q0OTg1ZTEz'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);
    }
}
