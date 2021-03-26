<?php

namespace App\Http\Controllers;

use App\Models\Rastreamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class PercentualProdutividadeController extends Controller
{
    private $rastreamento;

    public function __construct(Rastreamento $rastreamento)
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
        $this->rastreamento = $rastreamento;
    }

    public function indexProdutividade()
    {
        $title = "Calcular Percentual de Produtividade";

        return view('percentualProdutividade.index', compact('title'));
    }

    public function gerarRelatorioProdutividade(Request $request)
    {
        $dataForm = $request->all();
        $rastreamentos = DB::select(
            DB::raw(
                'SELECT RASTREAMENTOS.VELOCIDADE
                 FROM RASTREAMENTOS 
                 WHERE CAST(RASTREAMENTOS.DATA_HORA AS DATE) = ?'
            ), array($dataForm["dia"])
        );
        dd($rastreamentos);

        $title = "Índice de Produtividade";

        return view('percentualProdutividade.show', compact('title'));
    }
}
