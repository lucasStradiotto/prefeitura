<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParametrosFiscalizacaoFormRequest;
use App\Models\EstruturaTelhado;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class EstruturaTelhadoController extends Controller
{
    private $qtdShow = 10;

    public function __construct()
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
    }

    public function index()
    {
        $title = 'Listagem de Estruturas Telhado';
        $estruturas = EstruturaTelhado::orderBy('descricao')->paginate($this->qtdShow);

        return view('parametrosFiscalizacao.estruturaTelhado.index', compact('estruturas', 'title'));
    }

    public function create()
    {
        $title = "Cadastrar Estrutura Telhado";

        return view("parametrosFiscalizacao.estruturaTelhado.create", compact('title'));
    }

    public function edit($id)
    {
        $estrutura = EstruturaTelhado::find($id);

        $title = "Editar Estrutura Telhado: {$estrutura->descricao}";

        return view('parametrosFiscalizacao.estruturaTelhado.create', compact('title', 'estrutura'));
    }

    public function store(ParametrosFiscalizacaoFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = EstruturaTelhado::create($dataForm);
        if ($insert) {
            return redirect()->route('indexEstruturaTelhado');
        } else {
            return redirect()->back();
        }
    }

    public function update(ParametrosFiscalizacaoFormRequest $request, $id)
    {
        $dataForm = $request->all();
        $estrutura = EstruturaTelhado::find($id);

        $update = $estrutura->update($dataForm);

        if ($update) {
            return redirect()->route('indexEstruturaTelhado');
        } else {
            return redirect()->route('editEstruturaTelhado', $id)->with(['errors' => 'Falha ao editar']);
        }
    }

    public function delete($id)
    {
        $estrutura = EstruturaTelhado::find($id);

        $delete = $estrutura->delete();
        if ($delete){
            return redirect()->route('indexEstruturaTelhado')->with("message", "$estrutura->descricao excluído.");
        } else {
            return redirect()->route('indexEstruturaTelhado')->with("error", "Falha ao deletar");
        }
    }
}
