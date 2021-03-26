<?php

namespace App\Http\Controllers;


use App\Http\Requests\assuntoFormRequest;
use App\Models\assunto;
use App\Models\tipoAssunto;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class AssuntoController extends Controller
{
    private $assunto;
    private $tiposAssuntos;
    private $qtdShow = 10;

    public function __construct(assunto $assunto, tipoAssunto $tipoAssunto)
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
        $this->assunto = $assunto;
        $this->tiposAssuntos = $tipoAssunto;
    }

    public function index()
    {
        $title = 'Listagem de Assuntos';
        $assuntos = $this->assunto->orderBy('nome')->paginate($this->qtdShow);
        $tipoAssuntos = $this->tiposAssuntos->all();

        return view('assunto.index', compact('assuntos', 'title', 'tipoAssuntos'));
    }

    public function create()
    {
        $title = "Cadastrar Assunto";
        $tiposAssuntos = $this->tiposAssuntos->all();

        return view("assunto.create", compact('title', 'tiposAssuntos'));
    }

    public function edit($idAssunto)
    {
        $assunto = $this->assunto->find($idAssunto);
        $tiposAssuntos = $this->tiposAssuntos->all();

        $title = "Editar Assunto: {$assunto->nome}";

        return view('assunto.create', compact('title', 'assunto', 'tiposAssuntos'));
    }

    public function store(assuntoFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = $this->assunto->create($dataForm);
        if ($insert) {
            return redirect()->route('indexAssunto');
        } else {
            return redirect()->back();
        }
    }

    public function update(assuntoFormRequest $request, $idAssunto)
    {
        $dataForm = $request->all();
        $assunto = $this->assunto->find($idAssunto);

        $update = $assunto->update($dataForm);

        if ($update) {
            return redirect()->route('indexAssunto');
        } else {
            return redirect()->route('editAssunto', $idAssunto)->with(['errors' => 'Falha ao editar']);
        }
    }
}
