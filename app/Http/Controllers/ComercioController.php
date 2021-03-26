<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParametrosFiscalizacaoFormRequest;
use App\Models\Comercio;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class ComercioController extends Controller
{
    private $qtdShow = 10;

    public function __construct()
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
    }

    public function index()
    {
        $title = 'Listagem de Comércio';
        $comercios = Comercio::orderBy('descricao')->paginate($this->qtdShow);

        return view('parametrosFiscalizacao.comercio.index', compact('comercios', 'title'));
    }

    public function create()
    {
        $title = "Cadastrar Comércio";

        return view("parametrosFiscalizacao.comercio.create", compact('title'));
    }

    public function edit($id)
    {
        $comercio = Comercio::find($id);

        $title = "Editar Forro: {$comercio->descricao}";

        return view('parametrosFiscalizacao.comercio.create', compact('title', 'comercio'));
    }

    public function store(ParametrosFiscalizacaoFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = Comercio::create($dataForm);
        if ($insert) {
            return redirect()->route('indexComercio');
        } else {
            return redirect()->back();
        }
    }

    public function update(ParametrosFiscalizacaoFormRequest $request, $id)
    {
        $dataForm = $request->all();
        $comercio = Comercio::find($id);

        $update = $comercio->update($dataForm);

        if ($update) {
            return redirect()->route('indexComercio');
        } else {
            return redirect()->route('editComercio', $id)->with(['errors' => 'Falha ao editar']);
        }
    }

    public function delete($id)
    {
        $comercio = Comercio::find($id);

        $delete = $comercio->delete();
        if ($delete){
            return redirect()->route('indexComercio')->with("message", "$comercio->descricao excluído.");
        } else {
            return redirect()->route('indexComercio')->with("error", "Falha ao deletar");
        }
    }
}