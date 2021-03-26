<?php

namespace App\Http\Controllers;

use App\Http\Requests\possivelObservacaoFormRequest;
use App\Models\PossivelObservacao;
use App\Models\secretaria;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class PossivelObservacaoController extends Controller
{
    private $qtdShow = 10;

    public function __construct()
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
    }

    public function index()
    {
        $title = 'Listagem de Observações';
        $observacoes = PossivelObservacao::orderBy('nome_observacao')
            ->paginate($this->qtdShow);

        return view('possivelObservacao.index', compact('observacoes', 'title'));
    }

    public function create()
    {
        $title = "Cadastrar Observação";
        $user_id = Auth::user()->id;
        $secretarias = secretaria::join('users_secretarias', 'users_secretarias.secretaria_id', '=', 'secretarias.id')
            ->where('users_secretarias.user_id', $user_id)
            ->select('secretarias.nome', 'secretarias.id')
            ->orderBy('secretarias.nome')
            ->get();

        return view("possivelObservacao.create", compact('title', 'secretarias'));
    }

    public function edit($id)
    {
        $observacao = PossivelObservacao::find($id);

        $title = "Editar Observação: {$observacao->nome_observacao}";

        return view('possivelObservacao.create', compact('title', 'observacao'));
    }

    public function store(possivelObservacaoFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = PossivelObservacao::create($dataForm);
        if ($insert) {
            return redirect()->route('indexPossivelObservacao');
        } else {
            return redirect()->back();
        }
    }

    public function update(possivelObservacaoFormRequest $request, $id)
    {
        $dataForm = $request->all();
        $observacao = PossivelObservacao::find($id);

        $update = $observacao->update($dataForm);

        if ($update) {
            return redirect()->route('indexPossivelObservacao');
        } else {
            return redirect()->route('editPossivelObservacao', $id)->with(['errors' => 'Falha ao editar']);
        }
    }
}