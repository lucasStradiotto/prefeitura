<?php

namespace App\Http\Controllers;

use App\Http\Requests\ordemServicoPreventivaFormRequest;
use App\Models\pecasPreventivas;
use Illuminate\Http\Request;
use App\Models\ordemServicoPreventiva;
use App\Models\preventiva;
use App\Models\secretaria;
use App\Models\tipoPreventiva;
use App\Models\unidadeIntervalo;
use App\Models\veiculo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class CronogramaManutencaoController extends Controller
{
    private $veiculo;
    private static $preventiva;
    private $tipoPreventiva;
    private static $unidadeIntervalo;
    private static $ordemServico;
    private $secretaria;

    public function __construct(
        veiculo $veiculo,
        preventiva $preventiva,
        tipoPreventiva $tipoPreventiva,
        unidadeIntervalo $unidadeIntervalo,
        ordemServicoPreventiva $ordemServico,
        secretaria $secretaria
    )
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
        $this->veiculo = $veiculo;
        self::$preventiva = $preventiva;
        $this->tipoPreventiva = $tipoPreventiva;
        self::$unidadeIntervalo = $unidadeIntervalo;
        self::$ordemServico = $ordemServico;
        $this->secretaria = $secretaria;
    }

    public function index(Request $request)
    {
        $title = 'Cronograma de Manutenção';
        $veiculos = $this->veiculo;
        $userempresa = Auth::user()->empresa_id;

        if (Auth::user()->hasRole('transportador')) {
            $veiculos = $this->veiculo->where('empresa_id', '=', $userempresa);
            //dd($veiculos);
        } else {

            if ($request->filtro_secretaria != null) {
                $veiculos = $this->veiculo->where('secretaria_id', $request["filtro_secretaria"]);
                if ($request->filtro_veiculo != null) {
                    $veiculos = $this->veiculo->where('id', $request["filtro_veiculo"]);
                }
            }

        }
        $veiculos = $veiculos->get();
        $preventivas = self::$preventiva->all();
        $tiposPreventiva = $this->tipoPreventiva->all();
        $secretarias = $this->secretaria->orderBy('nome')->get();

        $dataAtual = Carbon::now();
        $datas['numeroMes'] = $dataAtual->month;
        $datas['ano'] = $dataAtual->year;
        $datas['nomeMes'] = $this->converterMes($datas['numeroMes']);
        $datas['qtdDias'] = $dataAtual->lastOfMonth()->day;

        return view('cronogramaManutencao.index',
            compact('title', 'datas', 'veiculos', 'preventivas', 'tiposPreventiva', 'secretarias'));
    }

    public static function verificarData($id_preventiva, $dataAtual, $diaAtual)
    {
        $preventiva = self::$preventiva->find($id_preventiva);
        $unidadesIntervalo = self::$unidadeIntervalo->all();
        $ordensServico = self::$ordemServico->all();

        foreach ($ordensServico as $ordemServico) {
            if ($ordemServico->preventiva_id == $preventiva->id) {
                //formata a data da última manutencao (que vem do banco) para poder comparar
                $dataExecucao = explode(" ", $ordemServico->data_execucao);
                $dataExecucao = explode("-", $dataExecucao[0]);
                $ano = $dataExecucao[0];
                $mes = $dataExecucao[1];
                $dia = $dataExecucao[2];

                $dataExecucao = Carbon::createFromDate($ano, $mes, $dia);
//                $dataExecucao->addDay($preventiva->intervalo);
                $dataExecucao = explode(" ", $dataExecucao);
                $dataExecucao = $dataExecucao[0];

                //formata a data (dia atual) para poder comparar
                $dtAtual = explode("/", $dataAtual);
                $mAtual = $dtAtual[0];
                $aAtual = $dtAtual[1];
                $dtAtual = Carbon::createFromDate($aAtual, $mAtual, $diaAtual);
                $dtAtual = explode(" ", $dtAtual);
                $dtAtual = $dtAtual[0];

                if ($dataExecucao == $dtAtual) {
                    $retorno['status'] = 'finalizado';
                    $retorno['id'] = $ordemServico->id;
                    return $retorno;
                }
            }
        }

        foreach ($unidadesIntervalo as $unidade) {
            if ($preventiva->unidade_intervalo_id == $unidade->id) {
                /* Teremos problemas com esta comparação utilizando string no futuro,
                pois caso o usuário cadastre a unidade de Intervalo com outro nome o
                sistema não reconhecerá. */
                //adicionar no if um || ($unidade->nome == "Dia")
                //criar else if para ($unidade->nome == "Mes")
                //neste else if $dataLimite->addMonth($preventiva->intervalo);
                if ($unidade->nome == "Dias") {
                    $dataLimite = explode(" ", $preventiva->data_ultima_manutencao);
                    $dataLimite = explode("-", $dataLimite[0]);
                    $ano = $dataLimite[0];
                    $mes = $dataLimite[1];
                    $dia = $dataLimite[2];

                    $dataLimite = Carbon::createFromDate($ano, $mes, $dia);
                    $dataLimite->addDay($preventiva->intervalo);
                    $dataLimite = explode(" ", $dataLimite);
                    $dataLimite = $dataLimite[0];

                    $dataHoje = explode("/", $dataAtual);
                    $mesHoje = $dataHoje[0];
                    $anoHoje = $dataHoje[1];
                    $dataHoje = Carbon::createFromDate($anoHoje, $mesHoje, $diaAtual);
                    $dataHoje = explode(" ", $dataHoje);
                    $dataHoje = $dataHoje[0];

                    if ($dataHoje == $dataLimite) {
                        if ($dataLimite >= Carbon::now()) {
                            $retorno['status'] = 'planejado';
                            return $retorno;
                        } else {
                            $retorno['status'] = 'atrasado';
                            return $retorno;
                        }
                    } else {
                        $retorno['status'] = 'normal';
                        return $retorno;
                    }
                }
            }
        }
    }

    public function store(ordemServicoPreventivaFormRequest $request)
    {
        $dataForm = $request->all();
        $insert = self::$ordemServico->create($dataForm);
        if ($insert) {
            $preventiva = self::$preventiva->find($dataForm["preventiva_id"]);
            $preventiva->data_ultima_manutencao = $dataForm["data_execucao"];
            $preventiva->visto = 0;
//            dd($preventiva->visto);
            $update = $preventiva->save();
            if ($update) {
                $nomes = $dataForm["nomes"];
                $qtds = $dataForm["qtds"];
                $valores = $dataForm["valores"];
                $codigos = $dataForm["codigos"];

                for ($i = 0; $i < count($nomes); $i++) {
                    $pecas = new pecasPreventivas();
                    $pecas->codigo = $codigos[$i];
                    $pecas->nome = $nomes[$i];
                    $pecas->qtd = $qtds[$i];
                    $pecas->valor = $valores[$i];
                    $pecas->ordem_servico_id = $insert["id"];
                    $pecas->save();
                }

                return redirect()->route('indexCronogramaManutencao');
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }

    public function converterMes($mes)
    {
        $nomeMes = '';
        switch ($mes) {
            case 1:
                $nomeMes = 'Janeiro';
                break;
            case 2:
                $nomeMes = 'Fevereiro';
                break;
            case 3:
                $nomeMes = 'Março';
                break;
            case 4:
                $nomeMes = 'Abril';
                break;
            case 5:
                $nomeMes = 'Maio';
                break;
            case 6:
                $nomeMes = 'Junho';
                break;
            case 7:
                $nomeMes = 'Julho';
                break;
            case 8:
                $nomeMes = 'Agosto';
                break;
            case 9:
                $nomeMes = 'Setembro';
                break;
            case 10:
                $nomeMes = 'Outubro';
                break;
            case 11:
                $nomeMes = 'Novembro';
                break;
            case 12:
                $nomeMes = 'Dezembro';
                break;
        }
        return $nomeMes;
    }

    public function getTipoPreventiva()
    {
        return json_encode(
            DB::select(
                DB::raw(
                    "SELECT  `preventivas`.`data_ultima_manutencao` AS `data_prevista`,
                                    `preventivas`.`intervalo` AS `intervalo`,
                                   `tipo_preventivas`.`nome` AS `tipo_preventiva`, 
                                   `secretarias`.`nome` AS `secretaria`,
                                   `veiculos`.`id` AS `veiculo` 
                        FROM `preventivas` 
                        INNER JOIN `tipo_preventivas`
                        ON `preventivas`.`tipo_preventiva_id` = `tipo_preventivas`.`id`
                        INNER JOIN `veiculos`
                        ON `preventivas`.`veiculo_id` = `veiculos`.`id`
                        INNER JOIN `secretarias`
                        ON `veiculos`.`secretaria_id` = `secretarias`.`id`
                        WHERE `preventivas`.`id` = ?"
                ),
                array(
                    request()->get('preventiva_id')
                )
            )
        );
    }

    public function getOrdemServico()
    {
        return json_encode(
            DB::select(
                DB::raw(
                    "SELECT `ordem_servico_preventivas`.*,
                                  `secretarias`.`nome` AS `secretaria`
                        FROM `ordem_servico_preventivas` 
                        INNER JOIN `veiculos`
                        ON `ordem_servico_preventivas`.`veiculo_id` = `veiculos`.`id`
                        INNER JOIN `secretarias`
                        ON `veiculos`.`secretaria_id` = `secretarias`.`id`
                        WHERE `ordem_servico_preventivas`.`id` = ?"
                ),
                array(
                    request()->get('id')
                )
            )
        );
    }

    public function getVeiculosPorSecretaria()
    {
        $userempresa = Auth::user()->empresa_id;

        if (Auth::user()->hasRole('transportador')) {
            return json_encode(
                DB::select(
                    DB::raw(
                        "SELECT `veiculos`.`placa` AS `placa`,
                                `veiculos`.`id` AS `id`
                        FROM `veiculos` 
                        INNER JOIN empresas on empresas.id = veiculos.empresa_id 
                        WHERE `veiculos`.`secretaria_id` = ? 
                        and empresa_id = ?
                        "
                    ),
                    array(
                        request()->get('id'),
                        $userempresa
                    )
                )
            );
        } else {
            return json_encode(
                DB::select(
                    DB::raw(
                        "SELECT `veiculos`.`placa` AS `placa`,
                                  `veiculos`.`id` AS `id`
                        FROM `veiculos` 
                        WHERE `veiculos`.`secretaria_id` = ?"
                    ),
                    array(
                        request()->get('id')
                    )
                )
            );
        }
    }
}
