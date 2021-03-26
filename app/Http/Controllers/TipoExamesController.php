<?php

namespace App\Http\Controllers;

use App\Http\Requests\tipoExamesFormRequest;
use App\Models\tipoExames;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class TipoExamesController extends Controller
{
    private $tipoExame;
    private $qtdShow = 10;

    public function __construct(tipoExames $tipoExame)
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
        $this->tipoExame = $tipoExame;
    }

    public function index()
    {
        $title = 'Grupos de Exame';
        $tiposExame = $this->tipoExame->orderBy('nome')->paginate($this->qtdShow);

        return view('tipoExame.index', compact('tiposExame', 'title'));
    }

    public function create()
    {
        $title = "Cadastrar Grupo de Exame";

        return view("tipoExame.create", compact('title'));
    }

    public function edit($idTipoExame)
    {
        $tipoExame = $this->tipoExame->find($idTipoExame);

        $title = "Editar Grupo de Exame: {$tipoExame->nome}";

        return view('tipoExame.create', compact('title', 'tipoExame'));
    }

    public function store(tipoExamesFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = $this->tipoExame->create($dataForm);
        if ($insert) {
            return redirect()->route('indexTipoExame');
        } else {
            return redirect()->back();
        }
    }

    public function update(tipoExamesFormRequest $request, $idTipoExame)
    {
        $dataForm = $request->all();
        $tipoExame = $this->tipoExame->find($idTipoExame);

        $update = $tipoExame->update($dataForm);

        if ($update) {
            return redirect()->route('indexTipoExame');
        } else {
            return redirect()->route('editTipoExame', $idTipoExame)->with(['errors' => 'Falha ao editar']);
        }
    }
}