<?php

namespace App\Http\Controllers;

use App\Http\Requests\tipoEntulhoFormRequest;
use App\Models\tipoEntulho;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class TipoEntulhoController extends Controller
{
    private $tipoEntulho;
    private $qtdShow = 10;

    public function __construct(tipoEntulho $tipoEntulho)
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
        $this->tipoEntulho = $tipoEntulho;
    }

    public function index()
    {
        $title = 'Tipos de Entulho';
        $tiposEntulho = $this->tipoEntulho->orderBy('nome')->paginate($this->qtdShow);

        return view('tipoEntulho.index', compact('tiposEntulho', 'title'));
    }

    public function create()
    {
        $title = "Cadastrar Tipo de Entulho";

        return view("tipoEntulho.create", compact('title'));
    }

    public function edit($idTipoEntulho)
    {
        $tipoEntulho = $this->tipoEntulho->find($idTipoEntulho);

        $title = "Editar Tipo de Entulho: {$tipoEntulho->nome}";

        return view('tipoEntulho.create', compact('title', 'tipoEntulho'));
    }

    public function store(tipoEntulhoFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = $this->tipoEntulho->create($dataForm);
        if ($insert) {
            return redirect()->route('indexTipoEntulho');
        } else {
            return redirect()->back();
        }
    }

    public function update(tipoEntulhoFormRequest $request, $idTipoEntulho)
    {
        $dataForm = $request->all();
        $tipoEntulho = $this->tipoEntulho->find($idTipoEntulho);

        $update = $tipoEntulho->update($dataForm);

        if ($update) {
            return redirect()->route('indexTipoEntulho');
        } else {
            return redirect()->route('editTipoEntulho', $idTipoEntulho)->with(['errors' => 'Falha ao editar']);
        }
    }
}
