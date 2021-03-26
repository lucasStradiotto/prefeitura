<?php

use Illuminate\Database\Seeder;

class ItemAccordionWebTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public $objects = [];
    public function run()
    {
        $this->generate("Árvores Secas", "../../arborizacao/grafico/arvore-seca", "Gestão Arborização");
        $this->generate("Fitossanidade", "../../arborizacao/grafico/fitossanidade", "Gestão Arborização");
        $this->generate("Número de Exemplares", "../../arborizacao/grafico/numero-exemplares", "Gestão Arborização");
        $this->generate("Espécies Nativas", "../../arborizacao/grafico/especie-nativa", "Gestão Arborização");
        $this->generate("Inventário Arboreo", "../../arborizacao/inventario-arboreo", "Gestão Arborização");
        $this->generate("Relat. Inv. Arboreo", "../../arborizacao/inventario-arboreo/relatorio", "Gestão Arborização");

        $this->generate('Diário de Bordo', "../../../controleobras/diariodebordo", "Gestão Veículos");
        $this->generate('Relatório de Manutenção', "../../../controleobras/manutencao/relatorio", "Gestão Veículos");
        $this->generate('Custo Manutenção', "../../../controleobras/grafico/gasto-manutencao", "Gestão Veículos");
        $this->generate('Gráfico de Consumo', "../../../controleobras/graficoAbastecimento", "Gestão Veículos");
        $this->generate('Gráfico de Km / Litro', "../../../controleobras/graficoKmLitro", "Gestão Veículos");
        $this->generate('Relatório de Veículo', "../../../controleobras/relatorios-veiculos", "Gestão Veículos");
        $this->generate('Relatório de Autonomia', "../../../controleobras/relatorios-autonomia", "Gestão Veículos");

        $this->generate('Cadastrar Nova Rota', null, "Parâmetros Veículos", "novaRota");
        $this->generate('Pontos de Ônibus', null, "Parâmetros Veículos", "novoPontoOnibus");
        $this->generate('Atrelar Rota ao veículo', "../../../controleobras/rota-veiculo", "Parâmetros Veículos");
        $this->generate('Cadastrar Tipo de Veículo', "../../../controleobras/tipo-veiculo", "Parâmetros Veículos");
        $this->generate('Cadastrar Veículo', "../../../controleobras/veiculo", "Parâmetros Veículos");
        $this->generate('Horário Programado', "../../../controleobras/horario-programado", "Parâmetros Veículos");
        $this->generate('Setor', "../../../controleobras/despesa-setor", "Parâmetros Veículos");
        $this->generate('Sub Setor', "../../../controleobras/despesa-sub-setor", "Parâmetros Veículos");

        $this->generate('Transporte', null, "Rastreamento", "rasttrans");

        $this->generate('Tipos de Combustível', "../../../controleobras/tipo-combustiveis", "Abastecimento");
        $this->generate('Cadastro Posto', "../../../controleobras/postosdegasolina", "Abastecimento");
        $this->generate('Cadastro Frentista', "../../../controleobras/frentista", "Abastecimento");
        $this->generate('Definição de Cotas', "../../../controleobras/veiculoscota", "Abastecimento");
        $this->generate('Solicitação', "../../../controleobras/abastecimento", "Abastecimento");
        $this->generate('Abastecimento por Mês', "../../../controleobras/relatorio-cotas", "Abastecimento");
        $this->generate('Abastecimento por Período', "../../../controleobras/relatorio-cotas-periodo", "Abastecimento");
        $this->generate('Abastecimento Manual', "../../../controleobras/abastecimento/manual", "Abastecimento");

        $this->generate('Cadastrar Tipo de Padrão', "../../../controleobras/tipo-padroes", "Checklist de Manutenção");
        $this->generate('Cadastrar Grupo de Exame', "../../../controleobras/tipo-exames", "Checklist de Manutenção");
        $this->generate('Cadastrar Padrão', "../../../controleobras/padrao", "Checklist de Manutenção");
        $this->generate('Cadastrar Exame', "../../../controleobras/exame", "Checklist de Manutenção");
        $this->generate('Exames Relacionados aos Veículos', "../../../controleobras/veiculos-exames", "Checklist de Manutenção");

        $this->generate('Cadastrar Tipo Preventiva', "../../../controleobras/tipo-preventiva", "Manutenção Preventiva");
        $this->generate('Cadastrar Unidade de Intervalo', "../../../controleobras/unidade-intervalo", "Manutenção Preventiva");
        $this->generate('Cadastrar Preventiva', "../../../controleobras/preventiva", "Manutenção Preventiva");
        $this->generate('Cronograma', "../../../controleobras/cronograma-manutencao", "Manutenção Preventiva");

        $this->generate('Gerar Corretiva', "../../../controleobras/corretiva", "Manutenção Corretiva");

        $this->generate('Cadastrar Motorista', "../../../controleobras/motorista/create", "Motoristas");
        $this->generate('Listar Motorista', "../../../controleobras/motorista", "Motoristas");
        $this->generate('Habilitações Vencidas', "../../../controleobras/motorista/cnhvenc", "Motoristas");

        $this->generate('Caçambas Entregues', "../../../controleobras/grafico/cacambas-entregues", "Gestão Entulho");

        $this->generate('Criar', "../../../controleobras/poligonos", "Cerca Eletrônica");
        $this->generate('Definir Área', "../../../controleobras/vertice-show", "Cerca Eletrônica");

        $this->generate('Anomalias', "../../../controleobras/anomalia", "Rede Elétrica");
        $this->generate('Status da Solicitação', "../../../controleobras/status-solicitacao", "Rede Elétrica");
        $this->generate('Solicitação de Intervenção', "../../../controleobras/solicitacoes-rede-eletrica", "Rede Elétrica");

        $this->generate('Arrecadação com Protocolos', "../../../controleobras/arrecadacao-protocolo", "Gestão Obras");

        $this->generate('Abastecimento de Água', "../../../controleobras/abastecimentoAgua", "Parâmetros - Fiscalização Obras");
        $this->generate('Número de Pavimento', "../../../controleobras/numeroPavimento ", "Parâmetros - Fiscalização Obras");
        $this->generate('Serviço de Esgoto', '../../../controleobras/servicoEsgoto', "Parâmetros - Fiscalização Obras");
        $this->generate('Serviço de Rede Elétrica', '../../../controleobras/servicoRedeEletrica', "Parâmetros - Fiscalização Obras");
        $this->generate('Melhorias', '../../../controleobras/melhorias', "Parâmetros - Fiscalização Obras");
        $this->generate('Categoria de Proprietários', '../../../controleobras/catProprietario', "Parâmetros - Fiscalização Obras");
        $this->generate('Piso Interno', '../../../controleobras/pisoInterno', "Parâmetros - Fiscalização Obras");
        $this->generate('Piso Externo', '../../../controleobras/pisoExterno', "Parâmetros - Fiscalização Obras");
        $this->generate('Pintura Interna', '../../../controleobras/pinturaInt', "Parâmetros - Fiscalização Obras");
        $this->generate('Pintura Externa', '../../../controleobras/pinturaExt', "Parâmetros - Fiscalização Obras");
        $this->generate('Revestimento Interno', '../../../controleobras/revestinterno', "Parâmetros - Fiscalização Obras");
        $this->generate('Revestimento Externo', '../../../controleobras/revestexterno', "Parâmetros - Fiscalização Obras");
        $this->generate('Forro', '../../../controleobras/forro', "Parâmetros - Fiscalização Obras");
        $this->generate('Esquadria Porta', '../../../controleobras/esquadria-porta', "Parâmetros - Fiscalização Obras");
        $this->generate('Esquadria Janela', '../../../controleobras/esquadria-janela', "Parâmetros - Fiscalização Obras");
        $this->generate('Pintura Esquadria', '../../../controleobras/pintura-esquadria', "Parâmetros - Fiscalização Obras");
        $this->generate('Instalação Elétrica', '../../../controleobras/instalacao-eletrica', "Parâmetros - Fiscalização Obras");
        $this->generate('Instalação Sanitária', '../../../controleobras/instalacao-sanitaria', "Parâmetros - Fiscalização Obras");
        $this->generate('Estrutura', '../../../controleobras/estrutura', "Parâmetros - Fiscalização Obras");
        $this->generate('Estrutura Telhado', '../../../controleobras/estrutura-telhado', "Parâmetros - Fiscalização Obras");
        $this->generate('Cobertura', '../../../controleobras/cobertura', "Parâmetros - Fiscalização Obras");
        $this->generate('Elevador', '../../../controleobras/elevador', "Parâmetros - Fiscalização Obras");
        $this->generate('Situação Construção', '../../../controleobras/situacao-construcao', "Parâmetros - Fiscalização Obras");
        $this->generate('Localização Vertical', '../../../controleobras/localizacao-vertical', "Parâmetros - Fiscalização Obras");
        $this->generate('Acabamentos', '../../../controleobras/acabamento', "Parâmetros - Fiscalização Obras");
        $this->generate('Casa Alinhada', '../../../controleobras/casa-alinhada', "Parâmetros - Fiscalização Obras");
        $this->generate('Casa Recuada', '../../../controleobras/casa-recuada', "Parâmetros - Fiscalização Obras");
        $this->generate('Escritório', '../../../controleobras/escritorio', "Parâmetros - Fiscalização Obras");
        $this->generate('Comércio', '../../../controleobras/comercio', "Parâmetros - Fiscalização Obras");
        $this->generate('Estado Conservação', '../../../controleobras/estado-conservacao', "Parâmetros - Fiscalização Obras");
        $this->generate('Categorias', '../../../controleobras/categoria', "Parâmetros - Fiscalização Obras");
        $this->generate('Forma Terreno', '../../../controleobras/forma-terreno', "Parâmetros - Fiscalização Obras");
        $this->generate('Situação Terreno', '../../../controleobras/situacao-terreno', "Parâmetros - Fiscalização Obras");
        $this->generate('Uso Terreno', '../../../controleobras/uso-terreno', "Parâmetros - Fiscalização Obras");
        $this->generate('Proteção Calçada', '../../../controleobras/protecao-calcada', "Parâmetros - Fiscalização Obras");
        $this->generate('Pedologia Terreno', '../../../controleobras/pedologia-terreno', "Parâmetros - Fiscalização Obras");
        $this->generate('Topografia Terreno', '../../../controleobras/topografia-terreno', "Parâmetros - Fiscalização Obras");

        $this->generate('Motivos de Notificações WEB', '../../../controlepostura/motivo-notificacao', "Notificações WEB");
        $this->generate('Servidores Credenciados', '../../../controlepostura/servidor-credenciado', "Notificações WEB");

        $this->generate('Auto Infração dos Agentes',  "../../controleposturas/visualizar-agente", "Visualizar Percurso dos Agentes");
        $this->generate('Trajeto dos Agentes',  "../../../controleposturas/trajetoagente", "Visualizar Percurso dos Agentes");

        DB::table('item_accordion_web')->truncate();
        DB::table('item_accordion_web')->insert($this->objects);
    }

    public function generate($name, $link, $parent, $javascript_id = null)
    {
        $item_id = \App\Models\ItemWeb::where('nome', $parent)->first()->id;
        $obj = [
            'nome' => $name,
            'link' => $link,
            'item_id' => $item_id,
            'javascript_id' => $javascript_id
        ];
        array_push($this->objects, $obj);
    }
}