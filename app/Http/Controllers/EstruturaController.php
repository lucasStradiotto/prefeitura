<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParametrosFiscalizacaoFormRequest;
use App\Models\Estrutura;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class EstruturaController extends Controller
{
    private $qtdShow = 10;

    public function __construct()
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
    }

    public function index()
    {
        $title = 'Listagem de Estruturas';
        $estruturas = Estrutura::orderBy('descricao')->paginate($this->qtdShow);

        return view('parametrosFiscalizacao.estrutura.index', compact('estruturas', 'title'));
    }

    public function create()
    {
        $title = "Cadastrar Estrutura";

        return view("parametrosFiscalizacao.estrutura.create", compact('title'));
    }

    public function edit($id)
    {
        $estrutura = Estrutura::find($id);

        $title = "Editar Estrutura: {$estrutura->descricao}";

        return view('parametrosFiscalizacao.estrutura.create', compact('title', 'estrutura'));
    }

    public function store(ParametrosFiscalizacaoFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = Estrutura::create($dataForm);
        if ($insert) {
            return redirect()->route('indexEstrutura');
        } else {
            return redirect()->back();
        }
    }

    public function update(ParametrosFiscalizacaoFormRequest $request, $id)
    {
        $dataForm = $request->all();
        $estrutura = Estrutura::find($id);

        $update = $estrutura->update($dataForm);

        if ($update) {
            return redirect()->route('indexEstrutura');
        } else {
            return redirect()->route('editEstrutura', $id)->with(['errors' => 'Falha ao editar']);
        }
    }

    public function delete($id)
    {
        $estrutura = Estrutura::find($id);

        $delete = $estrutura->delete();
        if ($delete){
            return redirect()->route('indexEstrutura')->with("message", "$estrutura->descricao excluído.");
        } else {
            return redirect()->route('indexEstrutura')->with("error", "Falha ao deletar");
        }
    }
}
