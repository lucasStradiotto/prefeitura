<?php

namespace App\Http\Controllers;

use App\Http\Requests\horarioProgramadoFormRequest;
use App\Models\horarioProgramado;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class HorarioProgramadoController extends Controller
{
    private $horarioProgramado;
    private $qtdShow = 10;

    public function __construct(horarioProgramado $horarioProgramado)
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
        $this->horarioProgramado = $horarioProgramado;
    }

    public function index()
    {
        $title = 'Horários Programados';
        $horariosProgramados = $this->horarioProgramado->all();

        return view('horarioProgramado.index', compact('horariosProgramados', 'title'));
    }

    public function create()
    {
        $title = "Cadastrar Horário Programado";

        return view("horarioProgramado.create", compact('title'));
    }

    public function edit($idHorarioProgramado)
    {
        $horarioProgramado = $this->horarioProgramado->find($idHorarioProgramado);

        $title = "Editar Horário Programado: {$horarioProgramado->inicio} - {$horarioProgramado->fim}";

        return view('horarioProgramado.create', compact('title', 'horarioProgramado'));
    }

    public function store(horarioProgramadoFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = $this->horarioProgramado->create($dataForm);
        if ($insert) {
            return redirect()->route('indexHorarioProgramado');
        } else {
            return redirect()->back();
        }
    }

    public function update(horarioProgramadoFormRequest $request, $idHorarioProgramado)
    {
        $dataForm = $request->all();
        $horarioProgramado = $this->horarioProgramado->find($idHorarioProgramado);

        $update = $horarioProgramado->update($dataForm);

        if ($update) {
            return redirect()->route('indexHorarioProgramado');
        } else {
            return redirect()->route('editHorarioProgramado',
                $idHorarioProgramado)->with(['errors' => 'Falha ao editar']);
        }
    }

    public function delete($idHorarioProgramado){
        $horarioProgramado = $this->horarioProgramado->find($idHorarioProgramado);
        $inicio = $horarioProgramado->inicio;
        $fim = $horarioProgramado->fim;
        $delete = $horarioProgramado->delete();
        if($delete){
            return redirect()->route('indexHorarioProgramado')->with('message','Horário programado com início às '
            .$inicio.' e fim às '.$fim. ' removido com sucesso.');
        }else{
            return redirect()->back()->with('errors','Erro ao tentar excluir.');
        }
    }

    public function details($idHorarioProgramado){
        $horarioProgramado = $this->horarioProgramado->find($idHorarioProgramado);
        $title = "Visualizar Horário Programado: {$horarioProgramado->inicio} - {$horarioProgramado->fim}";
        return view('horarioProgramado.details',compact('title', 'horarioProgramado'));
    }
}
