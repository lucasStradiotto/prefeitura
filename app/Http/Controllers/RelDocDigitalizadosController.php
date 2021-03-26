<?php

namespace App\Http\Controllers;

use App\Models\PossivelObservacao;
use App\Models\secretaria;
use App\Models\Ged;
use App\Models\GedObservacao;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;

class RelDocDigitalizadosController extends Controller
{
    public function __construct()
    {
        Session::put('url.intent', URL::current());
        $this->middleware('auth');
    }

    public function index()
    {
        $title = 'Relatório de Documentos Digitalizados';
        return view ('relDocDigitalizados.index', compact('title'));
    }

    public function gerar(Request $request)
    {
        $title = 'Resultados';

        $mes = request()->get('mes');
        $ano = request()->get('ano');
        $secretaria_id = request()->get('secretaria');

        $secretaria = secretaria::
        where('id' ,  $secretaria_id)
        ->first();

        $quantReg = Ged::
        where('data', 'LIKE', '%'.$ano.'-'.$mes.'%')
        ->where('secretaria', '=', $secretaria->nome)
        ->count();

        $registros = Ged::
        where('data', 'LIKE', '%'.$ano.'-'.$mes.'%')
        ->where('secretaria', '=', $secretaria->nome)
        ->get();

        $ged_ids = [];

        foreach($registros as $registro)
        {
            array_push($ged_ids, $registro->id);
        }
        $relat= "";

        $setores = "";
        $quadras = "";
        $qtds = "";
        $lotes = "";

        $registrosGed = Ged::
        where('data', 'LIKE', '%'.$ano.'-'.$mes.'%')
        ->where('secretaria', '=', $secretaria->nome)
        ->select('id')
        ->get();

        $idsGed = [];

        foreach($registrosGed as $registroGed)
        {
            array_push($idsGed, $registroGed->id);
        }

        $idsGedObs = [];

        $registrosQuadras = GedObservacao::
        whereIn('ged_id', $idsGed)
        ->where('nome_observacao', 'Quadra')
        ->select('valor_observacao')
        ->distinct()
        ->get();



        //Foreach por Quadras
        foreach($registrosQuadras as $registroQuadra)
        {
            $qtdProjDig = GedObservacao::
            whereIn('ged_id', $idsGed)
            ->where('nome_observacao', 'Quadra')
            ->where('valor_observacao', $registroQuadra->valor_observacao)
            ->count();

            $req1 = GedObservacao::
            whereIn('ged_id', $idsGed)
            ->where('nome_observacao', 'Quadra')
            ->where('valor_observacao', $registroQuadra->valor_observacao)
            ->get();

            $idsGed2 = [];

            foreach($req1 as $req)
            {
                array_push($idsGed2, $req->ged_id);
            }

            $reqs2 = GedObservacao::
            whereIn('ged_id', $idsGed)
            ->where('nome_observacao', 'Setor')
            ->select('valor_observacao')
            ->distinct()
            ->first();

            $reqs3 = GedObservacao::
                whereIn('ged_id', $idsGed2)
                ->where('nome_observacao', 'Lote')
                ->get();

            $acum2 = "";

            foreach($reqs3 as $req3)
            {
                $acum2 .= $req3->valor_observacao.", ";
            }
                $setores .=  "<div>$reqs2->valor_observacao</div>";
                $quadras .=  "<div>$registroQuadra->valor_observacao</div>";
                $qtds .=  "<div>$qtdProjDig</div>";
                $lotes .=  "<div>$acum2</div>";
            
        }
        $relat = "
        <style>
        .div_rel_central
        {
            width: 100%;
            background-color:#fff;
        }
        .div_setor, .div_quadra, .div_qtdProj, .div_lote
        {
            text-align:center;
            width: 24%;
            display: inline-block;
            margin: 0 auto;
            border:1px solid #000;
        }
        .div_setor div, .div_quadra div, .div_qtdProj div, .div_lote div
        {
            border:1px solid #000;
        }
        </style>

        <div id='div_rel_central' class='div_rel_central'>
            <div id='div_setor' class='div_setor'>
                Setores  $setores
            </div>
            <div id='div_quadra' class='div_quadra'>
                Quadras $quadras
            </div>
            <div id='div_lote' class='div_lote'>
                Lotes  $lotes
            </div>
            <div id='div_qtdProj' class='div_qtdProj'>
                Quant. de Proj. Dig.  $qtds
            </div>
        </div>
        ";
        return view ('relDocDigitalizados.gerar', compact('title','relat'));
    }

    public function getSecretarias()
    {
        $retorno = secretaria::all();
        return $retorno;
    }

    public function getNomeObservacao(Request $request)
    {
        $id_secretaria = $request->get('id_secretaria');
        $retorno = PossivelObservacao::where('secretaria_id', $id_secretaria)->get();
        return $retorno;
    }
}
