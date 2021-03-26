<?php

namespace App\Http\Controllers;

use App\Http\Requests\estagiarioFormRequest;
use App\Models\estagiario;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class EstagiarioController extends Controller
{
    private $estagiario;
    private $qtdShow = 10;

    public function __construct(estagiario $estagiario)
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
        $this->estagiario = $estagiario;
    }

    public function index()
    {
        $title = 'Listagem de Estagiários';
        $estagiarios = $this->estagiario->orderBy('nome')->paginate($this->qtdShow);

        return view('estagiario.index', compact('estagiarios', 'title'));
    }

    public function create()
    {
        $title = "Cadastrar Estagiario";

        return view("estagiario.create", compact('title'));
    }

    public function edit($idEstagiario)
    {
        $estagiario = $this->estagiario->find($idEstagiario);

        $title = "Editar Estagiário: {$estagiario->nome}";

        return view('estagiario.create', compact('title', 'estagiario'));
    }

    public function store(estagiarioFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = $this->estagiario->create($dataForm);
        if ($insert) {
            return redirect()->route('indexEstagiario');
        } else {
            return redirect()->back();
        }
    }

    public function update(estagiarioFormRequest $request, $idEstagiario)
    {
        $dataForm = $request->all();
        $estagiario = $this->estagiario->find($idEstagiario);

        $update = $estagiario->update($dataForm);

        if ($update) {
            return redirect()->route('indexEstagiario');
        } else {
            return redirect()->route('editEstagiario', $idEstagiario)->with(['errors' => 'Falha ao editar']);
        }
    }
}
