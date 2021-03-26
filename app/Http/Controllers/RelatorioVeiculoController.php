<?php

namespace App\Http\Controllers;

use App\Models\empresa;
use App\Models\prefeitura;
use App\Models\Rastreamento;
use App\Models\veiculo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class RelatorioVeiculoController extends Controller
{
    public function __construct()
    {
        Session::put('url.intent', URL::current());
        $this->middleware('auth');
    }

    public function index()
    {
        $title = 'Relatório de Veículos';

        if (prefeitura::first()->nome == "Rastreamento Privado" || prefeitura::first()->nome == '')
            $veiculos = veiculo::where('empresa_id', '=', Auth::user()->empresa_id)
                ->orderBy('placa')->get();
        else
            $veiculos = veiculo::select('veiculos.id', 'veiculos.placa')
                ->join('secretarias', 'secretarias.id', '=', 'veiculos.secretaria_id')
                ->join('users_secretarias', 'users_secretarias.secretaria_id', '=', 'secretarias.id')
                ->where('users_secretarias.user_id', '=', Auth::user()->id)
                ->orderBy('placa')
                ->get();
        return view('relatorioVeiculo.index', compact('title', 'veiculos'));
    }

    public function gerar()
    {
        $this->validate(request(), [
            'veiculo_id' => 'required',
            'inicio' => 'required',
            'fim' => 'required'
        ], [
            'veiculo_id.required' => 'O campo veiculo precisa ser informado. Por favor, você pode verificar isso?'
        ]);
        $title = 'Relatório do Veículo';
        $veiculo_id = request()->get('veiculo_id');
        $inicio = request()->get('inicio');
        $fim = request()->get('fim');
        $horaInicio = request()->get('hora_inicio');
        $horaFim = request()->get('hora_fim');

        $rawPrefix = 'SELECT rastreamentos.id, DATE_FORMAT(data_hora, "%d/%m/%Y") as data,
                 DATE_FORMAT(data_hora, "%H:%i") as hora,
                  latitude, longitude, velocidade, tempo, ignicao, rua, cidade, estado, (
                 SELECT CASE
                   WHEN tipo_alerta = 3 THEN "Desligada"
                   WHEN tipo_alerta = 6 THEN "Ligada"
                 END
                 FROM rastreador_alertas
                 WHERE rastreador_alertas.data_hora <= rastreamentos.data_hora
                 AND rastreador_alertas.rastreador_id = rastreamentos.rastreador_id
                 AND (tipo_alerta = 3 OR tipo_alerta = 6)
                 ORDER BY rastreador_alertas.data_hora DESC
                 LIMIT 1)
                 as ignicao
                 FROM rastreamentos
                 INNER JOIN veiculos
                 ON veiculos.n_serie_rastreador = rastreamentos.rastreador_id
                 WHERE veiculos.id = ?';

        // Se a hora não for setada
        if($horaInicio == null || $horaFim == null) {
            $rawRastreamentos = DB::select(
                DB::raw(
                    $rawPrefix . ' AND DATE_FORMAT(rastreamentos.data_hora, "%Y-%m-%d") BETWEEN ? AND ? ORDER BY DATE_FORMAT(rastreamentos.data_hora, "%Y-%m-%d") ASC, hora ASC'
                ),
                array(
                    $veiculo_id, $inicio, $fim
                )
            );
        } else {
            $rawRastreamentos = DB::select(
                DB::raw(
                    $rawPrefix . ' AND DATE_FORMAT(rastreamentos.data_hora, "%Y-%m-%d %H:%i") BETWEEN ? AND ? ORDER BY DATE_FORMAT(rastreamentos.data_hora, "%Y-%m-%d") ASC, hora ASC'
                ),
                array(
                    $veiculo_id, $inicio . ' ' . $horaInicio, $fim . ' ' . $horaFim
                )
            );
        }

        $rastreamentosUteis = [];
        //AGRUPA O TEMPO DOS REGISTROS COM VEICULO PARADO
        for ($i = 0; $i < (count($rawRastreamentos) - 1); $i++) {
            if (($rawRastreamentos[$i]->velocidade == 0) && ($rawRastreamentos[$i]->ignicao) == "Ligada") {
                if (($rawRastreamentos[$i + 1]->velocidade == 0) && ($rawRastreamentos[$i + 1]->ignicao) == "Ligada") {
                    $rawRastreamentos[$i]->tempo += $rawRastreamentos[$i + 1]->tempo;
                    array_splice($rawRastreamentos, $i + 1, 1);
                    $i--;
                } else
                    array_push($rastreamentosUteis, $rawRastreamentos[$i]);
            } else
                array_push($rastreamentosUteis, $rawRastreamentos[$i]);
        }

        $cliente = prefeitura::first();
        if ($cliente->nome == "Rastreamento Privado" || $cliente->nome == '') {
            $empresa_id = Auth::user()->empresa_id;
            $cliente = empresa::where('id', '=', $empresa_id)->first();
            $cliente->nome = $cliente->razao_social;
            $cliente->endereco = $cliente->logradouro . ", " . $cliente->numero . " - " . $cliente->cidade . ", " . $cliente->estado;
        }

        $inicio = Carbon::createFromFormat('Y-m-d', $inicio)->format('d/m/Y');
        $fim = Carbon::createFromFormat('Y-m-d', $fim)->format('d/m/Y');
        $veiculo = veiculo::find($veiculo_id);
        $placa = $veiculo->placa;
        $prefixo = $veiculo->prefixo;

        return view('relatorioVeiculo.relatorio', compact(
            'title',
            'rastreamentosUteis',
            'cliente',
            'inicio',
            'fim',
            'placa',
            'prefixo'
        ));
    }
}
