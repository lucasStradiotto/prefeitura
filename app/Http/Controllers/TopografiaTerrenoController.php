<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParametrosFiscalizacaoFormRequest;
use App\Models\TopografiaTerreno;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class TopografiaTerrenoController extends Controller
{
    private $qtdShow = 10;

    public function __construct()
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
    }

    public function index()
    {
        $title = 'Listagem de Topografia Terreno';
        $topografias = TopografiaTerreno::orderBy('descricao')->paginate($this->qtdShow);

        return view('parametrosFiscalizacao.topografiaTerreno.index', compact('topografias', 'title'));
    }

    public function create()
    {
        $title = "Cadastrar Topografia Terreno";

        return view("parametrosFiscalizacao.topografiaTerreno.create", compact('title'));
    }

    public function edit($id)
    {
        $topografia = TopografiaTerreno::find($id);

        $title = "Editar Topografia Terreno: {$topografia->descricao}";

        return view('parametrosFiscalizacao.topografiaTerreno.create', compact('title', 'topografia'));
    }

    public function store(ParametrosFiscalizacaoFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = TopografiaTerreno::create($dataForm);
        if ($insert) {
            return redirect()->route('indexTopografiaTerreno');
        } else {
            return redirect()->back();
        }
    }

    public function update(ParametrosFiscalizacaoFormRequest $request, $id)
    {
        $dataForm = $request->all();
        $topografia = TopografiaTerreno::find($id);

        $update = $topografia->update($dataForm);

        if ($update) {
            return redirect()->route('indexTopografiaTerreno');
        } else {
            return redirect()->route('editTopografiaTerreno', $id)->with(['errors' => 'Falha ao editar']);
        }
    }

    public function delete($id)
    {
        $topografia = TopografiaTerreno::find($id);

        $delete = $topografia->delete();
        if ($delete){
            return redirect()->route('indexTopografiaTerreno')->with("message", "$topografia->descricao excluído.");
        } else {
            return redirect()->route('indexTopografiaTerreno')->with("error", "Falha ao deletar");
        }
    }
}