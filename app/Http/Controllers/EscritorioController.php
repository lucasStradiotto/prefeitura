<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParametrosFiscalizacaoFormRequest;
use App\Models\Escritorio;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class EscritorioController extends Controller
{
    private $qtdShow = 10;

    public function __construct()
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
    }

    public function index()
    {
        $title = 'Listagem de Escritórios';
        $escritorios = Escritorio::orderBy('descricao')->paginate($this->qtdShow);

        return view('parametrosFiscalizacao.escritorio.index', compact('escritorios', 'title'));
    }

    public function create()
    {
        $title = "Cadastrar Escritórios";

        return view("parametrosFiscalizacao.escritorio.create", compact('title'));
    }

    public function edit($id)
    {
        $escritorio = Escritorio::find($id);

        $title = "Editar Escritório: {$escritorio->descricao}";

        return view('parametrosFiscalizacao.escritorio.create', compact('title', 'escritorio'));
    }

    public function store(ParametrosFiscalizacaoFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = Escritorio::create($dataForm);
        if ($insert) {
            return redirect()->route('indexEscritorio');
        } else {
            return redirect()->back();
        }
    }

    public function update(ParametrosFiscalizacaoFormRequest $request, $id)
    {
        $dataForm = $request->all();
        $escritorio = Escritorio::find($id);

        $update = $escritorio->update($dataForm);

        if ($update) {
            return redirect()->route('indexEscritorio');
        } else {
            return redirect()->route('editEscritorio', $id)->with(['errors' => 'Falha ao editar']);
        }
    }

    public function delete($id)
    {
        $escritorio = Escritorio::find($id);

        $delete = $escritorio->delete();
        if ($delete){
            return redirect()->route('indexEscritorio')->with("message", "$escritorio->descricao excluído.");
        } else {
            return redirect()->route('indexEscritorio')->with("error", "Falha ao deletar");
        }
    }
}