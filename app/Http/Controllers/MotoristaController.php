<?php

namespace App\Http\Controllers;

use App\Http\Requests\CnhValidadeFormRequest;
use App\Http\Requests\motoristaFormRequest;
use App\Models\CnhValidade;
use App\Models\empresa;
use App\Models\jornadaTrabalho;
use App\Models\motorista;
use App\Models\secretaria;
use App\Models\logResetSenhaMotorista;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;

class MotoristaController extends Controller
{
    private $motorista;
    private $cnh_validade;
    private $empresa;
    private $qtdShow = 10;
    private $secretaria;
    private $jornadaTrabalho;
    private $logResetSenhaMotorista;

    public function __construct(
        motorista $motorista,
        empresa $empresa,
        secretaria $secretaria,
        CnhValidade $cnhValidade,
        jornadaTrabalho $jornadaTrabalho,
        logResetSenhaMotorista $logResetSenhaMotorista
    )
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
        $this->motorista = $motorista;
        $this->empresa = $empresa;
        $this->secretaria = $secretaria;
        $this->cnh_validade = $cnhValidade;
        $this->jornadaTrabalho = $jornadaTrabalho;
        $this->logResetSenhaMotorista = $logResetSenhaMotorista;
    }

    public function index(Request $request)
    {
        $title = 'Listagem de Motoristas';

        $filter = $request->get('filter');

        $motoristas = $this->motorista
            ->join('empresas', 'empresas.id', '=', 'motoristas.empresa_id')
            ->leftJoin('cnh_validade', 'cnh_validade.motorista_id', '=', 'motoristas.id')
            ->join('jornada_trabalhos', 'jornada_trabalhos.id', '=', 'motoristas.jornada_trabalho_id');
        if ($filter) {
            $motoristas = $motoristas->where('motoristas.nome', 'LIKE', "%$filter%");
        }

        $motoristas = $motoristas->select('motoristas.*',
            'empresas.nome_fantasia',
            'cnh_validade.validade',
            'jornada_trabalhos.inicio', 'jornada_trabalhos.fim')
            ->orderBy('nome')
            ->paginate($this->qtdShow);

        $pageAtual = $motoristas->currentPage();
        $cont = ($pageAtual - 1) * $this->qtdShow;
        foreach ($motoristas as $motorista) {
            $cont++;
            $motorista->cont = $cont;
        }

        return view('motorista.index', compact('motoristas', 'title'));
    }

    public function create()
    {
        $title = "Cadastrar Motorista";

        $empresas = $this->empresa->all();
        $secretarias = $this->secretaria->all();
        $jornadasTrabalho = $this->jornadaTrabalho->all();

        return view("motorista.create", compact('title', 'empresas', 'secretarias', 'jornadasTrabalho'));
    }

    public function edit($idMotorista)
    {
        $motorista = $this->motorista->find($idMotorista);
        $validade = $this->cnh_validade->where('motorista_id', '=', $idMotorista)->first();
        $empresas = $this->empresa->all();
        $secretarias = $this->secretaria->all();
        $jornadasTrabalho = $this->jornadaTrabalho->all();

        $title = "Editar Motorista: {$motorista->nome}";

        return view('motorista.create',
            compact('title', 'motorista', 'empresas', 'secretarias', 'validade', 'jornadasTrabalho'));
    }

    public function store(motoristaFormRequest $request)
    {
//        dd($request2->all());
        $dataForm = $request->all();
        $insert = $this->motorista->create($dataForm);
        if ($insert) {
            $idMotorista = $insert->id;
            if ($request->cnh_validade != null) {
                $validade = new CnhValidade();
                $validade->motorista_id = $idMotorista;
                $validade->validade = $request->cnh_validade;
                $validade->visto = 0;
                $insert = $validade->save();
            }

            if ($insert) {
                return redirect()->route('indexMotorista');
            } else {
                return redirect()->back()->withErrors();
            }
        } else {
            return redirect()->back()->withErrors();
        }
    }

    public function update(motoristaFormRequest $request, $idMotorista)
    {
        $dataForm = $request->all();
        $motorista = $this->motorista->find($idMotorista);
        $validade = $this->cnh_validade->where('motorista_id', '=', $idMotorista)->first();

        $update = $motorista->update($dataForm);

        if ($update) {
            $validade->validade = $request->cnh_validade;
            $validade->visto = 0;
            $update = $validade->save();
            if ($update) {
                return redirect()->route('indexMotorista');
            } else {
                return redirect()->route('editMotorista', $idMotorista)->withErrors();
            }
        } else {
            return redirect()->route('editMotorista', $idMotorista)->withErrors();
        }
    }

    public function vencimentoCnh()
    {
        $datahoje = Carbon::now('America/Sao_Paulo')->format('Y-m-d');
        $motoristas = motorista::join('empresas', 'motoristas.empresa_id', '=', 'empresas.id')
            ->join('cnh_validade', 'motoristas.id', '=', 'cnh_validade.motorista_id')
            ->where('cnh_validade.validade', '<=', $datahoje)->select('cnh_validade.validade', 'cnh_numero', 'motoristas.nome', 'nome_fantasia', 'cnh_categoria')->get();

        //where('cnh_validade', '<=',$datahoje)->get();
//dd($motoristas);
        //dd($motoristas);
        return view('motorista.vencimentomotorista', compact('motoristas'));
    }

    public function indexRelatorio()
    {
        $title = "Gerar Relatório de Motoristas";
        $motoristas = $this->motorista->all();

        return view('relatorioMotorista.gerar', compact('title', 'motoristas'));
    }

    public function details($idMotorista)
    {
        $motorista = $this->motorista->find($idMotorista);
        $empresa = $this->empresa->find($motorista->empresa_id);
        $secretaria = $this->secretaria->find($motorista->empresa_id);
        $jornadaTrabalho = $this->jornadaTrabalho->find($motorista->jornada_trabalho_id);
        $cnhValidade = $this->cnh_validade->where('motorista_id', $motorista->id)->first();
        $title = "Visualizar Motorista: {$motorista->nome}";
        return view('motorista.details', compact('title', 'motorista', 'empresa', 'jornadaTrabalho', 'secretaria', 'cnhValidade'));
    }

    public function delete($idMotorista)
    {
        $motorista = $this->motorista->find($idMotorista);
        $nome = $motorista->nome;
        $delete = $motorista->delete();
        if ($delete) {
            return redirect()->route('indexMotorista')->with('message', 'Motorista ' . $nome . ' removido com sucesso.');
        } else {
            return redirect()->back()->with('errors', 'Erro ao tentar excluir.');
        }
        $title = "Visualizar Motorista: {$motorista->nome}";
        return view('motorista.details', compact('title', 'motorista', 'empresa', 'jornadaTrabalho', 'secretaria', 'cnhValidade'));
    }

    public function deleteSenhaMotorista($idMotorista)
    {
        $datenow = Carbon::now();
        $dataFormLog = ['motorista_id'=> $idMotorista, 'user_id' => Auth::user()->id, 'data_alteracao' => $datenow];
        $dataForm = ['senha'=> NULL];
        $motorista = $this->motorista->find($idMotorista);
        $this->logResetSenhaMotorista->create($dataFormLog);

        $motorista->update($dataForm);

        return redirect()->route('indexMotorista');
    }

    public function getMotoristaById()
    {
        $motorista_id = request()->get('motorista_id');

        $motorista = motorista::find($motorista_id);
        return json_encode($motorista);
    }

    public function defineSenhaMotorista()
    {
        $motorista_id = request()->get('motorista_id');
        $pass = request()->get('pass');

        $motorista = motorista::find($motorista_id);
        $motorista->senha = $pass;

        $updated = $motorista->save();
        if ($updated)
            $ret = ["message" => "true"];
        else
            $ret = ["message" => "false"];
        return json_encode($ret);
    }
}
