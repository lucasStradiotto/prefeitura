<?php

namespace App\Http\Controllers;

use App\Http\Requests\unidadeIntervaloFormRequest;
use App\Models\unidadeIntervalo;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class UnidadeIntervaloController extends Controller
{
    private $unidadeIntervalo;
    private $qtdShow = 10;

    public function __construct(unidadeIntervalo $unidadeIntervalo)
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
        $this->unidadeIntervalo = $unidadeIntervalo;
    }

    public function index()
    {

        $title = 'Listagem de Unidades de Intervalo';
        $unidadesIntervalo = $this->unidadeIntervalo->orderBy('nome')->paginate($this->qtdShow);

        return view('unidadeIntervalo.index', compact('unidadesIntervalo', 'title'));
    }

    public function create()
    {
        $title = "Cadastrar Unidade de Intervalo";

        return view("unidadeIntervalo.create", compact('title'));
    }

    public function edit($idUnidadeIntervalo)
    {
        $unidadeIntervalo = $this->unidadeIntervalo->find($idUnidadeIntervalo);

        $title = "Editar Unidade de Intervalo: {$unidadeIntervalo->nome}";

        return view('unidadeIntervalo.create', compact('title', 'unidadeIntervalo'));
    }

    public function store(unidadeIntervaloFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = $this->unidadeIntervalo->create($dataForm);
        if ($insert) {
            return redirect()->route('indexUnidadeIntervalo');
        } else {
            return redirect()->back();
        }
    }

    public function update(unidadeIntervaloFormRequest $request, $idUnidadeIntervalo)
    {
        $dataForm = $request->all();
        $unidadeIntervalo = $this->unidadeIntervalo->find($idUnidadeIntervalo);

        $update = $unidadeIntervalo->update($dataForm);

        if ($update) {
            return redirect()->route('indexUnidadeIntervalo');
        } else {
            return redirect()->route('editUnidadeIntervalo',
                $idUnidadeIntervalo)->with(['errors' => 'Falha ao editar']);
        }
    }
}
