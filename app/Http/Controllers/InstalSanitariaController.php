<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParametrosFiscalizacaoFormRequest;
use App\Models\InstalSanitaria;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class InstalSanitariaController extends Controller
{
    private $qtdShow = 10;

    public function __construct()
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
    }

    public function index()
    {
        $title = 'Listagem de Instalação Sanitária';
        $instalacoes = InstalSanitaria::orderBy('descricao')->paginate($this->qtdShow);

        return view('parametrosFiscalizacao.instalSanitaria.index', compact('instalacoes', 'title'));
    }

    public function create()
    {
        $title = "Cadastrar Instalação Sanitária";

        return view("parametrosFiscalizacao.instalSanitaria.create", compact('title'));
    }

    public function edit($id)
    {
        $instalacao = InstalSanitaria::find($id);

        $title = "Editar Instalação Sanitária: {$instalacao->descricao}";

        return view('parametrosFiscalizacao.instalSanitaria.create', compact('title', 'instalacao'));
    }

    public function store(ParametrosFiscalizacaoFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = InstalSanitaria::create($dataForm);
        if ($insert) {
            return redirect()->route('indexInstalSanitaria');
        } else {
            return redirect()->back();
        }
    }

    public function update(ParametrosFiscalizacaoFormRequest $request, $id)
    {
        $dataForm = $request->all();
        $instalacao = InstalSanitaria::find($id);

        $update = $instalacao->update($dataForm);

        if ($update) {
            return redirect()->route('indexInstalSanitaria');
        } else {
            return redirect()->route('editInstalSanitaria', $id)->with(['errors' => 'Falha ao editar']);
        }
    }

    public function delete($id)
    {
        $instalacao = InstalSanitaria::find($id);

        $delete = $instalacao->delete();
        if ($delete){
            return redirect()->route('indexInstalSanitaria')->with("message", "$instalacao->descricao excluído.");
        } else {
            return redirect()->route('indexInstalSanitaria')->with("error", "Falha ao deletar");
        }
    }
}
