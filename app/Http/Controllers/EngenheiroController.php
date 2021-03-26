<?php

namespace App\Http\Controllers;

use App\Http\Requests\engenheiroFormRequest;
use App\Models\engenheiro;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class EngenheiroController extends Controller
{
    private $engenheiro;
    private $qtdShow = 10;

    public function __construct(engenheiro $engenheiro)
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
        $this->engenheiro = $engenheiro;
    }

    public function index()
    {
        $title = 'Listagem de Engenheiros';
        $engenheiros = $this->engenheiro->orderBy('nome')->paginate($this->qtdShow);

        return view('engenheiro.index', compact('engenheiros', 'title'));
    }

    public function create()
    {
        $title = "Cadastrar Engenheiro";

        return view("engenheiro.create", compact('title'));
    }

    public function edit($idEngenheiro)
    {
        $engenheiro = $this->engenheiro->find($idEngenheiro);

        $title = "Editar Engenheiro: {$engenheiro->nome}";

        return view('engenheiro.create', compact('title', 'engenheiro'));
    }

    public function store(engenheiroFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = $this->engenheiro->create($dataForm);
        if ($insert) {
            return redirect()->route('indexEngenheiro');
        } else {
            return redirect()->back();
        }
    }

    public function update(engenheiroFormRequest $request, $idEngenheiro)
    {
        $dataForm = $request->all();
        $engenheiro = $this->engenheiro->find($idEngenheiro);

        $update = $engenheiro->update($dataForm);

        if ($update) {
            return redirect()->route('indexEngenheiro');
        } else {
            return redirect()->route('editEngenheiro', $idEngenheiro)->with(['errors' => 'Falha ao editar']);
        }
    }
}
