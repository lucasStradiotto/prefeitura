<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParametrosFiscalizacaoFormRequest;
use App\Models\PinturaEsquadria;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class PinturaEsquadriaController extends Controller
{
    private $qtdShow = 10;

    public function __construct()
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
    }

    public function index()
    {
        $title = 'Listagem de Pintura Esquadria';
        $pinturas = PinturaEsquadria::orderBy('descricao')->paginate($this->qtdShow);

        return view('parametrosFiscalizacao.pinturaEsquadria.index', compact('pinturas', 'title'));
    }

    public function create()
    {
        $title = "Cadastrar Pintura Esquadria";

        return view("parametrosFiscalizacao.pinturaEsquadria.create", compact('title'));
    }

    public function edit($id)
    {
        $pintura = PinturaEsquadria::find($id);

        $title = "Editar Pintura Esquadria: {$pintura->descricao}";

        return view('parametrosFiscalizacao.pinturaEsquadria.create', compact('title', 'pintura'));
    }

    public function store(ParametrosFiscalizacaoFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = PinturaEsquadria::create($dataForm);
        if ($insert) {
            return redirect()->route('indexPinturaEsquadria');
        } else {
            return redirect()->back();
        }
    }

    public function update(ParametrosFiscalizacaoFormRequest $request, $id)
    {
        $dataForm = $request->all();
        $pintura = PinturaEsquadria::find($id);

        $update = $pintura->update($dataForm);

        if ($update) {
            return redirect()->route('indexPinturaEsquadria');
        } else {
            return redirect()->route('editPinturaEsquadria', $id)->with(['errors' => 'Falha ao editar']);
        }
    }

    public function delete($id)
    {
        $pintura = PinturaEsquadria::find($id);

        $delete = $pintura->delete();
        if ($delete){
            return redirect()->route('indexPinturaEsquadria')->with("message", "$pintura->descricao excluído.");
        } else {
            return redirect()->route('indexPinturaEsquadria')->with("error", "Falha ao deletar");
        }
    }
}
