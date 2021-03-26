<?php

namespace App\Http\Controllers;

use App\Http\Requests\preventivaFormRequest;
use App\Models\preventiva;
use App\Models\tipoPreventiva;
use App\Models\unidadeIntervalo;
use App\Models\veiculo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class PreventivaController extends Controller
{
    private $preventiva;
    private $qtdShow = 10;
    private $veiculo;
    private $tipoPreventiva;
    private $unidadeIntervalo;

    public function __construct(
        preventiva $preventiva,
        veiculo $veiculo,
        tipoPreventiva $tipoPreventiva,
        unidadeIntervalo $unidadeIntervalo
    ) {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
        $this->preventiva = $preventiva;
        $this->veiculo = $veiculo;
        $this->tipoPreventiva = $tipoPreventiva;
        $this->unidadeIntervalo = $unidadeIntervalo;
    }

    public function index()
    {
        $title = 'Preventivas';

        $userempresa = \Illuminate\Support\Facades\Auth::user()->empresa_id;
        $veiculos = Veiculo::where('empresa_id', '=', $userempresa)->get();
        $preventivas = preventiva::join('veiculos','veiculos.id','=','preventivas.veiculo_id')
            ->join('empresas','empresas.id','=',"veiculos.empresa_id")
            ->where('veiculos.empresa_id','=',$userempresa)->get();
        $tiposPreventiva = $this->tipoPreventiva->all();
        $unidadesIntervalo = $this->unidadeIntervalo->all();

        return view('preventiva.index',
            compact('preventivas', 'title', 'veiculos', 'tiposPreventiva', 'unidadesIntervalo'));
    }

    public function create()
    {
        $title = "Cadastrar Preventiva";
        $userempresa = \Illuminate\Support\Facades\Auth::user()->empresa_id;
        //$veiculos = Veiculo::where('empresa_id', '=', $userempresa)->get();
        $veiculos = Veiculo::all();
        $tiposPreventiva = $this->tipoPreventiva->all();
        $unidadesIntervalo = $this->unidadeIntervalo->all();

        return view("preventiva.create", compact('title', 'veiculos', 'tiposPreventiva', 'unidadesIntervalo'));
    }

    public function edit($idPreventiva)
    {
        $userempresa = \Illuminate\Support\Facades\Auth::user()->empresa_id;
        $veiculos = Veiculo::where('empresa_id', '=', $userempresa)->get();
        $preventiva = $this->preventiva->find($idPreventiva);
        $tiposPreventiva = $this->tipoPreventiva->all();
        $unidadesIntervalo = $this->unidadeIntervalo->all();

        $title = "Editar Preventiva: {$preventiva->nome}";

        return view('preventiva.create',
            compact('title', 'preventiva', 'veiculos', 'tiposPreventiva', 'unidadesIntervalo'));
    }

    public function store(preventivaFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = $this->preventiva->create($dataForm);
        if ($insert) {
            return redirect()->route('indexPreventiva');
        } else {
            return redirect()->back();
        }
    }

    public function update(preventivaFormRequest $request, $idPreventiva)
    {
        $dataForm = $request->all();
        $preventiva = $this->preventiva->find($idPreventiva);
        $update = $preventiva->update($dataForm);

        if ($update) {
            return redirect()->route('indexPreventiva');
        } else {
            return redirect()->route('editPreventiva', $idPreventiva)->with(['errors' => 'Falha ao editar']);
        }
    }

    public function getVeiculoEspecifico()
    {
        return json_encode(
            DB::select(
                DB::raw(
                    "SELECT `modelo`, `cor` 
                        FROM `veiculos` 
                        WHERE `id` = ?"
                ),
                array(
                    request()->get('veiculo_id')
                )
            )
        );
    }
}