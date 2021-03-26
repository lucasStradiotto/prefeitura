<?php

namespace App\Http\Controllers;

use App\Http\Requests\jornadaTrabalhoFormRequest;
use App\Models\jornadaTrabalho;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class JornadaTrabalhoController extends Controller
{
    private $jornadaTrabalho;
    private $qtdShow = 10;

    public function __construct(jornadaTrabalho $jornadaTrabalho)
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
        $this->jornadaTrabalho = $jornadaTrabalho;
    }

    public function index()
    {
        $title = 'Jornadas de Trabalho';
        $jornadasTrabalho = $this->jornadaTrabalho->all();

        return view('jornadaTrabalho.index', compact('jornadasTrabalho', 'title'));
    }

    public function create()
    {
        $title = "Cadastrar Jornada de Trabalho";

        return view("jornadaTrabalho.create", compact('title'));
    }

    public function edit($idJornadaTrabalho)
    {
        $jornadaTrabalho = $this->jornadaTrabalho->find($idJornadaTrabalho);

        $title = "Editar Jornada de Trabalho: {$jornadaTrabalho->inicio} - {$jornadaTrabalho->fim}";

        return view('jornadaTrabalho.create', compact('title', 'jornadaTrabalho'));
    }

    public function store(jornadaTrabalhoFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = $this->jornadaTrabalho->create($dataForm);
        if ($insert) {
            return redirect()->route('indexJornadaTrabalho');
        } else {
            return redirect()->back();
        }
    }

    public function update(jornadaTrabalhoFormRequest $request, $idJornadaTrabalho)
    {
        $dataForm = $request->all();
        $jornadaTrabalho = $this->jornadaTrabalho->find($idJornadaTrabalho);

        $update = $jornadaTrabalho->update($dataForm);

        if ($update) {
            return redirect()->route('indexJornadaTrabalho');
        } else {
            return redirect()->route('editJornadaTrabalho', $idJornadaTrabalho)->with(['errors' => 'Falha ao editar']);
        }
    }
}