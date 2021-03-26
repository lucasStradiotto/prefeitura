<?php

namespace App\Http\Controllers;

use App\Http\Requests\ordemColetaFormRequest;
use App\Models\bairros;
use App\Models\empresa;
use App\Models\ordemColeta;
use App\Models\tipoEntulho;
use App\Models\veiculo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class OrdemColetaController extends Controller
{
    private $ordemColeta;
    private $bairros;
    private $tipoEntulho;
    private $empresa;
    private $veiculos;
    private $veiculo;
    private $qtdShow = 10;

    public function __construct(
        ordemColeta $ordemColeta,
        bairros $bairros,
        tipoEntulho $tipoEntulho,
        empresa $empresas,
        veiculo $veiculo
    ) {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
        $this->veiculos = $veiculo;
        $this->empresa = $empresas;
        $this->ordemColeta = $ordemColeta;
        $this->bairros = $bairros;
        $this->tipoEntulho = $tipoEntulho;
        $this->veiculo = $veiculo;
    }

    public function index()
    {

        $title = 'Ordens de Coleta';
        $ordensColeta = $this->ordemColeta->paginate($this->qtdShow);

        return view('ordemColeta.index', compact('ordensColeta', 'title'));
    }

    public function create()
    {
        $title = "Cadastrar Ordem de Coleta";
        $bairros = $this->bairros->all();
        $tipoEntulho = $this->tipoEntulho->all();
        $veiculos = $this->veiculo->all();

        return view("ordemColeta.create", compact('title', 'bairros', 'tipoEntulho', 'veiculos'));
    }

    public function edit($idOrdemColeta)
    {
        $ordemColeta = $this->ordemColeta->find($idOrdemColeta);
        $title = "Editar Ordem de Coleta: {$ordemColeta->numero_ctr}";
        $tipoEntulho = $this->tipoEntulho->all();
        $bairros = $this->bairros->all();
        $veiculos = $this->veiculo->all();

        return view('ordemColeta.create', compact('title', 'ordemColeta', 'tipoEntulho', 'bairros', 'veiculos'));
    }


    public function close()
    {
        $ordensColeta = $this->ordemColeta->all();
        $empresas = $this->empresa->all();
        $veiculos = $this->veiculos->all();
        return view('fecharOrdem', compact('ordensColeta', 'veiculos', 'empresas'));
    }


    public function store(ordemColetaFormRequest $request)
    {
        $dataForm = $request->all();
        $dataForm['data'] = Carbon::now();

        $insert = $this->ordemColeta->create($dataForm);

        if ($insert) {
            return redirect()->route('indexOrdemColeta');
        } else {
            return redirect()->back()->withInput();
        }
    }

    public function update(ordemColetaFormRequest $request, $idOrdemColeta)
    {
        $dataForm = $request->all();
        $ordemColeta = $this->ordemColeta->find($idOrdemColeta);

        $update = $ordemColeta->update($dataForm);

        if ($update) {
            return redirect()->route('indexOrdemColeta');
        } else {
            return redirect()->route('editOrdemColeta', $idOrdemColeta)->with(['errors' => 'Falha ao editar']);
        }
    }

    public function updateDataOrdemColeta(Request $request)
    {
        $updateDataEntrega = DB::table('ordem_coletas')
            ->where('id', $request->get('ordem_id'))
            ->update(['data_retirada' => $request->get('data_atual')]);

        if ($updateDataEntrega) {
            return json_encode(true);
        } else {
            return json_encode(false);
        }
    }

    public function getRuas()
    {
        return json_encode(
            DB::select(
                DB::raw(
                    "SELECT `ruas`.`id`, `ruas`.`nome` 
                        FROM `setores_bairros_ruas` 
                        INNER JOIN `ruas` ON `ruas`.`id` = `setores_bairros_ruas`.`rua_id` 
                        WHERE `bairro_id` = ?"
                ),
                array(
                    request()->get('bairro_id'),
                )
            )
        );
    }

    public function getNumeros()
    {
        return json_encode(
            DB::select(
                DB::raw(
                    "SELECT `id`, `numero` 
                        FROM `setores_bairros_ruas_lotes` 
                        WHERE `bairro_id` = ? 
                        AND `rua_id` = ? 
                        ORDER BY numero"
                ),
                array(
                    request()->get('bairro_id'),
                    request()->get('rua_id')
                )
            )
        );
    }

    public function getCaminhoes()
    {
        return json_encode(
            DB::select(
                DB::raw(
                    "SELECT `veiculos`.`id`, `veiculos`.`placa` , `veiculos`.`empresa_id` FROM `veiculos`  WHERE `empresa_id` = ?"
                ),
                array(
                    request()->get('empresa_id'),
                )
            )
        );
    }

    public function getOrdensColeta()
    {
        return json_encode(
            DB::select(
                DB::raw(
                    "SELECT `ordem_coletas`.`id` AS ordemId, `ordem_coletas`.`user_id`, `ordem_coletas`.`nome_solicitante` , `ordem_coletas`.`numero_ctr`, `ordem_coletas`.`endereco_cobranca_id`,
                            `ordem_coletas`.`numero_casa_cobranca_id`, `ordem_coletas`.`data`, `ordem_coletas`.`data_retirada`,  `ordem_coletas`.`data_entrega`, `ordem_coletas`.`bairro_cobranca_id`, 
                            `bairros`.`id`, `bairros`.`nome` AS bairrosNome, `ruas`.`id`, `ruas`.`nome` AS ruasNome, `empresas`.`id`, `empresas`.`razao_social`
                      FROM `ordem_coletas`
                      INNER JOIN `bairros` ON `bairros`.`id` = `ordem_coletas`.`bairro_cobranca_id`
                      INNER JOIN `ruas` ON `ruas`.`id` = `ordem_coletas`.`endereco_cobranca_id`
                      INNER JOIN  `empresas` ON `empresas`.`id` = `ordem_coletas`.`user_id`
                      WHERE `veiculo_id` = ?"
                ),
                array(
                    request()->get('veiculo_id'),
                )
            )
        );
    }
}
