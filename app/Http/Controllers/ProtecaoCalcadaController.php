<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParametrosFiscalizacaoFormRequest;
use App\Models\ProtecaoCalcada;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class ProtecaoCalcadaController extends Controller
{
    private $qtdShow = 10;

    public function __construct()
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
    }

    public function index()
    {
        $title = 'Listagem de Proteção Calçada';
        $protecoes = ProtecaoCalcada::orderBy('descricao')->paginate($this->qtdShow);

        return view('parametrosFiscalizacao.protecaoCalcada.index', compact('protecoes', 'title'));
    }

    public function create()
    {
        $title = "Cadastrar Proteção Calçada";

        return view("parametrosFiscalizacao.protecaoCalcada.create", compact('title'));
    }

    public function edit($id)
    {
        $protecao = ProtecaoCalcada::find($id);

        $title = "Editar Proteção Calçada: {$protecao->descricao}";

        return view('parametrosFiscalizacao.protecaoCalcada.create', compact('title', 'protecao'));
    }

    public function store(ParametrosFiscalizacaoFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = ProtecaoCalcada::create($dataForm);
        if ($insert) {
            return redirect()->route('indexProtecaoCalcada');
        } else {
            return redirect()->back();
        }
    }

    public function update(ParametrosFiscalizacaoFormRequest $request, $id)
    {
        $dataForm = $request->all();
        $protecao = ProtecaoCalcada::find($id);

        $update = $protecao->update($dataForm);

        if ($update) {
            return redirect()->route('indexProtecaoCalcada');
        } else {
            return redirect()->route('editProtecaoCalcada', $id)->with(['errors' => 'Falha ao editar']);
        }
    }

    public function delete($id)
    {
        $protecao = ProtecaoCalcada::find($id);

        $delete = $protecao->delete();
        if ($delete){
            return redirect()->route('indexProtecaoCalcada')->with("message", "$protecao->descricao excluído.");
        } else {
            return redirect()->route('indexProtecaoCalcada')->with("error", "Falha ao deletar");
        }
    }
}