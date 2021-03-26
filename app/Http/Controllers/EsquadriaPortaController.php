<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParametrosFiscalizacaoFormRequest;
use App\Models\EsquadriaPorta;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class EsquadriaPortaController extends Controller
{
    private $qtdShow = 10;

    public function __construct()
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
    }

    public function index()
    {
        $title = 'Listagem de Esquadrias Portas';
        $esquadrias = EsquadriaPorta::orderBy('descricao')->paginate($this->qtdShow);

        return view('parametrosFiscalizacao.esquadriaPorta.index', compact('esquadrias', 'title'));
    }

    public function create()
    {
        $title = "Cadastrar Esquadria Porta";

        return view("parametrosFiscalizacao.esquadriaPorta.create", compact('title'));
    }

    public function edit($id)
    {
        $esquadria = EsquadriaPorta::find($id);

        $title = "Editar Esquadria Porta: {$esquadria->descricao}";

        return view('parametrosFiscalizacao.esquadriaPorta.create', compact('title', 'esquadria'));
    }

    public function store(ParametrosFiscalizacaoFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = EsquadriaPorta::create($dataForm);
        if ($insert) {
            return redirect()->route('indexEsquadriaPorta');
        } else {
            return redirect()->back();
        }
    }

    public function update(ParametrosFiscalizacaoFormRequest $request, $id)
    {
        $dataForm = $request->all();
        $esquadria = EsquadriaPorta::find($id);

        $update = $esquadria->update($dataForm);

        if ($update) {
            return redirect()->route('indexEsquadriaPorta');
        } else {
            return redirect()->route('editEsquadriaPorta', $id)->with(['errors' => 'Falha ao editar']);
        }
    }

    public function delete($id)
    {
        $esquadria = EsquadriaPorta::find($id);

        $delete = $esquadria->delete();
        if ($delete){
            return redirect()->route('indexEsquadriaPorta')->with("message", "$esquadria->descricao excluído.");
        } else {
            return redirect()->route('indexEsquadriaPorta')->with("error", "Falha ao deletar");
        }
    }
}