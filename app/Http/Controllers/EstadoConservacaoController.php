<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParametrosFiscalizacaoFormRequest;
use App\Models\EstadoConservacao;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class EstadoConservacaoController extends Controller
{
    private $qtdShow = 10;

    public function __construct()
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
    }

    public function index()
    {
        $title = 'Listagem de Estado Conservação';
        $estados = EstadoConservacao::orderBy('descricao')->paginate($this->qtdShow);

        return view('parametrosFiscalizacao.estadoConservacao.index', compact('estados', 'title'));
    }

    public function create()
    {
        $title = "Cadastrar Estado Conservação";

        return view("parametrosFiscalizacao.estadoConservacao.create", compact('title'));
    }

    public function edit($id)
    {
        $estado = EstadoConservacao::find($id);

        $title = "Editar Estado Conservação: {$estado->descricao}";

        return view('parametrosFiscalizacao.estadoConservacao.create', compact('title', 'estado'));
    }

    public function store(ParametrosFiscalizacaoFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = EstadoConservacao::create($dataForm);
        if ($insert) {
            return redirect()->route('indexEstadoConservacao');
        } else {
            return redirect()->back();
        }
    }

    public function update(ParametrosFiscalizacaoFormRequest $request, $id)
    {
        $dataForm = $request->all();
        $estado = EstadoConservacao::find($id);

        $update = $estado->update($dataForm);

        if ($update) {
            return redirect()->route('indexEstadoConservacao');
        } else {
            return redirect()->route('editEstadoConservacao', $id)->with(['errors' => 'Falha ao editar']);
        }
    }

    public function delete($id)
    {
        $estado = EstadoConservacao::find($id);

        $delete = $estado->delete();
        if ($delete){
            return redirect()->route('indexEstadoConservacao')->with("message", "$estado->descricao excluído.");
        } else {
            return redirect()->route('indexEstadoConservacao')->with("error", "Falha ao deletar");
        }
    }
}