<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParametrosFiscalizacaoFormRequest;
use App\Models\UsoTerreno;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class UsoTerrenoController extends Controller
{
    private $qtdShow = 10;

    public function __construct()
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
    }

    public function index()
    {
        $title = 'Listagem de Uso Terreno';
        $usos = UsoTerreno::orderBy('descricao')->paginate($this->qtdShow);

        return view('parametrosFiscalizacao.usoTerreno.index', compact('usos', 'title'));
    }

    public function create()
    {
        $title = "Cadastrar Uso Terreno";

        return view("parametrosFiscalizacao.usoTerreno.create", compact('title'));
    }

    public function edit($id)
    {
        $uso = UsoTerreno::find($id);

        $title = "Editar Uso Terreno: {$uso->descricao}";

        return view('parametrosFiscalizacao.usoTerreno.create', compact('title', 'uso'));
    }

    public function store(ParametrosFiscalizacaoFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = UsoTerreno::create($dataForm);
        if ($insert) {
            return redirect()->route('indexUsoTerreno');
        } else {
            return redirect()->back();
        }
    }

    public function update(ParametrosFiscalizacaoFormRequest $request, $id)
    {
        $dataForm = $request->all();
        $uso = UsoTerreno::find($id);

        $update = $uso->update($dataForm);

        if ($update) {
            return redirect()->route('indexUsoTerreno');
        } else {
            return redirect()->route('editUsoTerreno', $id)->with(['errors' => 'Falha ao editar']);
        }
    }

    public function delete($id)
    {
        $uso = UsoTerreno::find($id);

        $delete = $uso->delete();
        if ($delete){
            return redirect()->route('indexUsoTerreno')->with("message", "$uso->descricao excluído.");
        } else {
            return redirect()->route('indexUsoTerreno')->with("error", "Falha ao deletar");
        }
    }
}
