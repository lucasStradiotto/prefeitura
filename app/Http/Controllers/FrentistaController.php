<?php

namespace App\Http\Controllers;

use App\Http\Requests\frentistaFormRequest;
use App\Models\Frentista;
use App\Models\logResetSenhaFrentista;
use App\Models\postosDeGasolina;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;

class FrentistaController extends Controller
{

    public function __construct(Frentista $frentista, postosDeGasolina $posto, logResetSenhaFrentista $logResetSenhaFrentista)
    {
        Session::put('url.intent', URL::current());
        $this->middleware('auth');
        $this->frentista = $frentista;
        $this->posto = $posto;
        $this->logResetSenhaFrentista = $logResetSenhaFrentista;
    }

    public function index()
    {
        $title = "Frentistas";
        $frentistas = $this->frentista->orderBy('nome')->paginate(10);
        $postos = $this->posto->all();
        return view('frentista.index', compact('title', 'frentistas', 'postos'));
    }

    public function create()
    {
        $title = "Frentistas";
        $postos = $this->posto->get();
        return view("frentista.create", compact('title', 'postos'));
    }

    public function edit($idFrentista)
    {
        $frentista = $this->frentista->find($idFrentista);

        $postos = $this->posto->get();

        $title = "Editar Frentista: {$frentista->nome}";

        return view('frentista.create', compact('title', 'frentista', 'postos'));
    }

    public function resetSenhaFrentista($idFrentista)
    {

        $datenow = Carbon::now();
        $frentista = $this->frentista->find($idFrentista);
        $dataFormLog = ['frentista_id'=> $idFrentista, 'user_id' => Auth::user()->id, 'data_alteracao' => $datenow];
        $dataForm = ['senha'=> NULL];
        $this->logResetSenhaFrentista->create($dataFormLog);

        $frentista->update($dataForm);

        return redirect()->route('indexFrentista')->with('msg', "Senha do frentista $frentista->nome resetada.");
    }

    public function store(frentistaFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = $this->frentista->create($dataForm);
        if ($insert) {
            return redirect()->route('indexFrentista');
        } else {
            return redirect()->back();
        }
    }

    public function update(frentistaFormRequest $request, $idFrentista)
    {
        $dataForm = $request->all();
        $anomalia = $this->frentista->find($idFrentista);

        $update = $anomalia->update($dataForm);

        if ($update) {
            return redirect()->route('indexFrentista');
        } else {
            return redirect()->route('editFrentista', $idFrentista)->with(['errors' => 'Falha ao editar']);
        }
    }
    
    public function search(Request $request)
    {
        if($request->has('search')){ 
            $frentistas = $this->frentista->where('nome','like','%'.$request->get('search').'%')->orderBy('nome')->paginate(10);
            if(!$frentistas){
                return redirect()->route('indexFrentista')->with('msg', "Nenhum Frentista cadastro com este nome.");
            }
            $title = "Frentistas";
            $postos = $this->posto->all();
            return view('frentista.index', compact('title', 'frentistas', 'postos'));
        }
        return redirect()->route('indexFrentista');
    }
}
