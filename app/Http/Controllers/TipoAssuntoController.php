<?php

namespace App\Http\Controllers;

use App\Http\Requests\tipoAssuntoFormRequest;
use App\Models\tipoAssunto;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class TipoAssuntoController extends Controller
{
    private $tipoAssunto;
    private $qtdShow = 10;

    public function __construct(tipoAssunto $tipoAssunto)
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
        $this->tipoAssunto = $tipoAssunto;
    }

    public function index()
    {

        $title = 'Listagem de Grupos de Assuntos';
        $tipoAssuntos = $this->tipoAssunto->orderBy('grupo')->paginate($this->qtdShow);

        return view('tipoAssunto.index', compact('tipoAssuntos', 'title'));
    }

    public function create()
    {
        $title = "Cadastrar Grupo de Assunto";

        return view("tipoAssunto.create", compact('title'));
    }

    public function edit($idTipoAssunto)
    {
        $tipoAssunto = $this->tipoAssunto->find($idTipoAssunto);

        $title = "Editar Grupos de Assunto: {$tipoAssunto->grupo}";

        return view('tipoAssunto.create', compact('title', 'tipoAssunto'));
    }

    public function store(tipoAssuntoFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = $this->tipoAssunto->create($dataForm);
        if ($insert) {
            return redirect()->route('indexTipoAssunto');
        } else {
            return redirect()->back();
        }
    }

    public function update(tipoAssuntoFormRequest $request, $idTipoAssunto)
    {
        $dataForm = $request->all();
        $tipoAssunto = $this->tipoAssunto->find($idTipoAssunto);

        $update = $tipoAssunto->update($dataForm);

        if ($update) {
            return redirect()->route('indexTipoAssunto');
        } else {
            return redirect()->route('editTipoAssunto', $idTipoAssunto)->with(['errors' => 'Falha ao editar']);
        }
    }
}
