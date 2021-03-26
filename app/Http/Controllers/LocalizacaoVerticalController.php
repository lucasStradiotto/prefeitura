<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParametrosFiscalizacaoFormRequest;
use App\Models\LocalizacaoVertical;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class LocalizacaoVerticalController extends Controller
{
    private $qtdShow = 10;

    public function __construct()
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
    }

    public function index()
    {
        $title = 'Listagem de Localização Vertical';
        $localizacoes = LocalizacaoVertical::orderBy('descricao')->paginate($this->qtdShow);

        return view('parametrosFiscalizacao.localizacaoVertical.index', compact('localizacoes', 'title'));
    }

    public function create()
    {
        $title = "Cadastrar Localização Vertical";

        return view("parametrosFiscalizacao.localizacaoVertical.create", compact('title'));
    }

    public function edit($id)
    {
        $localizacao = LocalizacaoVertical::find($id);

        $title = "Editar Localização Vertical: {$localizacao->descricao}";

        return view('parametrosFiscalizacao.localizacaoVertical.create', compact('title', 'localizacao'));
    }

    public function store(ParametrosFiscalizacaoFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = LocalizacaoVertical::create($dataForm);
        if ($insert) {
            return redirect()->route('indexLocalizacaoVertical');
        } else {
            return redirect()->back();
        }
    }

    public function update(ParametrosFiscalizacaoFormRequest $request, $id)
    {
        $dataForm = $request->all();
        $localizacao = LocalizacaoVertical::find($id);

        $update = $localizacao->update($dataForm);

        if ($update) {
            return redirect()->route('indexLocalizacaoVertical');
        } else {
            return redirect()->route('editLocalizacaoVertical', $id)->with(['errors' => 'Falha ao editar']);
        }
    }

    public function delete($id)
    {
        $localizacao = LocalizacaoVertical::find($id);

        $delete = $localizacao->delete();
        if ($delete){
            return redirect()->route('indexLocalizacaoVertical')->with("message", "$localizacao->descricao excluído.");
        } else {
            return redirect()->route('indexLocalizacaoVertical')->with("error", "Falha ao deletar");
        }
    }
}