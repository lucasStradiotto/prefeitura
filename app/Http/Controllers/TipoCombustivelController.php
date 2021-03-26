<?php

namespace App\Http\Controllers;

use App\Http\Requests\tipoCombustivelFormRequest;
use App\Models\tipoCombustivel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class TipoCombustivelController extends Controller
{
    private $tipoCombustivel;
    private $qtdShow = 10;

    public function __construct(tipoCombustivel $tipoCombustivel)
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
        $this->tipoCombustivel = $tipoCombustivel;
    }

    public function index()
    {
        $title = 'Tipos de Combustível';
        $tiposCombustivel = $this->tipoCombustivel->orderBy('descricao')->paginate($this->qtdShow);

        return view('tipoCombustivel.index', compact('title', 'tiposCombustivel'));
    }

    public function create()
    {
        $title = 'Cadastrar Tipo de Combustível';

        return view('tipoCombustivel.create', compact('title'));
    }

    public function edit($idTipoCombustivel)
    {
        $tipoCombustivel = $this->tipoCombustivel->find($idTipoCombustivel);

        $title = "Editar Tipo de Combustível: {$tipoCombustivel->descricao}";

        return view('tipoCombustivel.create', compact('title', 'tipoCombustivel'));
    }

    public function store(tipoCombustivelFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = $this->tipoCombustivel->create($dataForm);
        if ($insert) {
            return redirect()->route('indexTipoCombustivel');
        } else {
            return redirect()->back();
        }
    }

    public function update(tipoCombustivelFormRequest $request, $idTipoCombustivel)
    {
        $dataForm = $request->all();
        $tipoCombustivel = $this->tipoCombustivel->find($idTipoCombustivel);

        $update = $tipoCombustivel->update($dataForm);

        if ($update) {
            return redirect()->route('indexTipoCombustivel');
        } else {
            return redirect()->route('editTipoCombustivel', $idTipoCombustivel)->with(['errors' => 'Falha ao editar']);
        }
    }

    public function delete($idTipoCombustivel){
        $tipoCombustivel = $this->tipoCombustivel->find($idTipoCombustivel);
        $descricao = $tipoCombustivel->descricao;
        $delete = $tipoCombustivel->delete();
        if($delete){
            return redirect()->route('indexTipoCombustivel')->with('message','Tipo de combustível '.$descricao.' removido com sucesso.');
        }else{
            return redirect()->back()->with('Erro ao tentar excluir');
        }
    }

    public function details($idTipoCombustivel){
        $tipoCombustivel = $this->tipoCombustivel->find($idTipoCombustivel);
        $title = "Visualizar Tipo de Combustível: {$tipoCombustivel->descricao}";
        return view('tipoCombustivel.details',compact('tipoCombustivel','title'));
    }
}
