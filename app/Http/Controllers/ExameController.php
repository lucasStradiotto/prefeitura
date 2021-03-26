<?php

namespace App\Http\Controllers;

use App\Http\Requests\exameFormRequest;
use App\Models\exame;
use App\Models\padrao;
use App\Models\tipoExames;
use App\Models\tipoPadroes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class ExameController extends Controller
{
    private $exame;
    private $qtdShow = 10;
    private $tipoExame;
    private $tipoPadrao;

    public function __construct(exame $exame, tipoExames $tipoExames, tipoPadroes $tipoPadroes, padrao $padrao)
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
        $this->exame = $exame;
        $this->tipoExame = $tipoExames;
        $this->tipoPadrao = $tipoPadroes;
        $this->padrao = $padrao;
    }

    public function index()
    {

        $title = 'Listagem de Exames';
        $exames = $this->exame->orderBy('nome')->paginate($this->qtdShow);
        $tiposPadrao = $this->tipoPadrao->orderBy('nome')->get();
        $padroes = $this->padrao->orderBy('nome')->get();

        return view('exame.index', compact('exames', 'title', 'tiposPadrao', 'padroes'));
    }

    public function create()
    {
        $title = "Cadastrar Exame";
        $tiposExame = $this->tipoExame->orderBy('nome')->get();
        $tiposPadrao = $this->tipoPadrao->orderBy('nome')->get();

        return view("exame.create", compact('title', 'tiposExame', 'tiposPadrao'));
    }

    public function edit($idExame)
    {
        $exame = $this->exame->find($idExame);
        $tiposExame = $this->tipoExame->orderBy('nome')->get();
        $tiposPadrao = $this->tipoPadrao->orderBy('nome')->get();

        $title = "Editar Exame: {$exame->nome}";

        return view('exame.create', compact('title', 'exame', 'tiposExame', 'tiposPadrao'));
    }

    public function store(exameFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = $this->exame->create($dataForm);
        if ($insert) {
            return redirect()->route('indexExame');
        } else {
            return redirect()->back();
        }
    }

    public function update(exameFormRequest $request, $idExame)
    {
        $dataForm = $request->all();
        $exame = $this->exame->find($idExame);

        $update = $exame->update($dataForm);

        if ($update) {
            return redirect()->route('indexExame');
        } else {
            return redirect()->route('editExame', $idExame)->with(['errors' => 'Falha ao editar']);
        }
    }

    public function getPadroes()
    {
        return json_encode(
            DB::select(
                DB::raw(
                    "SELECT `id`, `nome` 
                        FROM `padroes` 
                        WHERE `tipo_padrao_id` = ?  
                        ORDER BY nome"
                ),
                array(
                    request()->get('tipo_padrao_id')
                )
            )
        );
    }
}
