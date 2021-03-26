<?php

namespace App\Http\Controllers;

use App\Http\Requests\padraoFormRequest;
use App\Models\padrao;
use App\Models\tipoPadroes;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class PadraoController extends Controller
{
    private $padrao;
    private $qtdShow = 10;
    private $tipoPadrao;

    public function __construct(padrao $padrao, tipoPadroes $tipoPadroes)
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
        $this->padrao = $padrao;
        $this->tipoPadrao = $tipoPadroes;
    }

    public function index()
    {
        $title = 'Padrões';
        $padroes = $this->padrao->orderBy('nome')->paginate($this->qtdShow);

        return view('padrao.index', compact('padroes', 'title'));
    }

    public function create()
    {
        $title = "Cadastrar Padrão";
        $tiposPadrao = $this->tipoPadrao->orderBy('nome')->get();

        return view("padrao.create", compact('title', 'tiposPadrao'));
    }

    public function edit($idPadrao)
    {
        $padrao = $this->padrao->find($idPadrao);
        $tiposPadrao = $this->tipoPadrao->orderBy('nome')->get();

        $title = "Editar Padrão: {$padrao->nome}";

        return view('padrao.create', compact('title', 'padrao', 'tiposPadrao'));
    }

    public function store(padraoFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = $this->padrao->create($dataForm);
        if ($insert) {
            return redirect()->route('indexPadrao');
        } else {
            return redirect()->back();
        }
    }

    public function update(padraoFormRequest $request, $idPadrao)
    {
        $dataForm = $request->all();
        $padrao = $this->padrao->find($idPadrao);

        $update = $padrao->update($dataForm);

        if ($update) {
            return redirect()->route('indexPadrao');
        } else {
            return redirect()->route('editPadrao', $idPadrao)->with(['errors' => 'Falha ao editar']);
        }
    }
}