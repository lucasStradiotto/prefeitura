<?php

namespace App\Http\Controllers;

use App\Models\assunto;
use App\Models\estagiario;
use App\Models\protocolo;
use App\Models\tipoAssunto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class RelatorioController extends Controller
{
    private $protocolo;
    private $assunto;
    private $tipoAssunto;
    private $estagiario;

    public function __construct(
        protocolo $protocolo,
        assunto $assunto,
        tipoAssunto $tipoAssunto,
        estagiario $estagiario
    ) {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
        $this->protocolo = $protocolo;
        $this->assunto = $assunto;
        $this->tipoAssunto = $tipoAssunto;
        $this->estagiario = $estagiario;
    }

    public function index()
    {
        $title = "Gerar Relatório";
        $estagiarios = $this->estagiario->all();

        return view('relatorios.index', compact('title', 'estagiarios'));
    }

    public function todosServicos(Request $request)
    {
        $title = "Relatório Mensal de Todos Serviços";
        if ($request["ano"] == null) {
            $request["ano"] = date('Y');
        }

        $mes = $request["mes"];
        $numeroMes = $this->converteMes($mes);
        $ano = $request["ano"];

        $dataLastDay = new \DateTime('last day of ' . (int)$ano . '-' . $numeroMes);
        $dataFirstDay = new \DateTime('first day of ' . (int)$ano . '-' . $numeroMes);

        $processosNoPeriodo = $this->protocolo
                    ->whereBetween('data_fim', array($dataFirstDay, $dataLastDay))
                    ->orWhereBetween('data_inicio', array($dataFirstDay, $dataLastDay))
                    ->get();

        $qtd_processos = count($processosNoPeriodo);

        $processosNoPeriodo = $this->_group_by($processosNoPeriodo, "assunto");
        $dataToTable = [];

        for ($i=0; $i < count($processosNoPeriodo); $i++)
        {
            $dataToTable[$i]['nome'] = array_keys($processosNoPeriodo)[$i];
            $dataToTable[$i]['qtd'] = count($processosNoPeriodo[$dataToTable[$i]['nome']]);
        }

        return view('relatorios.todosServicos',
            compact('title', 'mes', 'ano', 'dataLastDay', 'dataToTable', 'qtd_processos'));
    }

    //FUNÇÃO QUE AGRUPO O VETOR POR UMA CHAVE QUALQUER
    function _group_by($array, $key) {
        $return = array();
        foreach($array as $val) {
            $return[$val->$key][] = $val;
        }
        return $return;
    }


    public function servicosExecutados(Request $request)
    {
        $title = "Relatório Mensal de Serviços Executados";
        if ($request["ano"] == null) {
            $request["ano"] = date('Y');
        }
        $estagiario = $request["estagiario"];
        $mes = $request["mes"];
        $numeroMes = $this->converteMes($mes);
        $ano = $request["ano"];

        $dataLastDay = new \DateTime('last day of ' . (int)$ano . '-' . $numeroMes);
        $dataFirstDay = new \DateTime('first day of ' . (int)$ano . '-' . $numeroMes);

        $processosNoPeriodo = $this->protocolo->whereBetween('data_fim', array($dataFirstDay, $dataLastDay))->get();
        $assuntos = $this->assunto->all();
        $tiposAssunto = $this->tipoAssunto->all();

        $dadosServicos = [
            'qtdConstrucao' => 0,
            'qtdDemolicao' => 0,
            'qtdHabitese' => 0,
            'qtdMedCon' => 0
        ];
        $dadosDocumentos = [
            'qtdAprovados' => 0,
            'qtdVistos' => 0,
            'qtdCancelados' => 0,
            'qtdOutros' => 0
        ];

        foreach ($processosNoPeriodo as $processo) {
            foreach ($assuntos as $assunto) {
                if ($processo->status == "Emitido") {
                    if ($processo->assunto == $assunto->nome) {
                        foreach ($tiposAssunto as $tipoAssunto) {
                            if ($assunto->tipo_assunto_id == $tipoAssunto->id) {
                                if ($tipoAssunto->grupo == "Construção") {
                                    $dadosServicos["qtdConstrucao"]++;
                                } else {
                                    if ($tipoAssunto->grupo == "Demolição") {
                                        $dadosServicos["qtdDemolicao"]++;
                                    } else {
                                        if ($tipoAssunto->grupo == "Habitação") {
                                            $dadosServicos["qtdHabitese"]++;
                                        } else {
                                            if ($tipoAssunto->grupo == "Confrontações") {
                                                $dadosServicos["qtdMedCon"]++;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                } else {
                    if ($processo->status == "Aprovado") {
                        $dadosDocumentos["qtdAprovados"]++;
                        break;
                    } else {
                        if ($processo->status == "Visto") {
                            $dadosDocumentos["qtdVistos"]++;
                            break;
                        } else {
                            if ($processo->status == "Cancelado") {
                                $dadosDocumentos["qtdCancelados"]++;
                                break;
                            } else {
                                $dadosDocumentos["qtdOutros"]++;
                                break;
                            }
                        }
                    }
                }
            }
        }

        return view('relatorios.servicosExecutados',
            compact('title', 'mes', 'ano', 'dataLastDay', 'processosNoPeriodo', 'dadosServicos', 'dadosDocumentos',
                'estagiario'));
    }


    public function converteMes($mes)
    {
        switch ($mes) {
            case 'Janeiro':
                $numeroMes = 1;
                break;
            case 'Fevereiro':
                $numeroMes = 2;
                break;
            case 'Março':
                $numeroMes = 3;
                break;
            case 'Abril':
                $numeroMes = 4;
                break;
            case 'Maio':
                $numeroMes = 5;
                break;
            case 'Junho':
                $numeroMes = 6;
                break;
            case 'Julho':
                $numeroMes = 7;
                break;
            case 'Agosto':
                $numeroMes = 8;
                break;
            case 'Setembro':
                $numeroMes = 9;
                break;
            case 'Outubro':
                $numeroMes = 10;
                break;
            case 'Novembro':
                $numeroMes = 11;
                break;
            case 'Dezembro':
                $numeroMes = 12;
                break;
            default:
                $numeroMes = 0;
                break;
        }
        return $numeroMes;
    }
}
