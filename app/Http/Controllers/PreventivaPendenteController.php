<?php

namespace App\Http\Controllers;

use App\Models\preventiva;
use App\Models\secretaria;
use App\Models\tipoPreventiva;
use App\Models\veiculo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class PreventivaPendenteController extends Controller
{
    private $preventiva;
    private $veiculo;
    private $tipoPreventiva;
    private $secretaria;

    public function __construct(
        preventiva $preventiva,
        veiculo $veiculo,
        tipoPreventiva $tipoPreventiva,
        secretaria $secretaria
    ) {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
        $this->preventiva = $preventiva;
        $this->veiculo = $veiculo;
        $this->tipoPreventiva = $tipoPreventiva;
        $this->secretaria = $secretaria;
    }

    public function index()
    {
        $title = 'Preventivas Pendentes';

        $dataAgora = explode(" ", Carbon::now())[0];
        $preventivasQuery = $this->preventiva->all();
        $preventivas = [];
        $veiculos = [];
        $tiposPreventiva = [];
        $secretarias = [];

        $i = 0;
        foreach ($preventivasQuery as $preventiva) {
            $dataPreventiva = explode(" ", $preventiva->data_ultima_manutencao)[0];
            $ano = explode("-", $dataPreventiva)[0];
            $mes = explode("-", $dataPreventiva)[1];
            $dia = explode("-", $dataPreventiva)[2];
            $dataPreventiva = Carbon::createFromDate($ano, $mes, $dia);
            $dataPreventiva->addDays($preventiva->intervalo);

            if ($dataPreventiva < $dataAgora) {
                $preventivas[$i] = $preventiva;
                $veiculos[$i] = $this->veiculo->where("id", "=", $preventiva->veiculo_id)->get();
                $tiposPreventiva[$i] = $this->tipoPreventiva->where("id", "=", $preventiva->tipo_preventiva_id)->get();
                $secretarias[$i] = $this->secretaria->where("id", "=", $veiculos[$i][0]->secretaria_id)->get();
                $i++;
            }
        }
        return view('preventivaPendente.index',
            compact('title', 'preventivas', 'veiculos', 'tiposPreventiva', 'secretarias'));
    }
}