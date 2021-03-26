<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParametrosFiscalizacaoFormRequest;
use App\Models\SituacaoTerreno;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class SituacaoTerrenoController extends Controller
{
    private $qtdShow = 10;

    public function __construct()
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
    }

    public function index()
    {
        $title = 'Listagem de Situação Terreno';
        $situacoes = SituacaoTerreno::orderBy('descricao')->paginate($this->qtdShow);

        return view('parametrosFiscalizacao.situacaoTerreno.index', compact('situacoes', 'title'));
    }

    public function create()
    {
        $title = "Cadastrar Situação Terreno";

        return view("parametrosFiscalizacao.situacaoTerreno.create", compact('title'));
    }

    public function edit($id)
    {
        $situacao = SituacaoTerreno::find($id);

        $title = "Editar Situação Terreno: {$situacao->descricao}";

        return view('parametrosFiscalizacao.situacaoTerreno.create', compact('title', 'situacao'));
    }

    public function store(ParametrosFiscalizacaoFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = SituacaoTerreno::create($dataForm);
        if ($insert) {
            return redirect()->route('indexSituacaoTerreno');
        } else {
            return redirect()->back();
        }
    }

    public function update(ParametrosFiscalizacaoFormRequest $request, $id)
    {
        $dataForm = $request->all();
        $situacao = SituacaoTerreno::find($id);

        $update = $situacao->update($dataForm);

        if ($update) {
            return redirect()->route('indexSituacaoTerreno');
        } else {
            return redirect()->route('editSituacaoTerreno', $id)->with(['errors' => 'Falha ao editar']);
        }
    }

    public function delete($id)
    {
        $situacao = SituacaoTerreno::find($id);

        $delete = $situacao->delete();
        if ($delete){
            return redirect()->route('indexSituacaoTerreno')->with("message", "$situacao->descricao excluído.");
        } else {
            return redirect()->route('indexSituacaoTerreno')->with("error", "Falha ao deletar");
        }
    }
}