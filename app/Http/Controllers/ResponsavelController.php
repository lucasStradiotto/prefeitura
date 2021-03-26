<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResponsavelFormRequest;
use App\Models\responsavel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class ResponsavelController extends Controller
{
    private $responsavel;
    private $qtdShow = 10;

    public function __construct(responsavel $responsavel)
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
        $this->responsavel = $responsavel;
    }

    public function index()
    {

        $title = 'Listagem de Responsáveis';
        $responsaveis = $this->responsavel->orderBy('nome')->paginate($this->qtdShow);

        return view('responsavel.index', compact('responsaveis', 'title'));
    }

    public function create()
    {
        $title = "Cadastrar Responsável";

        return view("responsavel.create", compact('title'));
    }

    public function edit($idResponsavel)
    {
        $responsavel = $this->responsavel->find($idResponsavel);

        $title = "Editar Responsável: {$responsavel->nome}";

        return view('responsavel.create', compact('title', 'responsavel'));
    }

    public function store(ResponsavelFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = $this->responsavel->create($dataForm);
        if ($insert) {
            return redirect()->route('indexResponsavel');
        } else {
            return redirect()->back();
        }
    }

    public function update(ResponsavelFormRequest $request, $idResponsavel)
    {
        $dataForm = $request->all();
        $responsavel = $this->responsavel->find($idResponsavel);

        $update = $responsavel->update($dataForm);

        if ($update) {
            return redirect()->route('indexResponsavel');
        } else {
            return redirect()->route('editResponsavel', $idResponsavel)->with(['errors' => 'Falha ao editar']);
        }
    }
}
