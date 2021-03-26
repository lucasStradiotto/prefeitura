<?php

namespace App\Http\Controllers;

use App\Http\Requests\tipoPreventivaFormRequest;
use App\Models\tipoPreventiva;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class TipoPreventivaController extends Controller
{
    private $tipoPreventiva;
    private $qtdShow = 10;

    public function __construct(tipoPreventiva $tipoPreventiva)
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
        $this->tipoPreventiva = $tipoPreventiva;
    }

    public function index()
    {
        $title = 'Preventivas';
        $tiposPreventiva = $this->tipoPreventiva->orderBy('nome')->paginate($this->qtdShow);

        return view('tipoPreventiva.index', compact('tiposPreventiva', 'title'));
    }

    public function create()
    {
        $title = "Cadastrar Preventiva";

        return view("tipoPreventiva.create", compact('title'));
    }

    public function edit($idTipoPreventiva)
    {
        $tipoPreventiva = $this->tipoPreventiva->find($idTipoPreventiva);

        $title = "Editar Preventiva: {$tipoPreventiva->nome}";

        return view('tipoPreventiva.create', compact('title', 'tipoPreventiva'));
    }

    public function store(tipoPreventivaFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = $this->tipoPreventiva->create($dataForm);
        if ($insert) {
            return redirect()->route('indexTipoPreventiva');
        } else {
            return redirect()->back();
        }
    }

    public function update(tipoPreventivaFormRequest $request, $idTipoPreventiva)
    {
        $dataForm = $request->all();
        $tipoPreventiva = $this->tipoPreventiva->find($idTipoPreventiva);

        $update = $tipoPreventiva->update($dataForm);

        if ($update) {
            return redirect()->route('indexTipoPreventiva');
        } else {
            return redirect()->route('editTipoPreventiva', $idTipoPreventiva)->with(['errors' => 'Falha ao editar']);
        }
    }
}