<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParametrosFiscalizacaoFormRequest;
use App\Models\CasaRecuada;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class CasaRecuadaController extends Controller
{
    private $qtdShow = 10;

    public function __construct()
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
    }

    public function index()
    {
        $title = 'Listagem de Casa Recuada';
        $casas = CasaRecuada::orderBy('descricao')->paginate($this->qtdShow);

        return view('parametrosFiscalizacao.casaRecuada.index', compact('casas', 'title'));
    }

    public function create()
    {
        $title = "Cadastrar Casa Recuada";

        return view("parametrosFiscalizacao.casaRecuada.create", compact('title'));
    }

    public function edit($id)
    {
        $casa = CasaRecuada::find($id);

        $title = "Editar Casa Recuada: {$casa->descricao}";

        return view('parametrosFiscalizacao.casaRecuada.create', compact('title', 'casa'));
    }

    public function store(ParametrosFiscalizacaoFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = CasaRecuada::create($dataForm);
        if ($insert) {
            return redirect()->route('indexCasaRecuada');
        } else {
            return redirect()->back();
        }
    }

    public function update(ParametrosFiscalizacaoFormRequest $request, $id)
    {
        $dataForm = $request->all();
        $casa = CasaRecuada::find($id);

        $update = $casa->update($dataForm);

        if ($update) {
            return redirect()->route('indexCasaRecuada');
        } else {
            return redirect()->route('editCasaRecuada', $id)->with(['errors' => 'Falha ao editar']);
        }
    }

    public function delete($id)
    {
        $casa = CasaRecuada::find($id);

        $delete = $casa->delete();
        if ($delete){
            return redirect()->route('indexCasaRecuada')->with("message", "$casa->descricao excluído.");
        } else {
            return redirect()->route('indexCasaRecuada')->with("error", "Falha ao deletar");
        }
    }
}