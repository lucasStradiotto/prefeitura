<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParametrosFiscalizacaoFormRequest;
use App\Models\Forro;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class ForroController extends Controller
{
    private $qtdShow = 10;

    public function __construct()
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
    }

    public function index()
    {
        $title = 'Listagem de Forros';
        $forros = Forro::orderBy('descricao')->paginate($this->qtdShow);

        return view('parametrosFiscalizacao.forro.index', compact('forros', 'title'));
    }

    public function create()
    {
        $title = "Cadastrar Forro";

        return view("parametrosFiscalizacao.forro.create", compact('title'));
    }

    public function edit($id)
    {
        $forro = Forro::find($id);

        $title = "Editar Forro: {$forro->descricao}";

        return view('parametrosFiscalizacao.forro.create', compact('title', 'forro'));
    }

    public function store(ParametrosFiscalizacaoFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = Forro::create($dataForm);
        if ($insert) {
            return redirect()->route('indexForro');
        } else {
            return redirect()->back();
        }
    }

    public function update(ParametrosFiscalizacaoFormRequest $request, $id)
    {
        $dataForm = $request->all();
        $forro = Forro::find($id);

        $update = $forro->update($dataForm);

        if ($update) {
            return redirect()->route('indexForro');
        } else {
            return redirect()->route('editForro', $id)->with(['errors' => 'Falha ao editar']);
        }
    }

    public function delete($id)
    {
        $forro = Forro::find($id);

        $delete = $forro->delete();
        if ($delete){
            return redirect()->route('indexForro')->with("message", "$forro->descricao excluído.");
        } else {
            return redirect()->route('indexForro')->with("error", "Falha ao deletar");
        }
    }
}
