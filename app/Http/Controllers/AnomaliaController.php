<?php

namespace App\Http\Controllers;

use App\Http\Requests\anomaliaFormRequest;
use App\Models\Anomalia;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class AnomaliaController extends Controller
{
    private $anomalia;
    private $qtdShow = 10;

    public function __construct(Anomalia $anomalia)
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
        $this->anomalia = $anomalia;
    }

    public function index()
    {
        $title = 'Listagem de Anomalias';
        $anomalias = $this->anomalia->orderBy('nome')->paginate($this->qtdShow);

        return view('anomalia.index', compact('anomalias', 'title'));
    }

    public function create()
    {
        $title = "Cadastrar Anomalia";

        return view("anomalia.create", compact('title'));
    }

    public function edit($idAnomalia)
    {
        $anomalia= $this->anomalia->find($idAnomalia);

        $title = "Editar Anomalia: {$anomalia->nome}";

        return view('anomalia.create', compact('title', 'anomalia'));
    }

    public function store(anomaliaFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = $this->anomalia->create($dataForm);
        if ($insert) {
            return redirect()->route('indexAnomalia');
        } else {
            return redirect()->back();
        }
    }

    public function update(anomaliaFormRequest $request, $idAnomalia)
    {
        $dataForm = $request->all();
        $anomalia = $this->anomalia->find($idAnomalia);

        $update = $anomalia->update($dataForm);

        if ($update) {
            return redirect()->route('indexAnomalia');
        } else {
            return redirect()->route('editAnomalia', $idAnomalia)->with(['errors' => 'Falha ao editar']);
        }
    }
}