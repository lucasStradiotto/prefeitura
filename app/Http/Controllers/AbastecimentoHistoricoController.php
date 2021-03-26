<?php

namespace App\Http\Controllers;

use App\Models\abastecimento;
use App\Models\secretaria;
use App\Models\veiculo;
use App\Models\veiculos_cota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Image;

class AbastecimentoHistoricoController extends Controller
{
    public function __construct(veiculo $veiculo, secretaria $secretaria, abastecimento $abastecimento, veiculos_cota $cota)
    {
        $this->middleware('auth');
        Session::put('url.intended', URL::current());
        $this->veiculo = $veiculo;
        $this->secretaria = $secretaria;
        $this->abastecimento = $abastecimento;
        $this->cota = $cota;
    }

    function index()
    {
        $title = "Histórico de Abastecimento";
        $postoid = Auth::user()->posto_id;
        $histabast = abastecimento::where('posto_id', $postoid)
            ->orderByDesc('data')
            ->get();
//        $histabast = DB::select(
//            DB::raw(
//                "SELECT *
//                        FROM abastecimentos
//                        WHERE abastecimentos.posto_id = ?
//                        ORDER BY `abastecimentos`.`data`  DESC
//                        "
//            ),
//            array(
//                $postoid
//            )
//        );

        return view('abastecimentoHistorico.index', compact('title', 'histabast'));
    }

    function autorizacaoAbastecimento($id)
    {

        $title = "Autorização de Abastecimento";
        $prefeitura = DB::select(
            DB::raw(
                "SELECT *
                        FROM prefeituras
                        LIMIT 1
                        "
            ),
            array()
        );

        $abastecimentos = DB::select(
            DB::raw(
                "       SELECT * 
                        FROM `abastecimentos`
                        INNER JOIN veiculos
                        ON veiculos.id = abastecimentos.veiculo_id
                        INNER JOIN postos_de_gasolinas
                        On postos_de_gasolinas.id = abastecimentos.posto_id
                        WHERE abastecimentos.id = ?
                        limit 1
                        "
            ),
            array(
                $id
            )
        );
        $abastecimento = $abastecimentos[0];
        $valortotal = $abastecimento->litros * $abastecimento->valor_unitario;
        return view('abastecimentoHistorico.autorizacaoAbastecimento', compact('title', 'prefeitura', 'abastecimento','valortotal'));
    }
}
