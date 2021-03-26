<?php

namespace App\Http\Controllers;

use App\Http\Requests\setorProtocoloFormRequest;
use App\Models\setorProtocolo;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class SetorProtocoloController extends Controller
{
    private $setorProtocolo;
    private $qtdShow = 10;

    public function __construct(setorProtocolo $setorProtocolo)
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
        $this->setorProtocolo = $setorProtocolo;
    }

    public function index()
    {

        $title = 'Listagem de Setores';
        $setores = $this->setorProtocolo->orderBy('nome')->paginate($this->qtdShow);

        return view('setorProtocolo.index', compact('setores', 'title'));
    }

    public function create()
    {
        $title = "Cadastrar Setores";

        return view("setorProtocolo.create", compact('title'));
    }

    public function edit($idSetor)
    {
        $setor = $this->setorProtocolo->find($idSetor);

        $title = "Editar Setor: {$setor->nome}";

        return view('setorProtocolo.create', compact('title', 'setor'));
    }

    public function store(setorProtocoloFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = $this->setorProtocolo->create($dataForm);
        if ($insert) {
            return redirect()->route('indexSetorProtocolo');
        } else {
            return redirect()->back();
        }
    }

    public function update(setorProtocoloFormRequest $request, $idSetor)
    {
        $dataForm = $request->all();
        $setor = $this->setorProtocolo->find($idSetor);

        $update = $setor->update($dataForm);

        if ($update) {
            return redirect()->route('indexSetorProtocolo');
        } else {
            return redirect()->route('editSetorProtocolo', $idSetor)->with(['errors' => 'Falha ao editar']);
        }
    }
}
