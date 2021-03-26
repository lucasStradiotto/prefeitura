<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParametrosFiscalizacaoFormRequest;
use App\Models\Acabamento;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class AcabamentoController extends Controller
{
    private $qtdShow = 10;

    public function __construct()
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
    }

    public function index()
    {
        $title = 'Listagem de Acabamento';
        $acabamentos = Acabamento::orderBy('descricao')->paginate($this->qtdShow);

        return view('parametrosFiscalizacao.acabamento.index', compact('acabamentos', 'title'));
    }

    public function create()
    {
        $title = "Cadastrar Acabamentos";

        return view("parametrosFiscalizacao.acabamento.create", compact('title'));
    }

    public function edit($id)
    {
        $acabamento = Acabamento::find($id);

        $title = "Editar Acabamento: {$acabamento->descricao}";

        return view('parametrosFiscalizacao.acabamento.create', compact('title', 'acabamento'));
    }

    public function store(ParametrosFiscalizacaoFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = Acabamento::create($dataForm);
        if ($insert) {
            return redirect()->route('indexAcabamento');
        } else {
            return redirect()->back();
        }
    }

    public function update(ParametrosFiscalizacaoFormRequest $request, $id)
    {
        $dataForm = $request->all();
        $acabamento = Acabamento::find($id);

        $update = $acabamento->update($dataForm);

        if ($update) {
            return redirect()->route('indexAcabamento');
        } else {
            return redirect()->route('editAcabamento', $id)->with(['errors' => 'Falha ao editar']);
        }
    }

    public function delete($id)
    {
        $acabamento = Acabamento::find($id);

        $delete = $acabamento->delete();
        if ($delete){
            return redirect()->route('indexAcabamento')->with("message", "$acabamento->descricao excluído.");
        } else {
            return redirect()->route('indexAcabamento')->with("error", "Falha ao deletar");
        }
    }
}
