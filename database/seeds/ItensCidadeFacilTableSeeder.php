<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ItensCidadeFacilTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public $itens = [];
    public function run()
    {
        $this->generateItem('visualizar-frota', 'Visualizar Frota Completa');
        $this->generateItem('visualizar-veiculo-trajeto', 'Visualizar Veículos por Trajeto');
        $this->generateItem('visualizar-historico', 'Visualizar Histórico');
        $this->generateItem('grafico-km-l', 'Gráfico de KM / Litro');
        $this->generateItem('grafico-consumo-litro', 'Gráfico de Consumo / Litro');
        $this->generateItem('cnh-vencida', 'CNH Vencida');
        $this->generateItem('checklist-atrasado', 'Checklist Atrasado');
        $this->generateItem('solicitacao-poda', 'Solicitação de Poda');
        $this->generateItem('solicitacao-reparo', 'Solicitação de Reparo');
        $this->generateItem('solicitacao-alvara-demolicao', 'Solicitação de Alvará');
        $this->generateItem('solicitacao-remocao-arvore', 'Solicitação de Remoção de Árvore');
        $this->generateItem('solicitacao-cacamba', 'Solicitação de Caçamba');
        $this->generateItem('finalizar-cte', 'Finalizar CTE');
        $this->generateItem('gerar-ctre', 'Gerar CTR-e');
        $this->generateItem('inventario', 'Inventário');
        $this->generateItem('solicitacao-alvara-construcao', 'Solicitar Alvará');
        $this->generateItem('solicitacao-habitese', 'Solicitação de Habite-se');
        $this->generateItem('sincronizar-inventario', 'Sincronizar Inventário');
        $this->generateItem('sincronizar-especies', 'Sincronizar Espécies');
        $this->generateItem('fiscalizacao-obras', 'Fiscalização de Obras');
        $this->generateItem('edicao-fiscalizacao', 'Edição Formulários de Obras');
        $this->generateItem('sincronizacao-obras', 'Sincronizar Formulários');
        $this->generateItem('autorizacao-poda', 'Autorização de Poda');
        $this->generateItem('autorizacao-remocao', 'Autorização de Remoção');
        $this->generateItem('listagem-motoristas', 'Listagem de Motoristas');
        $this->generateItem('relatorio-manutencao', 'Relatório de Manutenção');
        $this->generateItem('grafico-manutencao', 'Gráfico de Manutenção');
        $this->generateItem('gerar-autorizacao', 'Gerar Autorização');
        $this->generateItem('obras-publicas', 'Obras Públicas');
        $this->generateItem('listar-solicitacoes-cacamba', 'Listar Solicitações de Caçamba');
        $this->generateItem('listar-ordens-coleta', 'Listar Ordens de Coleta');
        $this->generateItem('finalizar-ctre', 'Finalizar CTRe');
        $this->generateItem('retirada-cacamba', 'Retirada de Caçamba');
        $this->generateItem('solicitacao-supressao-arvore', 'Solicitação de Supressão de Árvore');
        $this->generateItem('consultar-cacamba', 'Consultar Caçamba');
        $this->generateItem('cacambas-pendentes', 'Caçambas Pendentes');

        DB::table('itens_cidade_facil')->truncate();
        DB::table('itens_cidade_facil')->insert($this->itens);
    }

    public function generateItem($name, $display_name)
    {
        $dateNow = Carbon::now();
        $item = [
            'nome' => $name,
            'display_name' => $display_name,
            'created_at' => $dateNow,
            'updated_at' => $dateNow
        ];
        array_push($this->itens, $item);
    }
}