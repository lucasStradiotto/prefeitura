<?php

namespace App\Http\Controllers;

use App\Http\Requests\tipoPadroesFormRequest;
use App\Models\tipoPadroes;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class TipoPadroesController extends Controller
{
    private $tipoPadrao;
    private $qtdShow = 10;

    public function __construct(tipoPadroes $tipoPadrao)
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
        $this->tipoPadrao = $tipoPadrao;
    }

    public function index()
    {
        $title = 'Tipos de Padrão';
        $tiposPadrao = $this->tipoPadrao->orderBy('nome')->paginate($this->qtdShow);

        return view('tipoPadroes.index', compact('tiposPadrao', 'title'));
    }

    public function create()
    {
        $title = "Cadastrar Tipo de Padrão";

        return view("tipoPadroes.create", compact('title'));
    }

    public function edit($idTipoPadrao)
    {
        $tipoPadrao = $this->tipoPadrao->find($idTipoPadrao);

        $title = "Editar Tipo de Padrão: {$tipoPadrao->nome}";

        return view('tipoPadroes.create', compact('title', 'tipoPadrao'));
    }

    public function store(tipoPadroesFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = $this->tipoPadrao->create($dataForm);
        if ($insert) {
            return redirect()->route('indexTipoPadroes');
        } else {
            return redirect()->back();
        }
    }

    public function update(tipoPadroesFormRequest $request, $idTipoPadrao)
    {
        $dataForm = $request->all();
        $tipoPadrao = $this->tipoPadrao->find($idTipoPadrao);

        $update = $tipoPadrao->update($dataForm);

        if ($update) {
            return redirect()->route('indexTipoPadroes');
        } else {
            return redirect()->route('editTipoPadroes', $idTipoPadrao)->with(['errors' => 'Falha ao editar']);
        }
    }
}