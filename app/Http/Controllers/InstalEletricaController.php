<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParametrosFiscalizacaoFormRequest;
use App\Models\InstalEletrica;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class InstalEletricaController extends Controller
{
    private $qtdShow = 10;

    public function __construct()
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
    }

    public function index()
    {
        $title = 'Listagem de Instalação Elétrica';
        $instalacoes = InstalEletrica::orderBy('descricao')->paginate($this->qtdShow);

        return view('parametrosFiscalizacao.instalEletrica.index', compact('instalacoes', 'title'));
    }

    public function create()
    {
        $title = "Cadastrar Instalação Elétrica";

        return view("parametrosFiscalizacao.instalEletrica.create", compact('title'));
    }

    public function edit($id)
    {
        $instalacao = InstalEletrica::find($id);

        $title = "Editar Instalação Elétrica: {$instalacao->descricao}";

        return view('parametrosFiscalizacao.instalEletrica.create', compact('title', 'instalacao'));
    }

    public function store(ParametrosFiscalizacaoFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = InstalEletrica::create($dataForm);
        if ($insert) {
            return redirect()->route('indexInstalEletrica');
        } else {
            return redirect()->back();
        }
    }

    public function update(ParametrosFiscalizacaoFormRequest $request, $id)
    {
        $dataForm = $request->all();
        $instalacao = InstalEletrica::find($id);

        $update = $instalacao->update($dataForm);

        if ($update) {
            return redirect()->route('indexInstalEletrica');
        } else {
            return redirect()->route('editInstalEletrica', $id)->with(['errors' => 'Falha ao editar']);
        }
    }

    public function delete($id)
    {
        $instalacao = InstalEletrica::find($id);

        $delete = $instalacao->delete();
        if ($delete){
            return redirect()->route('indexInstalEletrica')->with("message", "$instalacao->descricao excluído.");
        } else {
            return redirect()->route('indexInstalEletrica')->with("error", "Falha ao deletar");
        }
    }
}
