<?php

namespace App\Http\Controllers;

use App\Models\AbastecimentoAgua;
use App\Models\Acabamento;
use App\Models\CasaAlinhada;
use App\Models\CasaRecuada;
use App\Models\Categoria;
use App\Models\CategoriaProprietario;
use App\Models\CategoriaUso;
use App\Models\Cobertura;
use App\Models\Comercio;
use App\Models\Elevador;
use App\Models\Escritorio;
use App\Models\EsquadriaJanela;
use App\Models\EsquadriaPorta;
use App\Models\EstadoConservacao;
use App\Models\Estrutura;
use App\Models\EstruturaTelhado;
use App\Models\FormaTerreno;
use App\Models\Forro;
use App\Models\InstalEletrica;
use App\Models\InstalSanitaria;
use App\Models\LocalizacaoVertical;
use App\Models\Melhorias;
use App\Models\NumeroPavimento;
use App\Models\PedologiaTerreno;
use App\Models\PinturaEsquadria;
use App\Models\PinturaExt;
use App\Models\PinturaInt;
use App\Models\PisoExterior;
use App\Models\PisoInterior;
use App\Models\ProtecaoCalcada;
use App\Models\RevestExterno;
use App\Models\RevestInterno;
use App\Models\ServicoEsgoto;
use App\Models\ServicoRedeEletrica;
use App\Models\SituacaoConstrucao;
use App\Models\SituacaoTerreno;
use App\Models\TopografiaTerreno;
use App\Models\UsoTerreno;
use App\Models\VistoriaObras;

class VistoriaObrasController extends Controller
{
    public function index()
    {
        $title = 'Relatório Vistoria Obras';

        $vistorias = VistoriaObras::all();
        return view('vistoriaObras.index', compact('title', 'vistorias'));
    }

