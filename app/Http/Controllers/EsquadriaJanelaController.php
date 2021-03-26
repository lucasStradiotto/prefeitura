<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParametrosFiscalizacaoFormRequest;
use App\Models\EsquadriaJanela;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class EsquadriaJanelaController extends Controller
{
    private $qtdShow = 10;

    public function __construct()
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
    }

    public function index()
    {
        $title = 'Listagem de Esquadrias Janelas';
        $esquadrias = EsquadriaJanela::orderBy('descricao')->paginate($this->qtdShow);

        return view('parametrosFiscalizacao.esquadriaJanela.index', compact('esquadrias', 'title'));
    }

    public function create()
    {
        $title = "Cadastrar Esquadria Janela";

        return view("parametrosFiscalizacao.esquadriaJanela.create", compact('title'));
    }

    public function edit($id)
    {
        $esquadria = EsquadriaJanela::find($id);

        $title = "Editar Esquadria Janela: {$esquadria->descricao}";

        return view('parametrosFiscalizacao.esquadriaJanela.create', compact('title', 'esquadria'));
    }

    public function store(ParametrosFiscalizacaoFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = EsquadriaJanela::create($dataForm);
        if ($insert) {
            return redirect()->route('indexEsquadriaJanela');
        } else {
            return redirect()->back();
        }
    }

    public function update(ParametrosFiscalizacaoFormRequest $request, $id)
    {
        $dataForm = $request->all();
        $esquadria = EsquadriaJanela::find($id);

        $update = $esquadria->update($dataForm);

        if ($update) {
            return redirect()->route('indexEsquadriaJanela');
        } else {
            return redirect()->route('editEsquadriaJanela', $id)->with(['errors' => 'Falha ao editar']);
        }
    }

    public function delete($id)
    {
        $esquadria = EsquadriaJanela::find($id);

        $delete = $esquadria->delete();
        if ($delete){
            return redirect()->route('indexEsquadriaJanela')->with("message", "$esquadria->descricao excluído.");
        } else {
            return redirect()->route('indexEsquadriaJanela')->with("error", "Falha ao deletar");
        }
    }
}