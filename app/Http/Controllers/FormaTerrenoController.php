<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParametrosFiscalizacaoFormRequest;
use App\Models\FormaTerreno;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class FormaTerrenoController extends Controller
{
    private $qtdShow = 10;

    public function __construct()
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
    }

    public function index()
    {
        $title = 'Listagem de Forma Terreno';
        $formas = FormaTerreno::orderBy('descricao')->paginate($this->qtdShow);

        return view('parametrosFiscalizacao.formaTerreno.index', compact('formas', 'title'));
    }

    public function create()
    {
        $title = "Cadastrar Forma Terreno";

        return view("parametrosFiscalizacao.formaTerreno.create", compact('title'));
    }

    public function edit($id)
    {
        $forma = FormaTerreno::find($id);

        $title = "Editar Forma Terreno: {$forma->descricao}";

        return view('parametrosFiscalizacao.formaTerreno.create', compact('title', 'forma'));
    }

    public function store(ParametrosFiscalizacaoFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = FormaTerreno::create($dataForm);
        if ($insert) {
            return redirect()->route('indexFormaTerreno');
        } else {
            return redirect()->back();
        }
    }

    public function update(ParametrosFiscalizacaoFormRequest $request, $id)
    {
        $dataForm = $request->all();
        $forma = FormaTerreno::find($id);

        $update = $forma->update($dataForm);

        if ($update) {
            return redirect()->route('indexFormaTerreno');
        } else {
            return redirect()->route('editFormaTerreno', $id)->with(['errors' => 'Falha ao editar']);
        }
    }

    public function delete($id)
    {
        $forma = FormaTerreno::find($id);

        $delete = $forma->delete();
        if ($delete){
            return redirect()->route('indexFormaTerreno')->with("message", "$forma->descricao excluído.");
        } else {
            return redirect()->route('indexFormaTerreno')->with("error", "Falha ao deletar");
        }
    }
}