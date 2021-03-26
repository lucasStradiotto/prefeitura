<?php

namespace App\Http\Controllers;

use App\Http\Requests\secretariaFormRequest;
use App\Models\horarioProgramado;
use App\Models\secretaria;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class SecretariaController extends Controller
{

    private $secretaria;
    private $qtdShow = 10;
    private $horarioProgramado;

    public function __construct(secretaria $secretaria, horarioProgramado $horarioProgramado)
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
        $this->secretaria = $secretaria;
        $this->horarioProgramado = $horarioProgramado;
    }

    public function index()
    {
        $title = 'Secretarias';
        $secretarias = $this->secretaria->orderBy('nome')->paginate($this->qtdShow);
        $horariosProgramados = $this->horarioProgramado->all();

        return view('secretaria.index', compact('secretarias', 'title', 'horariosProgramados'));
    }

    public function create()
    {
        $title = "Cadastrar Secretaria";
        $horariosProgramados = $this->horarioProgramado->all();
        // $secretariasPai = $this->secretaria->whereNull('parent_id')->orWhere('parent_id', '=', 0)->select('id', 'nome')->get();

        return view("secretaria.create", compact('title', 'horariosProgramados'));
    }

    public function edit($idSecretaria)
    {
        $secretaria = $this->secretaria->find($idSecretaria);
        $horariosProgramados = $this->horarioProgramado->all();
        // $secretariasPai = $this->secretaria->whereNull('parent_id')->orWhere('parent_id', '=', 0)->select('id', 'nome')->get();

        $title = "Editar Secretaria: {$secretaria->nome}";

        return view('secretaria.create', compact('title', 'secretaria', 'horariosProgramados'));
    }

    public function store(secretariaFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = $this->secretaria->create($dataForm);
        if ($insert) {
            return redirect()->route('indexSecretaria');
        } else {
            return redirect()->back();
        }
    }

    public function update(secretariaFormRequest $request, $idSecretaria)
    {
        $dataForm = $request->all();
        $secretaria = $this->secretaria->find($idSecretaria);

        $update = $secretaria->update($dataForm);

        if ($update) {
            return redirect()->route('indexSecretaria');
        } else {
            return redirect()->route('editSecretaria', $idSecretaria)->with(['errors' => 'Falha ao editar']);
        }
    }

    public function delete($idSecretaria){
        $secretaria = $this->secretaria->find($idSecretaria);
        $nome = $secretaria->nome;
        $delete = $secretaria->delete();
        if($delete){
            return redirect()->route('indexSecretaria')->with('message', 'Secretaria '.$nome.' removida com sucesso.');
        }else{
            return redirect()->back()->with('errors','Erro ao tentar excluir.');
        }
    }

    public function details($idSecretaria){
        $secretaria = $this->secretaria->find($idSecretaria);
        $horarioProgramado = $this->horarioProgramado->find($secretaria->horario_programado_id);
        $title = "Visualizar Secretaria: {$secretaria->nome}";
        return view('secretaria.details',compact('secretaria','horarioProgramado','title'));
    }
}