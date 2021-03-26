<?php

namespace App\Http\Controllers;


use App\Http\Requests\statusSolicitacaoFormRequest;
use App\Models\StatusSolicitacao;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class StatusSolicitacaoController extends Controller
{
    private $statusSolicitacao;
    private $qtdShow = 10;

    public function __construct(StatusSolicitacao $statusSolicitacao)
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
        $this->statusSolicitacao = $statusSolicitacao;
    }

    public function index()
    {
        $title = 'Listagem de Status';
        $status = $this->statusSolicitacao->orderBy('nome')->paginate($this->qtdShow);

        return view('statusSolicitacao.index', compact('status', 'title'));
    }

    public function create()
    {
        $title = "Cadastrar Status";

        return view("statusSolicitacao.create", compact('title'));
    }

    public function edit($idStatus)
    {
        $status = $this->statusSolicitacao->find($idStatus);

        $title = "Editar Status: {$status->nome}";

        return view('statusSolicitacao.create', compact('title', 'status'));
    }

    public function store(statusSolicitacaoFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = $this->statusSolicitacao->create($dataForm);
        if ($insert) {
            return redirect()->route('indexStatusSolicitacao');
        } else {
            return redirect()->back();
        }
    }

    public function update(statusSolicitacaoFormRequest $request, $idStatus)
    {
        $dataForm = $request->all();
        $status = $this->statusSolicitacao->find($idStatus);

        $update = $status->update($dataForm);

        if ($update) {
            return redirect()->route('indexStatusSolicitacao');
        } else {
            return redirect()->route('editStatusSolicitacao', $idStatus)->with(['errors' => 'Falha ao editar']);
        }
    }
}