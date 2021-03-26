<?php

namespace App\Http\Controllers;

use App\Http\Requests\tipoVeiculoFormRequest;
use App\Models\tipoVeiculo;
use App\Models\veiculo;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class TipoVeiculoController extends Controller
{
    private $tipoVeiculo;
    private $qtdShow = 10;

    public function __construct(tipoVeiculo $tipoVeiculo)
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
        $this->tipoVeiculo = $tipoVeiculo;
    }

    public function index()
    {

        $title = 'Listagem de Grupos de Veículos';
        $tipoVeiculos = $this->tipoVeiculo->orderBy('nome')->paginate($this->qtdShow);

        $pageAtual = $tipoVeiculos->currentPage();
        $cont = ($pageAtual - 1) * $this->qtdShow;
        foreach($tipoVeiculos as $tipoVeiculo){
            $cont++;
            $tipoVeiculo->cont = $cont;
            switch($tipoVeiculo->icone){
                case 'ambulancia': $tipoVeiculo->svg = "tipoVeiculo.svg.ambulanciaPin";
                    break;
                case 'caminhao': $tipoVeiculo->svg = "tipoVeiculo.svg.caminhao";
                    break;
                case 'carro': $tipoVeiculo->svg = "tipoVeiculo.svg.carro";
                    break;
                case 'moto': $tipoVeiculo->svg = "tipoVeiculo.svg.motoPin";
                    break;
                case 'onibus': $tipoVeiculo->svg = "tipoVeiculo.svg.onibusPin";
                    break;
                case 'trator': $tipoVeiculo->svg = "tipoVeiculo.svg.tratorPin";
                    break;
                default: $tipoVeiculo->svg = "tipoVeiculo.svg.carro";
                break;
            }
            
        }
        return view('tipoVeiculo.index', compact('tipoVeiculos', 'title'));
    }

    public function create()
    {
        $title = "Cadastrar Grupo de Veículos";

        return view("tipoVeiculo.create", compact('title'));
    }

    public function edit($idTipoVeiculo)
    {
        $tipoVeiculo = $this->tipoVeiculo->find($idTipoVeiculo);

        $title = "Editar Grupos de Veículos: {$tipoVeiculo->nome}";

        return view('tipoVeiculo.create', compact('title', 'tipoVeiculo'));
    }

    public function store(tipoVeiculoFormRequest $request)
    {
        $dataForm = $request->all();

        $insert = $this->tipoVeiculo->create($dataForm);
        if ($insert) {
            return redirect()->route('indexTipoVeiculo');
        } else {
            return redirect()->back();
        }
    }

    public function update(tipoVeiculoFormRequest $request, $idTipoVeiculo)
    {
        $dataForm = $request->all();

        $tipoVeiculo = $this->tipoVeiculo->find($idTipoVeiculo);

        $update = $tipoVeiculo->update($dataForm);

        if ($update) {
            return redirect()->route('indexTipoVeiculo');
        } else {
            return redirect()->route('editTipoVeiculo', $idTipoVeiculo)->with(['errors' => 'Falha ao editar']);
        }
    }

    public function delete($idTipoVeiculo){
        $tipoVeiculo = $this->tipoVeiculo->find($idTipoVeiculo);
        $nome = $tipoVeiculo->nome;
        $delete = $tipoVeiculo->delete();
        if($delete){
            return redirect()->route('indexTipoVeiculo')->with('message','Tipo de veículo '.$nome.' removido com sucesso.');
        }else{
            return redirect()->back()->with('errors','Erro ao tentar excluir.');
        }
    }

    public function details($idTipoVeiculo){
        $tipoVeiculo = $this->tipoVeiculo->find($idTipoVeiculo);
        $title = "Visualizar tipo de veículo: {$tipoVeiculo->nome}";
        return view('tipoVeiculo.details',compact('tipoVeiculo','title'));
    }
}
