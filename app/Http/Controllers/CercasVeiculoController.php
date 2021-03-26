<?php

namespace App\Http\Controllers;

use App\Http\Requests\cercaVeiculoFormRequest;
use App\Models\cercasEletronica;
use App\Models\cercasVeiculo;
use App\Models\veiculo;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class CercasVeiculoController extends Controller
{
    private $cercaVeiculo;
    private $veiculo;
    private $cercaEletronica;

    public function __construct(cercasVeiculo $cercaVeiculo, veiculo $veiculo, cercasEletronica $cercasEletronica)
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
        $this->cercaVeiculo = $cercaVeiculo;
        $this->veiculo = $veiculo;
        $this->cercaEletronica = $cercasEletronica;
    }

    public function index()
    {
        $title = 'Listagem de Cercas/Veículos';
        $cercasVeiculos = $this->cercaVeiculo->all();
        $veiculos = $this->veiculo->all();
        $cercasEletronicas = $this->cercaEletronica->all();

        return view('cercaVeiculo.index', compact('cercasVeiculos', 'title', 'veiculos', 'cercasEletronicas'));
    }

    public function create()
    {
        $title = "Cadastrar Cercas/Veículos";
        $veiculos = $this->veiculo->all();
        $cercasEletronicas = $this->cercaEletronica->all();

        return view("cercaVeiculo.create", compact('title', 'veiculos', 'cercasEletronicas'));
    }

    public function edit($idCercaVeiculo)
    {
        $cercaVeiculo = $this->cercaVeiculo->find($idCercaVeiculo);
        $veiculos = $this->veiculo->all();
        $cercasEletronicas = $this->cercaEletronica->all();

        $title = "Editar Cerca/Veículo";

        return view('cercaVeiculo.create', compact('title', 'cercaVeiculo', 'veiculos', 'cercasEletronicas'));
    }

    public function store(cercaVeiculoFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = $this->cercaVeiculo->create($dataForm);
        if ($insert) {
            return redirect()->route('indexCercaVeiculo');
        } else {
            return redirect()->back();
        }
    }

    public function update(cercaVeiculoFormRequest $request, $idCercaVeiculo)
    {
        $dataForm = $request->all();
        $cercaVeiculo = $this->cercaVeiculo->find($idCercaVeiculo);

        $update = $cercaVeiculo->update($dataForm);

        if ($update) {
            return redirect()->route('indexCercaVeiculo');
        } else {
            return redirect()->route('editCercaVeiculo', $idCercaVeiculo)->with(['errors' => 'Falha ao editar']);
        }
    }
}
