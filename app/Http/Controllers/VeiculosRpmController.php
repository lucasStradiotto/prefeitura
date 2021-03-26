<?php

namespace App\Http\Controllers;

use App\Models\veiculo;
use App\Models\VeiculosRpm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class VeiculosRpmController extends Controller
{
    public function __construct()
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
    }

    public function index()
    {
        $title = "Veículos Rpm";
        $veiculosRpm = VeiculosRpm::all();
        $veiculosPlacas = veiculo::all();

        return view('veiculosRpm.index', compact('title', 'veiculosRpm', 'veiculosPlacas'));
    }

    public function create()
    {
        $title = "Cadastrar Rpm";
        $idsRpm = DB::select(
            DB::raw("SELECT veiculo_id FROM veiculos_rpm")
        );
        $arr = json_decode(json_encode($idsRpm), true);

        $stringArr = [];
        $auxString = "";

        for ($i = 0; $i < count($arr); $i++) {
            array_push($stringArr, $arr[$i]['veiculo_id']);
        }

        for ($j = 0; $j < count($stringArr); $j++) {
            if ($j == count($stringArr) - 1) {
                $auxString .= (string)$stringArr[$j];
            } else {
                $auxString .= (string)$stringArr[$j] . ",";
            }
        }

        $veiculos = DB::select(
            DB::raw(
                "SELECT DISTINCT veiculos.id, veiculos.placa
              FROM veiculos
              INNER JOIN veiculos_rpm ON veiculos.id NOT IN (" . $auxString . ")"
            ),
            array()
        );

        return view('veiculosRpm.create', compact('title', 'veiculos'));
    }

    public function store()
    {
        $dataForm = \request()->all();
        $insert = VeiculosRpm::create($dataForm);
        if ($insert) {
            return redirect()->route('createVeiculosRpm');
        } else {
            return redirect()->back();
        }
    }

    public function update($idVeiculo)
    {
        $title = "Alteração de RPM";
        $veiculo = DB::select(
            DB::raw(
                "SELECT placa FROM veiculos WHERE id = ?"
            ), array($idVeiculo)
        );
        return view('veiculosRpm.update', compact('title', 'veiculo', 'idVeiculo'));
    }

    public function updated()
    {
        $dataForm = \request()->all();

        $update = DB::update(
            DB::raw(
                "UPDATE veiculos_rpm SET rpm = ? WHERE veiculo_id = ?"
            ),
            array(
                $dataForm['novoRpm'],
                $dataForm['idVeiculo']
            )
        );

        if ($update) {
            return redirect()->route('veiculosRpm');
        } else {
            return redirect()->back();
        }
    }
}