    public function details($id)
    {
        $title = 'Relatório Vistoria Obras';
        $vistoria = VistoriaObras::find($id);

        //Itens para popular as categorias do relatorio
        $categorias_proprietario = CategoriaProprietario::orderBy('tipo_categoria')->pluck('tipo_categoria')->toArray();
        $categorias_proprietario_vistoria = explode(',', $vistoria->cat_proprietario);
        $categorias_proprietario_outros = array_diff($categorias_proprietario_vistoria, $categorias_proprietario);
        $categorias_proprietario_outros = reset($categorias_proprietario_outros);

        $numeros_pavimento = NumeroPavimento::orderBy('tipo_pavimento')->pluck('tipo_pavimento')->toArray();
        $numeros_pavimento_vistoria = explode(',', $vistoria->numero_pavimento);
        $numeros_pavimento_outros = array_diff($numeros_pavimento_vistoria, $numeros_pavimento);
        $numeros_pavimento_outros = reset($numeros_pavimento_outros);

        $categorias_uso = CategoriaUso::orderBy('tipo_categoria')->pluck('tipo_categoria')->toArray();
        $categorias_uso_vistoria = explode(',', $vistoria->categoria_uso);
        $categorias_uso_outros = array_diff($categorias_uso_vistoria, $categorias_uso);
        $categorias_uso_outros = reset($categorias_uso_outros);

        $abastecimentos_agua = AbastecimentoAgua::orderBy('tipo_abastecimento')->pluck('tipo_abastecimento')->toArray();
        $abastecimentos_agua_vistoria = explode(',', $vistoria->abastecimento_agua);
        $abastecimentos_agua_outros = array_diff($abastecimentos_agua_vistoria, $abastecimentos_agua);
        $abastecimentos_agua_outros = reset($abastecimentos_agua_outros);

        $servicos_esgoto = ServicoEsgoto::orderBy('tipo_esgoto')->pluck('tipo_esgoto')->toArray();
        $servicos_esgoto_vistoria = explode(',', $vistoria->servico_esgoto);
        $servicos_esgoto_outros = array_diff($servicos_esgoto_vistoria, $servicos_esgoto);
        $servicos_esgoto_outros = reset($servicos_esgoto_outros);

        $servicos_rede_eletrica = ServicoRedeEletrica::orderBy('tipo_rede_eletrica')->pluck('tipo_rede_eletrica')->toArray();
        $servicos_rede_eletrica_vistoria = explode(',', $vistoria->servico_rede_eletrica);
        $servicos_rede_eletrica_outros = array_diff($servicos_rede_eletrica_vistoria, $servicos_rede_eletrica);
        $servicos_rede_eletrica_outros = reset($servicos_rede_eletrica_outros);

        $melhorias_municipio = Melhorias::orderBy('tipo_melhoria')->pluck('tipo_melhoria')->toArray();
        $melhorias_municipio_vistoria = explode(',', $vistoria->melhorias);
        $melhorias_municipio_outros = array_diff($melhorias_municipio_vistoria, $melhorias_municipio);
        $melhorias_municipio_outros = reset($melhorias_municipio_outros);

        $revestimentos_externo = RevestExterno::orderBy('tipo_revest')->pluck('tipo_revest')->toArray();
        $revestimentos_externo_vistoria = explode(',', $vistoria->revest_externo);
        $revestimentos_externo_outros = array_diff($revestimentos_externo_vistoria, $revestimentos_externo);
        $revestimentos_externo_outros = reset($revestimentos_externo_outros);

        $revestimentos_interno = RevestInterno::orderBy('tipo_revest')->pluck('tipo_revest')->toArray();
        $revestimentos_interno_vistoria = explode(',', $vistoria->revest_interno);
        $revestimentos_interno_outros = array_diff($revestimentos_interno_vistoria, $revestimentos_interno);
        $revestimentos_interno_outros = reset($revestimentos_interno_outros);

        $pinturas_externa = PinturaExt::orderBy('tipo_pintura')->pluck('tipo_pintura')->toArray();
        $pinturas_externa_vistoria = explode(',', $vistoria->pintura_ext);
        $pinturas_externa_outros = array_diff($pinturas_externa_vistoria, $pinturas_externa);
        $pinturas_externa_outros = reset($pinturas_externa_outros);

        $pinturas_interna = PinturaInt::orderBy('tipo_pintura')->pluck('tipo_pintura')->toArray();
        $pinturas_interna_vistoria = explode(',', $vistoria->pintura_int);
        $pinturas_interna_outros = array_diff($pinturas_interna_vistoria, $pinturas_interna);
        $pinturas_interna_outros = reset($pinturas_interna_outros);

        $pisos_interno = PisoInterior::orderBy('tipo_piso')->pluck('tipo_piso')->toArray();
        $pisos_interno_vistoria = explode(',', $vistoria->piso_int);
        $pisos_interno_outros = array_diff($pisos_interno_vistoria, $pisos_interno);
        $pisos_interno_outros = reset($pisos_interno_outros);

        $pisos_externo = PisoExterior::orderBy('tipo_piso')->pluck('tipo_piso')->toArray();
        $pisos_externo_vistoria = explode(',', $vistoria->piso_ext);
        $pisos_externo_outros = array_diff($pisos_externo_vistoria, $pisos_externo);
        $pisos_externo_outros = reset($pisos_externo_outros);

        $forros = Forro::orderBy('descricao')->pluck('descricao')->toArray();
        $forros_vistoria = explode(',', $vistoria->forro);
        $forros_outros = array_diff($forros_vistoria, $forros);
        $forros_outros = reset($forros_outros);

        $esquadrias_porta = EsquadriaPorta::orderBy('descricao')->pluck('descricao')->toArray();
        $esquadrias_porta_vistoria = explode(',', $vistoria->esquadria_porta);
        $esquadrias_porta_outros = array_diff($esquadrias_porta_vistoria, $esquadrias_porta);
        $esquadrias_porta_outros = reset($esquadrias_porta_outros);

        $esquadrias_janela = EsquadriaJanela::orderBy('descricao')->pluck('descricao')->toArray();
        $esquadrias_janela_vistoria = explode(',', $vistoria->esquadria_janela);
        $esquadrias_janela_outros = array_diff($esquadrias_janela_vistoria, $esquadrias_janela);
        $esquadrias_janela_outros = reset($esquadrias_janela_outros);

        $pinturas_esquadria = PinturaEsquadria::orderBy('descricao')->pluck('descricao')->toArray();
        $pinturas_esquadria_vistoria = explode(',', $vistoria->pintura_esquadria);
        $pinturas_esquadria_outros = array_diff($pinturas_esquadria_vistoria, $pinturas_esquadria);
        $pinturas_esquadria_outros = reset($pinturas_esquadria_outros);

        $instalacoes_eletrica = InstalEletrica::orderBy('descricao')->pluck('descricao')->toArray();
        $instalacoes_eletrica_vistoria = explode(',', $vistoria->instal_eletrica);
        $instalacoes_eletrica_outros = array_diff($instalacoes_eletrica_vistoria, $instalacoes_eletrica);
        $instalacoes_eletrica_outros = reset($instalacoes_eletrica_outros);

        $instalacoes_sanitaria = InstalSanitaria::orderBy('descricao')->pluck('descricao')->toArray();
        $instalacoes_sanitaria_vistoria = explode(',', $vistoria->instal_sanitaria);
        $instalacoes_sanitaria_outros = array_diff($instalacoes_sanitaria_vistoria, $instalacoes_sanitaria);
        $instalacoes_sanitaria_outros = reset($instalacoes_sanitaria_outros);

        $estruturas = Estrutura::orderBy('descricao')->pluck('descricao')->toArray();
        $estruturas_vistoria = explode(',', $vistoria->estrutura);
        $estruturas_outros = array_diff($estruturas_vistoria, $estruturas);
        $estruturas_outros = reset($estruturas_outros);

        $estruturas_telhado = EstruturaTelhado::orderBy('descricao')->pluck('descricao')->toArray();
        $estruturas_telhado_vistoria = explode(',', $vistoria->estrutura_telhado);
        $estruturas_telhado_outros = array_diff($estruturas_telhado_vistoria, $estruturas_telhado);
        $estruturas_telhado_outros = reset($estruturas_telhado_outros);

        $coberturas = Cobertura::orderBy('descricao')->pluck('descricao')->toArray();
        $coberturas_vistoria = explode(',', $vistoria->cobertura);
        $coberturas_outros = array_diff($coberturas_vistoria, $coberturas);
        $coberturas_outros = reset($coberturas_outros);

        $elevadores = Elevador::orderBy('descricao')->pluck('descricao')->toArray();
        $elevadores_vistoria = explode(',', $vistoria->elevador);
        $elevadores_outros = array_diff($elevadores_vistoria, $elevadores);
        $elevadores_outros = reset($elevadores_outros);

        $situacoes_construcao = SituacaoConstrucao::orderBy('descricao')->pluck('descricao')->toArray();
        $situacoes_construcao_vistoria = explode(',', $vistoria->situacao_construcao);
        $situacoes_construcao_outros = array_diff($situacoes_construcao_vistoria, $situacoes_construcao);
        $situacoes_construcao_outros = reset($situacoes_construcao_outros);

        $localizacoes_vertical = LocalizacaoVertical::orderBy('descricao')->pluck('descricao')->toArray();
        $localizacoes_vertical_vistoria = explode(',', $vistoria->localizacao_vertical);
        $localizacoes_vertical_outros = array_diff($localizacoes_vertical_vistoria, $localizacoes_vertical);
        $localizacoes_vertical_outros = reset($localizacoes_vertical_outros);

        $acabamentos = Acabamento::orderBy('descricao')->pluck('descricao')->toArray();
        $acabamentos_vistoria = explode(',', $vistoria->acabamentos);
        $acabamentos_outros = array_diff($acabamentos_vistoria, $acabamentos);
        $acabamentos_outros = reset($acabamentos_outros);

        $casas_alinhada = CasaAlinhada::orderBy('descricao')->pluck('descricao')->toArray();
        $casas_alinhada_vistoria = explode(',', $vistoria->casa_alinhada);
        $casas_alinhada_outros = array_diff($casas_alinhada_vistoria, $casas_alinhada);
        $casas_alinhada_outros = reset($casas_alinhada_outros);

        $casas_recuada = CasaRecuada::orderBy('descricao')->pluck('descricao')->toArray();
        $casas_recuada_vistoria = explode(',', $vistoria->casa_recuada);
        $casas_recuada_outros = array_diff($casas_recuada_vistoria, $casas_recuada);
        $casas_recuada_outros = reset($casas_recuada_outros);

        $escritorios = Escritorio::orderBy('descricao')->pluck('descricao')->toArray();
        $escritorios_vistoria = explode(',', $vistoria->escritorio);
        $escritorios_outros = array_diff($escritorios_vistoria, $escritorios);
        $escritorios_outros = reset($escritorios_outros);

        $comercios = Comercio::orderBy('descricao')->pluck('descricao')->toArray();
        $comercios_vistoria = explode(',', $vistoria->comercio);
        $comercios_outros = array_diff($comercios_vistoria, $comercios);
        $comercios_outros = reset($comercios_outros);

        $estados_conservacao = EstadoConservacao::orderBy('descricao')->pluck('descricao')->toArray();
        $estados_conservacao_vistoria = explode(',', $vistoria->estado_conservacao);
        $estados_conservacao_outros = array_diff($estados_conservacao_vistoria, $estados_conservacao);
        $estados_conservacao_outros = reset($estados_conservacao_outros);

        $categorias = Categoria::orderBy('descricao')->pluck('descricao')->toArray();
        $categorias_vistoria = explode(',', $vistoria->categorias);
        $categorias_outros = array_diff($categorias_vistoria, $categorias);
        $categorias_outros = reset($categorias_outros);

        $formas = FormaTerreno::orderBy('descricao')->pluck('descricao')->toArray();
        $formas_vistoria = explode(',', $vistoria->forma_terreno);
        $formas_outros = array_diff($formas_vistoria, $formas);
        $formas_outros = reset($formas_outros);

        $situacoes = SituacaoTerreno::orderBy('descricao')->pluck('descricao')->toArray();
        $situacoes_vistoria = explode(',', $vistoria->situacao_terreno);
        $situacoes_outros = array_diff($situacoes_vistoria, $situacoes);
        $situacoes_outros = reset($situacoes_outros);

        $usos_terreno = UsoTerreno::orderBy('descricao')->pluck('descricao')->toArray();
        $usos_terreno_vistoria = explode(',', $vistoria->uso_terreno);
        $usos_terreno_outros = array_diff($usos_terreno_vistoria, $usos_terreno);
        $usos_terreno_outros = reset($usos_terreno_outros);

        $protecoes_calcada = ProtecaoCalcada::orderBy('descricao')->pluck('descricao')->toArray();
        $protecoes_calcada_vistoria = explode(',', $vistoria->protecao_calcada);
        $protecoes_calcada_outros = array_diff($protecoes_calcada_vistoria, $protecoes_calcada);
        $protecoes_calcada_outros = reset($protecoes_calcada_outros);

        $pedologias = PedologiaTerreno::orderBy('descricao')->pluck('descricao')->toArray();
        $pedologias_vistoria = explode(',', $vistoria->pedologia_terreno);
        $pedologias_outros = array_diff($pedologias_vistoria, $pedologias);
        $pedologias_outros = reset($pedologias_outros);

        $topografias = TopografiaTerreno::orderBy('descricao')->pluck('descricao')->toArray();
        $topografias_vistoria = explode(',', $vistoria->topografia_terreno);
        $topografias_outros = array_diff($topografias_vistoria, $topografias);
        $topografias_outros = reset($topografias_outros);

        return view('vistoriaObras.details', compact('title', 'vistoria',
            'categorias_proprietario', 'numeros_pavimento',
            'categorias_uso', 'abastecimentos_agua', 'servicos_esgoto', 'servicos_rede_eletrica',
            'melhorias_municipio', 'revestimentos_externo', 'revestimentos_interno', 'pinturas_externa',
            'pinturas_interna', 'pisos_interno', 'pisos_externo', 'forros', 'esquadrias_porta',
            'esquadrias_janela', 'pinturas_esquadria', 'instalacoes_eletrica', 'instalacoes_sanitaria',
            'estruturas', 'estruturas_telhado', 'coberturas', 'elevadores', 'situacoes_construcao',
            'localizacoes_vertical', 'acabamentos', 'casas_alinhada', 'casas_recuada', 'escritorios',
            'comercios', 'estados_conservacao', 'categorias', 'formas', 'situacoes', 'usos_terreno',
            'protecoes_calcada', 'pedologias', 'topografias',

            'categorias_proprietario_outros', 'numeros_pavimento_outros', 'categorias_uso_outros', 'abastecimentos_agua_outros', 'servicos_esgoto_outros',
            'servicos_rede_eletrica_outros', 'melhorias_municipio_outros', 'revestimentos_externo_outros',
            'revestimentos_interno_outros', 'pinturas_externa_outros', 'pinturas_interna_outros',
            'pisos_interno_outros', 'pisos_externo_outros', 'forros_outros', 'esquadrias_porta_outros',
            'esquadrias_janela_outros', 'pinturas_esquadria_outros', 'instalacoes_eletrica_outros',
            'instalacoes_sanitaria_outros', 'estruturas_outros', 'estruturas_telhado_outros',
            'coberturas_outros', 'elevadores_outros', 'situacoes_construcao_outros',
            'localizacoes_vertical_outros', 'acabamentos_outros', 'casas_alinhada_outros',
            'casas_recuada_outros', 'escritorios_outros', 'comercios_outros', 'estados_conservacao_outros',
            'categorias_outros', 'formas_outros', 'situacoes_outros', 'usos_terreno_outros',
            'protecoes_calcada_outros', 'pedologias_outros', 'topografias_outros',

            'categorias_proprietario_vistoria', 'numeros_pavimento_vistoria', 'categorias_uso_vistoria', 'abastecimentos_agua_vistoria',
            'servicos_esgoto_vistoria', 'servicos_rede_eletrica_vistoria', 'melhorias_municipio_vistoria', 'revestimentos_externo_vistoria',
            'revestimentos_interno_vistoria', 'pinturas_externa_vistoria', 'pinturas_interna_vistoria', 'pisos_interno_vistoria',
            'pisos_externo_vistoria', 'forros_vistoria', 'esquadrias_porta_vistoria', 'esquadrias_janela_vistoria',
            'pinturas_esquadria_vistoria', 'instalacoes_eletrica_vistoria', 'instalacoes_sanitaria_vistoria', 'estruturas_vistoria',
            'estruturas_telhado_vistoria', 'coberturas_vistoria', 'elevadores_vistoria', 'situacoes_construcao_vistoria',
            'localizacoes_vertical_vistoria', 'acabamentos_vistoria', 'casas_alinhada_vistoria', 'casas_recuada_vistoria',
            'escritorios_vistoria', 'comercios_vistoria', 'estados_conservacao_vistoria', 'categorias_vistoria', 'formas_vistoria',
            'situacoes_vistoria', 'usos_terreno_vistoria', 'protecoes_calcada_vistoria', 'pedologias_vistoria', 'topografias_vistoria'
        ));
    }
}
