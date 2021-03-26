<?php

namespace App\Http\Controllers;

use App\Models\exame;
use App\Models\veiculo;
use App\Models\veiculosExames;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class VeiculosExamesController extends Controller
{
    private $veiculo;
    private $exame;
    private $veiculoExame;

    public function __construct(veiculo $veiculo, exame $exame, veiculosExames $veiculoExame)
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
        $this->veiculo = $veiculo;
        $this->exame = $exame;
        $this->veiculoExame = $veiculoExame;
    }

    public function index()
    {
        $userempresa = \Illuminate\Support\Facades\Auth::user()->empresa_id;
        $veiculos = Veiculo::where('empresa_id', '=', $userempresa)->get();
        $title = 'Exames Relacionados aos Veiculos';
        $exames = $this->exame->all();

        return view('veiculosExames.index', compact('veiculos', 'title', 'exames', 'veiculos'));
    }

    public function create()
    {
        $title = "Atribuir Exames a Veículos";

        $exames = $this->exame->orderBy('nome')->get();
        $userempresa = \Illuminate\Support\Facades\Auth::user()->empresa_id;
        $veiculos = Veiculo::where('empresa_id', '=', $userempresa)->get();

        return view("veiculosExames.create", compact('title', 'exames', 'veiculos'));
    }

    public function store(Request $request)
    {
        $dataForm = $request->all();
        $i = 0;
        foreach ($dataForm as $id) {
            if ($i > 1) {
                //aqui dentro eu tenho todos os ids dos exames que vieram da view dentro da variável $id
                $exameRepetido = $this->veiculoExame
                    ->where('exame_id', '=', $id)
                    ->where('veiculo_id', '=', $dataForm["veiculo_id"])
                    ->get();
                if (count($exameRepetido) > 0) {
                    $novoExameRepetido = $this->exame->find($exameRepetido[0]->exame_id);
                    $erros = ['erro' => "Exame: " . $novoExameRepetido->nome . " já está atribuido a este veículo."];
                    $insert = false;
                } else {
                    $veiculoExame = new veiculosExames();
                    if ($dataForm["veiculo_id"] != null) {
                        $veiculoExame->veiculo_id = $dataForm["veiculo_id"];
                        $veiculoExame->exame_id = $id;

                        $insert = $veiculoExame->save();
                    } else {
                        $erros = ['erro' => "Deve selecionar um veículo."];
                        $insert = false;
                    }
                }
            }
            $i++;
        }
        if ($insert) {
            return redirect()->route('indexVeiculosExames');
        } else {
            return redirect()->back()->withErrors(['erro' => $erros]);
        }
    }

    public function easyDelete(Request $request)
    {
        $dataForm = $request->all();
        foreach ($dataForm as $id) {
            $veiculoExame = $this->veiculoExame->find($id);
            $delete = $veiculoExame->delete();
        }
        if ($delete) {
            return redirect()->route('indexVeiculosExames');
        } else {
            $erros = ['erro' => 'Erro ao deletar!'];
            return redirect()->back()->withErrors(['erro' => $erros]);
        }
    }

    public function getExamesDoVeiculo()
    {
        return json_encode(
            DB::select(
                DB::raw(
                    "SELECT `nome` as nome, `veiculos_exames`.`id` as veiculo_exame_id 
                        FROM `veiculos_exames`
                        INNER JOIN `exames`
                        ON `exames`.`id` = `veiculos_exames`.`exame_id` 
                        WHERE `veiculos_exames`.`veiculo_id` = ?
                        ORDER BY `nome`"
                ),
                array(
                    request()->get('veiculo_id')
                )
            )
        );
    }
}
