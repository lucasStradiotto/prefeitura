<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParametrosFiscalizacaoFormRequest;
use App\Models\Elevador;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class ElevadorController extends Controller
{
    private $qtdShow = 10;

    public function __construct()
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
    }

    public function index()
    {
        $title = 'Listagem de Elevadores';
        $elevadores = Elevador::orderBy('descricao')->paginate($this->qtdShow);

        return view('parametrosFiscalizacao.elevador.index', compact('elevadores', 'title'));
    }

    public function create()
    {
        $title = "Cadastrar Elevador";

        return view("parametrosFiscalizacao.elevador.create", compact('title'));
    }

    public function edit($id)
    {
        $elevador = Elevador::find($id);

        $title = "Editar Elevador: {$elevador->descricao}";

        return view('parametrosFiscalizacao.elevador.create', compact('title', 'elevador'));
    }

    public function store(ParametrosFiscalizacaoFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = Elevador::create($dataForm);
        if ($insert) {
            return redirect()->route('indexElevador');
        } else {
            return redirect()->back();
        }
    }

    public function update(ParametrosFiscalizacaoFormRequest $request, $id)
    {
        $dataForm = $request->all();
        $elevador = Elevador::find($id);

        $update = $elevador->update($dataForm);

        if ($update) {
            return redirect()->route('indexElevador');
        } else {
            return redirect()->route('editElevador', $id)->with(['errors' => 'Falha ao editar']);
        }
    }

    public function delete($id)
    {
        $elevador = Elevador::find($id);

        $delete = $elevador->delete();
        if ($delete){
            return redirect()->route('indexElevador')->with("message", "$elevador->descricao excluído.");
        } else {
            return redirect()->route('indexElevador')->with("error", "Falha ao deletar");
        }
    }
}