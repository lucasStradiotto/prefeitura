<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParametrosFiscalizacaoFormRequest;
use App\Models\Cobertura;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class CoberturaController extends Controller
{
    private $qtdShow = 10;

    public function __construct()
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
    }

    public function index()
    {
        $title = 'Listagem de Coberturas';
        $coberturas = Cobertura::orderBy('descricao')->paginate($this->qtdShow);

        return view('parametrosFiscalizacao.cobertura.index', compact('coberturas', 'title'));
    }

    public function create()
    {
        $title = "Cadastrar Cobertura";

        return view("parametrosFiscalizacao.cobertura.create", compact('title'));
    }

    public function edit($id)
    {
        $cobertura = Cobertura::find($id);

        $title = "Editar Cobertura: {$cobertura->descricao}";

        return view('parametrosFiscalizacao.cobertura.create', compact('title', 'cobertura'));
    }

    public function store(ParametrosFiscalizacaoFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = Cobertura::create($dataForm);
        if ($insert) {
            return redirect()->route('indexCobertura');
        } else {
            return redirect()->back();
        }
    }

    public function update(ParametrosFiscalizacaoFormRequest $request, $id)
    {
        $dataForm = $request->all();
        $cobertura = Cobertura::find($id);

        $update = $cobertura->update($dataForm);

        if ($update) {
            return redirect()->route('indexCobertura');
        } else {
            return redirect()->route('editCobertura', $id)->with(['errors' => 'Falha ao editar']);
        }
    }

    public function delete($id)
    {
        $cobertura = Cobertura::find($id);

        $delete = $cobertura->delete();
        if ($delete){
            return redirect()->route('indexCobertura')->with("message", "$cobertura->descricao excluído.");
        } else {
            return redirect()->route('indexCobertura')->with("error", "Falha ao deletar");
        }
    }
}
