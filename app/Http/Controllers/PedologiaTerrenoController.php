<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParametrosFiscalizacaoFormRequest;
use App\Models\PedologiaTerreno;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class PedologiaTerrenoController extends Controller
{
    private $qtdShow = 10;

    public function __construct()
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
    }

    public function index()
    {
        $title = 'Listagem de Pedologia Terreno';
        $pedologias = PedologiaTerreno::orderBy('descricao')->paginate($this->qtdShow);

        return view('parametrosFiscalizacao.pedologiaTerreno.index', compact('pedologias', 'title'));
    }

    public function create()
    {
        $title = "Cadastrar Pedologia Terreno";

        return view("parametrosFiscalizacao.pedologiaTerreno.create", compact('title'));
    }

    public function edit($id)
    {
        $pedologia = PedologiaTerreno::find($id);

        $title = "Editar Pedologia Terreno: {$pedologia->descricao}";

        return view('parametrosFiscalizacao.pedologiaTerreno.create', compact('title', 'pedologia'));
    }

    public function store(ParametrosFiscalizacaoFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = PedologiaTerreno::create($dataForm);
        if ($insert) {
            return redirect()->route('indexPedologiaTerreno');
        } else {
            return redirect()->back();
        }
    }

    public function update(ParametrosFiscalizacaoFormRequest $request, $id)
    {
        $dataForm = $request->all();
        $pedologia = PedologiaTerreno::find($id);

        $update = $pedologia->update($dataForm);

        if ($update) {
            return redirect()->route('indexPedologiaTerreno');
        } else {
            return redirect()->route('editPedologiaTerreno', $id)->with(['errors' => 'Falha ao editar']);
        }
    }

    public function delete($id)
    {
        $pedologia = PedologiaTerreno::find($id);

        $delete = $pedologia->delete();
        if ($delete){
            return redirect()->route('indexPedologiaTerreno')->with("message", "$pedologia->descricao excluído.");
        } else {
            return redirect()->route('indexPedologiaTerreno')->with("error", "Falha ao deletar");
        }
    }
}