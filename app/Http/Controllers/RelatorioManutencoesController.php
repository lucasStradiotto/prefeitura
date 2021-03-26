<?php

namespace App\Http\Controllers;

use App\Models\ordemServicoCorretiva;
use App\Models\ordemServicoPreventiva;
use App\Models\pecasCorretivas;
use App\Models\pecasPreventivas;
use App\Models\prefeitura;
use App\Models\veiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class RelatorioManutencoesController extends Controller
{
    private $veiculo;
    private $corretiva;
    private $pecas_corretivas;
    private $preventiva;
    private $pecas_preventivas;
    private $prefeitura;

    public function __construct(ordemServicoCorretiva $corretiva, ordemServicoPreventiva $preventiva,
                                pecasPreventivas $pecas_preventivas, pecasCorretivas $pecas_corretivas,
                                veiculo $veiculo, prefeitura $prefeitura)
    {
        Session::put('url.intended', URL::current());
        $this->corretiva = $corretiva;
        $this->preventiva = $preventiva;
        $this->pecas_corretivas = $pecas_corretivas;
        $this->pecas_preventivas = $pecas_preventivas;
        $this->veiculo = $veiculo;
        $this->prefeitura = $prefeitura;
    }

    public function indexRelatorio()
    {
        $title = "Relatório de Manutenções";

        return view('relatorioManutencao.manutencao', compact('title'));
    }

    public function gerarRelatorio(Request $request)
    {
        $prefeitura = [
        'logo' => $this->prefeitura->first()->logo,
        'nome' => $this->prefeitura->first()->nome,
        'endereco' => $this->prefeitura->first()->endereco
    ];
        /*
         * Parte de Validação do Form
         */

        $this->validate($request, [
            'inicio' => 'required',
            'fim' => 'required',
        ], [
            'inicio.required' => "Preencha o Início",
            'fim.required' => "Preencha o Fim",
        ]);

        $title = "Relatório de Manutenções";

        /*
         * Dados para preencher no Relatório
         */
        $dataInicio = $request["inicio"];
        $dataFim = $request["fim"];
        $valorTotalCorretivas = 0;
        $valorTotalPreventivas = 0;

        /*
         * Pega todas as Corretivas e Preventivas das tabelas
         */
        $corretivas = $this->corretiva
            ->whereBetween('data_execucao', [$dataInicio, $dataFim])
            ->get();

        $preventivas = $this->preventiva
            ->whereBetween('data_execucao', [$dataInicio, $dataFim])
            ->get();

        /*
         * Converte a data para o formato de exibição na tela
         */

        $dataInicio = explode('-', $dataInicio)[2] . "/" .
            explode('-', $dataInicio)[1] . "/" .
            explode('-', $dataInicio)[0];

        $dataFim = explode('-', $dataFim)[2] . "/" .
            explode('-', $dataFim)[1] . "/" .
            explode('-', $dataFim)[0];


        /*
         * Faz o tratamento dos dados que serão utilizados na tabela de Corretivas
         */
        $tabelaCorretivas = [];
        foreach ($corretivas as $corretiva)
        {
            $pecas = $this->pecas_corretivas
                ->where('ordem_servico_id', '=', $corretiva->id)
                ->get();
            $veiculo = $this->veiculo->find($corretiva->veiculo_id);

            $possui = false;
            foreach(array_keys($tabelaCorretivas) as $chave)
                if ($chave == $veiculo->placa)
                    $possui = true;

            if (!$possui)
                $tabelaCorretivas += [
                    $veiculo->placa => []
                ];

            foreach ($pecas as $peca)
            {
                $linha = [
                    'data' => $corretiva->data_execucao,
                    'peca_trocada' => $peca->nome,
                    'qtd' => $peca->qtd,
                    'valor_unitario' => $peca->valor,
                    'valor_total' => $peca->valor * $peca->qtd,
                ];
                array_push($tabelaCorretivas[$veiculo->placa], $linha);
            }
            $valorTotalCorretivas += $corretiva->valor_total;
        }
        $vet = [];
        foreach (array_keys($tabelaCorretivas) as $chave) {
            array_push($vet, $chave);
            foreach ($tabelaCorretivas[$chave] as $preventiva)
                array_push($vet, $preventiva);
        }
        $tabelaCorretivas = $vet;

        /*
         * Faz o tratamento dos dados que serão utilizados na tabela de Preventivas
         */
        $tabelaPreventivas = [];

        foreach ($preventivas as $preventiva)
        {
            $pecas = $this->pecas_preventivas
                ->where('ordem_servico_id', '=', $preventiva->id)
                ->get();
            $veiculo = $this->veiculo->find($preventiva->veiculo_id);

            $possui = false;
            foreach(array_keys($tabelaPreventivas) as $chave)
                if ($chave == $veiculo->placa)
                    $possui = true;

            if (!$possui)
                $tabelaPreventivas += [
                    $veiculo->placa => []
                ];

            foreach ($pecas as $peca)
            {
                $linha = [
                    'data' => $preventiva->data_execucao,
                    'peca_trocada' => $peca->nome,
                    'qtd' => $peca->qtd,
                    'valor_unitario' => $peca->valor,
                    'valor_total' => $peca->valor * $peca->qtd,
                ];
                array_push($tabelaPreventivas[$veiculo->placa], $linha);
            }
            $valorTotalPreventivas += $preventiva->valor_total;
        }
        $vet = [];
        foreach (array_keys($tabelaPreventivas) as $chave) {
            array_push($vet, $chave);
            foreach ($tabelaPreventivas[$chave] as $preventiva)
                array_push($vet, $preventiva);
        }
        $tabelaPreventivas = $vet;

        /*
         * Cria um vetor para facilitar o envio dos dados para a view
         */
        $dadosRelatorio = [
            'dataInicio' => $dataInicio,
            'dataFim' => $dataFim,
            'valorCorretivas' => $valorTotalCorretivas,
            'valorPreventivas' => $valorTotalPreventivas
        ];

        return view('relatorioManutencao.relatorioManutencao', compact('title', 'corretivas',
            'dadosRelatorio', 'tabelaCorretivas',
            'tabelaPreventivas', 'prefeitura'));
    }
}
