<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParametrosFiscalizacaoFormRequest;
use App\Models\SituacaoConstrucao;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class SituacaoConstrucaoController extends Controller
{
    private $qtdShow = 10;

    public function __construct()
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
    }

    public function index()
    {
        $title = 'Listagem de Situação Construção';
        $situacoes = SituacaoConstrucao::orderBy('descricao')->paginate($this->qtdShow);

        return view('parametrosFiscalizacao.situacaoConstrucao.index', compact('situacoes', 'title'));
    }

    public function create()
    {
        $title = "Cadastrar Situação Construção";

        return view("parametrosFiscalizacao.situacaoConstrucao.create", compact('title'));
    }

    public function edit($id)
    {
        $situacao = SituacaoConstrucao::find($id);

        $title = "Editar Situação Construção: {$situacao->descricao}";

        return view('parametrosFiscalizacao.situacaoConstrucao.create', compact('title', 'situacao'));
    }

    public function store(ParametrosFiscalizacaoFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = SituacaoConstrucao::create($dataForm);
        if ($insert) {
            return redirect()->route('indexSituacaoConstrucao');
        } else {
            return redirect()->back();
        }
    }

    public function update(ParametrosFiscalizacaoFormRequest $request, $id)
    {
        $dataForm = $request->all();
        $situacao = SituacaoConstrucao::find($id);

        $update = $situacao->update($dataForm);

        if ($update) {
            return redirect()->route('indexSituacaoConstrucao');
        } else {
            return redirect()->route('editSituacaoConstrucao', $id)->with(['errors' => 'Falha ao editar']);
        }
    }

    public function delete($id)
    {
        $situacao = SituacaoConstrucao::find($id);

        $delete = $situacao->delete();
        if ($delete){
            return redirect()->route('indexSituacaoConstrucao')->with("message", "$situacao->descricao excluído.");
        } else {
            return redirect()->route('indexSituacaoConstrucao')->with("error", "Falha ao deletar");
        }
    }
}