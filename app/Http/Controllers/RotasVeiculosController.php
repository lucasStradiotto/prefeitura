<?php

namespace App\Http\Controllers;

use App\Http\Requests\rotasVeiculosFormRequest;
use App\Models\Rota;
use App\Models\rotasVeiculos;
use App\Models\veiculo;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class RotasVeiculosController extends Controller
{
    private $rotaVeiculo;
    private $veiculo;
    private $rota;

    public function __construct(rotasVeiculos $rotasVeiculos, veiculo $veiculo, Rota $rota)
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
        $this->rotaVeiculo = $rotasVeiculos;
        $this->veiculo = $veiculo;
        $this->rota = $rota;
    }

    public function index()
    {
        $title = 'Listagem de Rotas/Veículos';
        $rotasVeiculos = $this->rotaVeiculo->all();
        $veiculos = $this->veiculo->all();
        $rotas = $this->rota->all();

        return view('rotasVeiculos.index', compact('rotasVeiculos', 'title', 'veiculos', 'rotas'));
    }

    public function create()
    {
        $title = "Cadastrar Rotas/Veículos";
        $veiculos = $this->veiculo->all();
        $rotas = $this->rota->all();

        return view("rotasVeiculos.create", compact('title', 'veiculos', 'rotas'));
    }

    public function edit($idRotaVeiculo)
    {
        $rotaVeiculo = $this->rotaVeiculo->find($idRotaVeiculo);
        $veiculos = $this->veiculo->all();
        $rotas = $this->rota->all();

        $title = "Editar Rota/Veículo";

        return view('rotasVeiculos.create', compact('title', 'rotaVeiculo', 'veiculos', 'rotas'));
    }

    public function store(rotasVeiculosFormRequest $request)
    {
        $dataForm = $request->all();
        $toDelete = $this->rotaVeiculo->where('veiculo_id', '=', $dataForm['veiculo_id'])->get();
        if (count($toDelete) > 0) {
            $toDelete[0]->delete();
        }
        $insert = $this->rotaVeiculo->create($dataForm);
        if ($insert) {
            return redirect()->route('indexRotaVeiculo');
        } else {
            return redirect()->back();
        }
    }

    public function update(rotasVeiculosFormRequest $request, $idRotaVeiculo)
    {
        $dataForm = $request->all();
        $rotaVeiculo = $this->rotaVeiculo->find($idRotaVeiculo);

        $update = $rotaVeiculo->update($dataForm);

        if ($update) {
            return redirect()->route('indexRotaVeiculo');
        } else {
            return redirect()->route('editRotaVeiculo', $idRotaVeiculo)->with(['errors' => 'Falha ao editar']);
        }
    }

    public function delete($idRotaVeiculo){
        
        $rotaVeiculo = $this->rotaVeiculo->find($idRotaVeiculo);

        $delete = $rotaVeiculo->delete();

        if ($delete) {
            return redirect()->route('indexRotaVeiculo')->with('message', 'Item removido com sucesso.');
        } else {
            return redirect()->back()->with('errors', 'Erro ao tentar excluir.');
        }
    }
}
