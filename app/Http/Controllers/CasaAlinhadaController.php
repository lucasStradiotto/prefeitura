<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParametrosFiscalizacaoFormRequest;
use App\Models\CasaAlinhada;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class CasaAlinhadaController extends Controller
{
    private $qtdShow = 10;

    public function __construct()
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
    }

    public function index()
    {
        $title = 'Listagem de Casa Alinhada';
        $casas = CasaAlinhada::orderBy('descricao')->paginate($this->qtdShow);

        return view('parametrosFiscalizacao.casaAlinhada.index', compact('casas', 'title'));
    }

    public function create()
    {
        $title = "Cadastrar Casa Alinhada";

        return view("parametrosFiscalizacao.casaAlinhada.create", compact('title'));
    }

    public function edit($id)
    {
        $casa = CasaAlinhada::find($id);

        $title = "Editar Casa Alinhada: {$casa->descricao}";

        return view('parametrosFiscalizacao.casaAlinhada.create', compact('title', 'casa'));
    }

    public function store(ParametrosFiscalizacaoFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = CasaAlinhada::create($dataForm);
        if ($insert) {
            return redirect()->route('indexCasaAlinhada');
        } else {
            return redirect()->back();
        }
    }

    public function update(ParametrosFiscalizacaoFormRequest $request, $id)
    {
        $dataForm = $request->all();
        $casa = CasaAlinhada::find($id);

        $update = $casa->update($dataForm);

        if ($update) {
            return redirect()->route('indexCasaAlinhada');
        } else {
            return redirect()->route('editCasaAlinhada', $id)->with(['errors' => 'Falha ao editar']);
        }
    }

    public function delete($id)
    {
        $casa = CasaAlinhada::find($id);

        $delete = $casa->delete();
        if ($delete){
            return redirect()->route('indexCasaAlinhada')->with("message", "$casa->descricao excluído.");
        } else {
            return redirect()->route('indexCasaAlinhada')->with("error", "Falha ao deletar");
        }
    }
}