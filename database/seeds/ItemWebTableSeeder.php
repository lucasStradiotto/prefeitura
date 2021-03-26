<?php

use Illuminate\Database\Seeder;

class ItemWebTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public $objects = [];
    public function run()
    {
        $this->generate('Gestão Arborização', null, true, "Arborização");
        $this->generate('Cadastrar Espécie de Árvores', "../../arborizacao/especie-arvore", false, "Arborização");
        $this->generate('Cadastrar Quadrantes', "../../arborizacao/quadrante", false, "Arborização");
        $this->generate('Inventário Arboreo', "../../arborizacao/inventario-arboreo", false, "Arborização");
        $this->generate('Cadastrar Podadores', "../../arborizacao/podador", false, "Arborização");
        $this->generate('Solicitações de Poda', "../../arborizacao/gestao-arvore/poda", false, "Arborização");
        $this->generate('Solicitações de Retirada', "../../arborizacao/gestao-arvore/retirada", false, "Arborização");
        $this->generate('Gerar Autorização', "../../arborizacao/formulario-autorizacao", false, "Arborização");
        $this->generate('Consultar Autorização', "../../arborizacao/consultar-autorizacao", false, "Arborização");

        $this->generate('Gestão Veículos', null, true, "Veículos");
        $this->generate('Parâmetros Veículos', null, true, "Veículos");
        $this->generate('Rastreamento', null, true, "Veículos");
        $this->generate('Abastecimento', null, true, "Veículos");
        $this->generate('Checklist de Manutenção', null, true, "Veículos");
        $this->generate('Manutenção Preventiva', null, true, "Veículos");
        $this->generate('Manutenção Corretiva', null, true, "Veículos");
        $this->generate('Motoristas', null, true, "Veículos");

        $this->generate('Gestão Entulho', null, true, "Resíduos");
        $this->generate('Cerca Eletrônica', null, true, "Resíduos");
        $this->generate('Cadastrar Empresa', "../../controleobras/empresa", false, "Resíduos");
        $this->generate('Cadastrar Motorista', "../../controleobras/motorista", false, "Resíduos");
        $this->generate('Cadastrar Jornada de Trabalho', "../../controleobras/jornada-trabalho", false, "Resíduos");
        $this->generate('Cadastrar Caçamba', "../../controleobras/cacamba", false, "Resíduos");
        $this->generate('Atribuir Prazo', "../../controleobras/prazo", false, "Resíduos");
        $this->generate('Cadastrar Tipo de Entulho', "../../controleobras/tipo-entulho", false, "Resíduos");
        $this->generate('Cadastrar CTR-e', "../../controleobras/ordem-coleta", false, "Resíduos");
        $this->generate('Imprimir CTR-e', "../../controleobras/controle-transpote-residuo", false, "Resíduos");
        $this->generate('Fechar CTR-e', "../../controleobras/fechar-ordem", false, "Resíduos");

        $this->generate('Rede Elétrica', null, true, "Iluminação");

        $this->generate('Gestão Obras', null, true, "Obras");
        $this->generate('Cadastrar Grupo de Assuntos', "../../controleobras/tipo-assunto", false, "Obras");
        $this->generate('Cadastrar Assuntos', "../../controleobras/assunto", false, "Obras");
        $this->generate('Cadastrar Status', "../../controleobras/status", false, "Obras");
        $this->generate('Cadastrar Estagiário', "../../controleobras/estagiario", false, "Obras");
        $this->generate('Cadastrar Engenheiro', "../../controleobras/engenheiro", false, "Obras");
        $this->generate('Atribuir Número de Documento', "../../controleobras/numero-documento", false, "Obras");
        $this->generate('Cadastrar Setor Protocolo', "../../controleobras/setor-protocolo", false, "Obras");
        $this->generate('Cadastrar Responsáveis', "../../controleobras/responsavel", false, "Obras");
        $this->generate('Exibir Protocolos', "../../controleobras/protocolo", false, "Obras");
        $this->generate('Gerar Relatório', "../../controleobras/relatorios", false, "Obras");
        $this->generate('Atualizar Status', "../../controleobras/atualizar-status", false, "Obras");
        $this->generate('Parâmetros - Fiscalização Obras', null, true, "Obras");

        $this->generate('Notificações WEB', null, true, "Postura");
        $this->generate('Notificações', "../../controleposturas/tipo", false, "Postura");
        $this->generate('Parâmetros', "../../controleposturas/parametros", false, "Postura");
        $this->generate('Gráficos', "../../controleposturas/graficos", false, "Postura");
        $this->generate('Relatorios', "../../controleposturas/relatorio", false, "Postura");
        $this->generate('Distribuição Geografica', "distribuicaoGeografica", false, "Postura");

        //adições
        $this->generate('Inconsistências Inventário Arbóreo', "../../arborizacao/inconsistencia-inventario", false, "Arborização");
        $this->generate('Relatórios Fiscalização Obras', "../../controleobras/vistoria-obras", false, "Obras");
        $this->generate('Solicitar Poda', "../../arborizacao/solicitar/poda", false, "Arborização");
        $this->generate('Solicitar Retirada', "../../arborizacao/solicitar/retirada", false, "Arborização");
        $this->generate('Solicitações de Poda e Supressão', "../../controleobras/solicitacao-poda-supressao", false, "Obras");   

        $this->generate('Visualizar Percurso dos Agentes', null, true, "Postura");
        $this->generate('Relatório de Horas Trabalhadas', "../../controleposturas/relatorio-horas", false, "Postura");

        $this->generate('Cadastrar Status de Caçambas', "../../controleobras/status-cacamba", false, "Resíduos");

        $this->generate('Cadastrar Limpeza', "limpezaAgricultura", false, "Agricultura");

        DB::table('item_web')->truncate();
        DB::table('item_web')->insert($this->objects);
    }

    public function generate($name, $link, $accordion, $parent)
    {
        $icon_id = \App\Models\IconeWeb::where('nome', $parent)->first()->id;
        $obj = [
            'nome' => $name,
            'link' => $link,
            'accordion' => $accordion,
            'icone_id' => $icon_id
        ];
        array_push($this->objects, $obj);
    }
}