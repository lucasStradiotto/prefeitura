<?php

namespace App\Http\Controllers;

use App\Models\prefeitura;
use App\Models\veiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;

class RelatorioAutonomiaController extends Controller
{
    public function __construct()
    {
        Session::put('url.intent', URL::current());
        $this->middleware('auth');
    }

    public function index()
    {
        $title = 'Relatório de Autonomia';

        if (prefeitura::first()->nome == "Rastreamento Privado" || prefeitura::first()->nome == '')
            $veiculos = veiculo::where('empresa_id', '=', Auth::user()->empresa_id)
                ->orderBy('placa')->get();
        else
            $veiculos = veiculo::orderBy('placa')
                ->join('secretarias', 'secretarias.id', '=', 'veiculos.secretaria_id')
                ->join('users_secretarias', 'users_secretarias.secretaria_id', '=', 'secretarias.id')
                ->where('users_secretarias.user_id', '=', Auth::user()->id)
                ->get();
        return view ('relatorioAutonomia.index', compact('title', 'veiculos'));
    }

    public function gerar()
    {
        $this->validate(request(), [
            'veiculo_id' => 'required',
            'ano' => 'required',
            'mes' => 'required'
        ], [
            'veiculo_id.required' => 'O campo veiculo precisa ser informado. Por favor, você pode verificar isso?'
        ]);
        $title = 'Relatório do Veículo';
        $veiculo_id = request()->get('veiculo_id');
        $mes = request()->get('mes');
        $ano = request()->get('ano');
        $placa = null;

        $baseQuery = 'SELECT veiculos.id as veiculo_id, veiculos.placa, SUM(litros) as litros, ';
        $baseQuery .= 'MAX(kilometragem) as maximo, MIN(kilometragem) as minimo,  ';
        $baseQuery .= '(MAX(kilometragem) - MIN(kilometragem)) as km, ';
        $baseQuery .= '((MAX(kilometragem) - MIN(kilometragem))/ SUM(litros)) as autonomia ';
        $baseQuery .= 'FROM `abastecimentos` ';
        $baseQuery .= 'INNER JOIN veiculos ON veiculos.id = abastecimentos.veiculo_id ';
        $baseQuery .= 'INNER JOIN tipo_veiculos ON tipo_veiculos.id = veiculos.id_tipo_veiculo ';
        $baseQuery .= 'WHERE tipo_veiculos.instrumento_medida = "Hodômetro" ';
        $baseQuery .= 'AND DATE_FORMAT(abastecimentos.data, "%m") = ? ';
        $baseQuery .= 'AND DATE_FORMAT(abastecimentos.data, "%Y") = ?';

        $baseParams = [(string) $mes, (string) $ano];
        if ($veiculo_id != 0)
        {
            $baseQuery .= ' AND veiculos.id = ?';
            array_push($baseParams, $veiculo_id);
            $placa = veiculo::find($veiculo_id)->placa;
        }

        $baseQuery .= ' GROUP BY(veiculo_id) ORDER BY (placa)';

        $rawAbastecimentos = DB::select(
            DB::raw($baseQuery),
            $baseParams
        );

        $cliente = prefeitura::first();
        if ($cliente->nome == "Rastreamento Privado" || $cliente->nome == '')
        {
            $empresa_id = Auth::user()->empresa_id;
            $cliente = empresa::where('id', '=', $empresa_id)->first();
            $cliente->nome = $cliente->razao_social;
            $cliente->endereco = $cliente->logradouro.", ".$cliente->numero." - ".$cliente->cidade.", ".$cliente->estado;
        }

        return view('relatorioAutonomia.relatorio', compact('title', 'rawAbastecimentos', 'cliente',
            'mes', 'ano', 'placa'));
    }
}
