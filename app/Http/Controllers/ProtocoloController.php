<?php

namespace App\Http\Controllers;

use App\Http\Requests\protocoloFormRequest;
use App\Mail\Notificate;
use App\Models\AbastecimentoAgua;
use App\Models\Acabamento;
use App\Models\assunto;
use App\Models\CasaAlinhada;
use App\Models\CasaRecuada;
use App\Models\Categoria;
use App\Models\CategoriaProprietario;
use App\Models\CategoriaUso;
use App\Models\Cobertura;
use App\Models\Comercio;
use App\Models\documentoAnexado;
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
use App\Models\lote;
use App\Models\Melhorias;
use App\Models\NumeroPavimento;
use App\Models\PedologiaTerreno;
use App\Models\PinturaEsquadria;
use App\Models\PinturaExt;
use App\Models\PinturaInt;
use App\Models\PisoExterior;
use App\Models\PisoInterior;
use App\Models\ProtecaoCalcada;
use App\Models\protocolo;
use App\Models\responsavel;
use App\Models\RevestExterno;
use App\Models\RevestInterno;
use App\Models\rua;
use App\Models\ServicoEsgoto;
use App\Models\ServicoRedeEletrica;
use App\Models\setor;
use App\Models\setoresBairrosRuasLotes;
use App\Models\setorProtocolo;
use App\Models\SituacaoConstrucao;
use App\Models\SituacaoTerreno;
use App\Models\status;
use App\Models\TopografiaTerreno;
use App\Models\UsoTerreno;
use App\Models\VistoriaObras;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class ProtocoloController extends Controller
{
    private $protocolo;
    private $status;
    private $assunto;
    private $qtdShow = 20;
    private $anexos;
    private $setores;
    private $lotes;
    private $ruas;
    private $setBaiRuaLot;
    private $setorProtocolo;
    private $responsavel;

    public function __construct(
        protocolo $protocolo,
        status $status,
        assunto $assunto,
        documentoAnexado $documentoAnexado,
        setor $setores,
        lote $lotes,
        rua $ruas,
        setoresBairrosRuasLotes $setoresBairrosRuasLotes,
        setorProtocolo $setorProtocolo,
        responsavel $responsavel
    ) {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
        $this->protocolo = $protocolo;
        $this->status = $status;
        $this->assunto = $assunto;
        $this->anexos = $documentoAnexado;
        $this->setores = $setores;
        $this->lotes = $lotes;
        $this->ruas = $ruas;
        $this->setBaiRuaLot = $setoresBairrosRuasLotes;
        $this->setorProtocolo = $setorProtocolo;
        $this->responsavel = $responsavel;
    }

    public function index(Request $request)
    {
        $title = 'Listagem de Protocolos';

        $anexos = $this->anexos->all();

        $filter = $request->get('filter');

        $protocolos = $this->protocolo->select('protocolos.*', 'status.cor')
            ->leftJoin('status', 'status.nome', '=', 'protocolos.status');
        if ($filter) {
            $protocolos = $protocolos->where('l', 'LIKE', "%$filter%")
                ->orWhere('proprietario', 'LIKE', "%$filter%")
                ->orWhere('endereco', 'LIKE', "%$filter%")
                ->orWhere('responsavel', 'LIKE', "%$filter%")
                ->orWhere('assunto', 'LIKE', "%$filter")
                ->orWhereRaw("concat(setor, '-', quadra, '-', lote) LIKE '%{$filter}%'");
        }
        $protocolos = $protocolos
            ->orderByDesc('created_at')
            ->paginate($this->qtdShow);

        $setoresProtocolo = $this->setorProtocolo->all();

        return view('protocolo.index', compact('protocolos', 'title', 'anexos', 'setoresProtocolo'));
    }

    public function create()
    {
        $title = "Cadastrar Protocolo";
        $setoresProtocolo = $this->setorProtocolo->all();

        return view("protocolo.create", compact('title', 'setoresProtocolo'));
    }

    public function edit($idProtocolo)
    {
        $protocolo = $this->protocolo->find($idProtocolo);

        $status = $this->status->all();
        $assuntos = $this->assunto->all();
        $setores = $this->setores->all();
        $lotes = $this->lotes->all();
        $ruas = $this->ruas->all();
        $setoresProtocolo = $this->setorProtocolo->all();
        $responsaveis = $this->responsavel->all();

        $title = "Editar Protocolo: {$protocolo->l}";

        return view('protocolo.create', compact('title', 'protocolo', 'status', 'assuntos', 'setores', 'lotes', 'ruas', 'setoresProtocolo', 'responsaveis'));
    }

    public function store(protocoloFormRequest $request)
    {
        $dataForm = $request->all();

        $insert = $this->protocolo->create($dataForm);

        if ($insert) {
            return redirect()->route('indexProtocolo');
        } else {
            return redirect()->back();
        }
    }

    public function update(Request $request, $idProtocolo)
    {
        $dataForm = $request->all();
        $protocolo = $this->protocolo->find($idProtocolo);

         //verifica o checkbox
        $dataForm['dt'] = (!isset($dataForm['dt'])) ? 0 : 1;

         //substitui a vírgula por ponto no campo M2
        if (isset($dataForm['m2'])) {
            $stringM2 = (str_replace(',', '.', $dataForm['m2']));
            $dataForm['m2'] = (double)$stringM2;
        }

         //substitui a vírgula por ponto no campo Taxa
        if (isset($dataForm['taxa'])) {
            $stringTaxa = (str_replace(',', '.', $dataForm['taxa']));
            $dataForm['taxa'] = (double)$stringTaxa;
        }

         //verifica se existe cômodo
//        if (isset($dataForm['comodos']))
//        {
//            if ($dataForm['comodos'] == 0) {
//                $dataForm['comodos'] = "";
//            }
//        }

        $update = $protocolo->update($dataForm);

        if (isset($dataForm['enviar_email'])) {
            $this->enviaEmail($protocolo);
        }

        if ($update) {
            return redirect()->route('indexProtocolo');
        } else {
            return redirect()->route('editProtocolo', $idProtocolo)->with(['errors' => 'Falha ao editar']);
        }
    }

    public function getNumerosCasas()
    {
        return json_encode(
            DB::select(
                DB::raw(
                    "SELECT DISTINCT `setores_bairros_ruas_lotes`.`numero` 
                        FROM `setores_bairros_ruas_lotes`  
                        WHERE `rua_id` = ?
                        ORDER BY numero"
                ),
                array(
                    request()->get('endereco')
                )
            )
        );
    }

    public function getQuadrasCasas()
    {
        return json_encode(
            DB::select(
                DB::raw(
                    "SELECT DISTINCT SUBSTRING(set_quad_lot_sub, 4, 3) as nome
                            FROM setores_bairros_ruas_lotes"
                ),
                array()
            )
        );
    }

    public function insertStatusFromModal()
    {
        $nome = \request()->get('nome');
        $data = Carbon::now();
        $id = DB::table('status')->insertGetId([
            'nome' => $nome,
            'created_at' => $data,
            'updated_at' => $data
        ]);

        return $id;
    }

    public function getStatus()
    {
        return json_encode(
            DB::select(
                DB::raw(
                    "SELECT nome, id FROM status"
                ),
                array()
            )
        );
    }

    public function insertResponsavelFromModal()
    {
        $nome = \request()->get('nome');
        $email = \request()->get('email');
        $data = Carbon::now();
        $id = DB::table('responsaveis')->insertGetId([
            'nome' => $nome,
            'email' => $email,
            'created_at' => $data,
            'updated_at' => $data
        ]);

        return $id;
    }

    public function getResponsavel()
    {
        return json_encode(
            DB::select(
                DB::raw(
                    "SELECT nome, id, email FROM responsaveis"
                ),
                array()
            )
        );
    }

    public function getSetQuadLot()
    {
        $rua = \request()->get('rua_id');
        $numero = \request()->get('numero');
        return
            DB::select(
            DB::raw(
                "select DISTINCT 
                            SUBSTRING(set_quad_lot_sub, 1, 10) as extract_string 
                           from setores_bairros_ruas_lotes 
                           where rua_id = ? and numero = ?"
            ),
            array(
                $rua,
                $numero
            )
        );
    }

    public function enviaEmail($protocolo)
    {        
        //FUNCIONALIDADE DE ENVIAR EMAIL AO RESPONSÁVEL PELO PROTOCOLO
        $dados = [
            'numero' => $protocolo->l,
            'nome' => $protocolo->proprietario,
            'endereco_rua' => $protocolo->endereco,
            'endereco_numero' => $protocolo->numero,
            'sql' => $protocolo->setor . '-' . $protocolo->quadra . '-' . $protocolo->lote,
            'obs' => $protocolo->observacaoStatus
        ];

        $template = '';
        $email = '';

        if (preg_match('/^Emitido*/', $protocolo->status)) {
            if ($protocolo->proprietario_email) {
                $email = $protocolo->proprietario_email;
                $dados['assunto'] = $protocolo->assunto;
                $template = 'emitido';
                \Mail::to($email)
                    ->send(new Notificate($dados, $template));
            }
        } else {
            if ($protocolo->responsavel_email) {
                $email = $protocolo->responsavel_email;

                if ((preg_match('/^Comunique*/', $protocolo->status))) {
                    $template = 'comuniquese';
                } else if ((preg_match('/^Pendencia de Análise*/', $protocolo->status)) || (preg_match('/^Pendencia de Analise*/', $protocolo->status)) || (preg_match('/^Pendência de Análise*/', $protocolo->status)) || (preg_match('/^Pendência de Analise*/', $protocolo->status))) {
                    $template = 'pendenciaAnalise';
                } else if ((preg_match('/^Pendencia de Vistoria*/', $protocolo->status)) || (preg_match('/^Pendência de Vistoria*/', $protocolo->status))) {
                    $template = 'pendenciaVistoria';
                } else if ((preg_match('/^Aprovado*/', $protocolo->status)) || (preg_match('/^Vistado*/', $protocolo->status))) {
                    $dados['status'] = $protocolo->status;
                    $template = 'aprovado';
                }
                \Mail::to($email)
                    ->send(new Notificate($dados, $template));
            }
        }

    }

    public function getVistoriaByProtocolo()
    {
        $protocolo_id = request()->get('protocolo_id');
        $vistoria = VistoriaObras::where('protocolo_id', '=', $protocolo_id)
            ->get();

        if (count($vistoria) > 0)   return json_encode(['status' => 'true']);
        else                        return json_encode(['status' => 'false']);
    }

    public function openVistoriaProtocolo($protocolo_id)
    {
        $title = 'Relatório Vistoria Obras';
        $vistoria = VistoriaObras::where('protocolo_id', '=', $protocolo_id)
            ->orderByDesc('data_inspecao')
            ->first();

        //Itens para popular as categorias do relatorio
        $categorias_proprietario = CategoriaProprietario::orderBy('tipo_categoria')->pluck('tipo_categoria')->toArray();
        $categorias_proprietario_outros = !in_array($vistoria->cat_proprietario, $categorias_proprietario);

        $numeros_pavimento = NumeroPavimento::orderBy('tipo_pavimento')->pluck('tipo_pavimento')->toArray();
        $numeros_pavimento_outros = !in_array($vistoria->numero_pavimento, $numeros_pavimento);

        $categorias_uso = CategoriaUso::orderBy('tipo_categoria')->pluck('tipo_categoria')->toArray();
        $categorias_uso_outros = !in_array($vistoria->categoria_uso, $categorias_uso);

        $abastecimentos_agua = AbastecimentoAgua::orderBy('tipo_abastecimento')->pluck('tipo_abastecimento')->toArray();
        $abastecimentos_agua_outros = !in_array($vistoria->abastecimento_agua, $abastecimentos_agua);

        $servicos_esgoto = ServicoEsgoto::orderBy('tipo_esgoto')->pluck('tipo_esgoto')->toArray();
        $servicos_esgoto_outros = !in_array($vistoria->servico_esgoto, $servicos_esgoto);

        $servicos_rede_eletrica = ServicoRedeEletrica::orderBy('tipo_rede_eletrica')->pluck('tipo_rede_eletrica')->toArray();
        $servicos_rede_eletrica_outros = !in_array($vistoria->servico_rede_eletrica, $servicos_rede_eletrica);

        $melhorias_municipio = Melhorias::orderBy('tipo_melhoria')->pluck('tipo_melhoria')->toArray();
        $melhorias_municipio_outros = !in_array($vistoria->melhorias, $melhorias_municipio);

        $revestimentos_externo = RevestExterno::orderBy('tipo_revest')->pluck('tipo_revest')->toArray();
        $revestimentos_externo_outros = !in_array($vistoria->revest_externo, $revestimentos_externo);

        $revestimentos_interno = RevestInterno::orderBy('tipo_revest')->pluck('tipo_revest')->toArray();
        $revestimentos_interno_outros = !in_array($vistoria->revest_interno, $revestimentos_interno);

        $pinturas_externa = PinturaExt::orderBy('tipo_pintura')->pluck('tipo_pintura')->toArray();
        $pinturas_externa_outros = !in_array($vistoria->pintura_ext, $pinturas_externa);

        $pinturas_interna = PinturaInt::orderBy('tipo_pintura')->pluck('tipo_pintura')->toArray();
        $pinturas_interna_outros = !in_array($vistoria->pintura_int, $pinturas_interna);

        $pisos_interno = PisoInterior::orderBy('tipo_piso')->pluck('tipo_piso')->toArray();
        $pisos_interno_outros = !in_array($vistoria->piso_int, $pisos_interno);

        $pisos_externo = PisoExterior::orderBy('tipo_piso')->pluck('tipo_piso')->toArray();
        $pisos_externo_outros = !in_array($vistoria->piso_ext, $pisos_externo);

        $forros = Forro::orderBy('descricao')->pluck('descricao')->toArray();
        $forros_outros = !in_array($vistoria->forro, $forros);

        $esquadrias_porta = EsquadriaPorta::orderBy('descricao')->pluck('descricao')->toArray();
        $esquadrias_porta_outros = !in_array($vistoria->esquadria_porta, $esquadrias_porta);

        $esquadrias_janela = EsquadriaJanela::orderBy('descricao')->pluck('descricao')->toArray();
        $esquadrias_janela_outros = !in_array($vistoria->esquadria_janela, $esquadrias_janela);

        $pinturas_esquadria = PinturaEsquadria::orderBy('descricao')->pluck('descricao')->toArray();
        $pinturas_esquadria_outros = !in_array($vistoria->pintura_esquadria, $pinturas_esquadria);

        $instalacoes_eletrica = InstalEletrica::orderBy('descricao')->pluck('descricao')->toArray();
        $instalacoes_eletrica_outros = !in_array($vistoria->instal_eletrica, $instalacoes_eletrica);

        $instalacoes_sanitaria = InstalSanitaria::orderBy('descricao')->pluck('descricao')->toArray();
        $instalacoes_sanitaria_outros = !in_array($vistoria->instal_sanitaria, $instalacoes_sanitaria);

        $estruturas = Estrutura::orderBy('descricao')->pluck('descricao')->toArray();
        $estruturas_outros = !in_array($vistoria->estrutura, $estruturas);

        $estruturas_telhado = EstruturaTelhado::orderBy('descricao')->pluck('descricao')->toArray();
        $estruturas_telhado_outros = !in_array($vistoria->estrutura_telhado, $estruturas_telhado);

        $coberturas = Cobertura::orderBy('descricao')->pluck('descricao')->toArray();
        $coberturas_outros = !in_array($vistoria->cobertura, $coberturas);

        $elevadores = Elevador::orderBy('descricao')->pluck('descricao')->toArray();
        $elevadores_outros = !in_array($vistoria->elevador, $elevadores);

        $situacoes_construcao = SituacaoConstrucao::orderBy('descricao')->pluck('descricao')->toArray();
        $situacoes_construcao_outros = !in_array($vistoria->situacao_construcao, $situacoes_construcao);

        $localizacoes_vertical = LocalizacaoVertical::orderBy('descricao')->pluck('descricao')->toArray();
        $localizacoes_vertical_outros = !in_array($vistoria->localizacao_vertical, $localizacoes_vertical);

        $acabamentos = Acabamento::orderBy('descricao')->pluck('descricao')->toArray();
        $acabamentos_outros = !in_array($vistoria->acabamentos, $acabamentos);

        $casas_alinhada = CasaAlinhada::orderBy('descricao')->pluck('descricao')->toArray();
        $casas_alinhada_outros = !in_array($vistoria->casa_alinhada, $casas_alinhada);

        $casas_recuada = CasaRecuada::orderBy('descricao')->pluck('descricao')->toArray();
        $casas_recuada_outros = !in_array($vistoria->casa_recuada, $casas_recuada);

        $escritorios = Escritorio::orderBy('descricao')->pluck('descricao')->toArray();
        $escritorios_outros = !in_array($vistoria->escritorio, $escritorios);

        $comercios = Comercio::orderBy('descricao')->pluck('descricao')->toArray();
        $comercios_outros = !in_array($vistoria->comercio, $comercios);

        $estados_conservacao = EstadoConservacao::orderBy('descricao')->pluck('descricao')->toArray();
        $estados_conservacao_outros = !in_array($vistoria->estado_conservacao, $estados_conservacao);

        $categorias = Categoria::orderBy('descricao')->pluck('descricao')->toArray();
        $categorias_outros = !in_array($vistoria->categorias, $categorias);

        $formas = FormaTerreno::orderBy('descricao')->pluck('descricao')->toArray();
        $formas_outros = !in_array($vistoria->forma_terreno, $formas);

        $situacoes = SituacaoTerreno::orderBy('descricao')->pluck('descricao')->toArray();
        $situacoes_outros = !in_array($vistoria->situacao_terreno, $situacoes);

        $usos_terreno = UsoTerreno::orderBy('descricao')->pluck('descricao')->toArray();
        $usos_terreno_outros = !in_array($vistoria->uso_terreno, $usos_terreno);

        $protecoes_calcada = ProtecaoCalcada::orderBy('descricao')->pluck('descricao')->toArray();
        $protecoes_calcada_outros = !in_array($vistoria->protecao_calcada, $protecoes_calcada);

        $pedologias = PedologiaTerreno::orderBy('descricao')->pluck('descricao')->toArray();
        $pedologias_outros = !in_array($vistoria->pedologia_terreno, $pedologias);

        $topografias = TopografiaTerreno::orderBy('descricao')->pluck('descricao')->toArray();
        $topografias_outros = !in_array($vistoria->topografia_terreno, $topografias);


        return view('vistoriaObras.details', compact('title', 'vistoria',
            'categorias_proprietario', 'categorias_proprietario_outros', 'numeros_pavimento',
            'categorias_uso', 'abastecimentos_agua', 'servicos_esgoto', 'servicos_rede_eletrica',
            'melhorias_municipio', 'revestimentos_externo', 'revestimentos_interno', 'pinturas_externa',
            'pinturas_interna', 'pisos_interno', 'pisos_externo', 'forros', 'esquadrias_porta',
            'esquadrias_janela', 'pinturas_esquadria', 'instalacoes_eletrica', 'instalacoes_sanitaria',
            'estruturas', 'estruturas_telhado', 'coberturas', 'elevadores', 'situacoes_construcao',
            'localizacoes_vertical', 'acabamentos', 'casas_alinhada', 'casas_recuada', 'escritorios',
            'comercios', 'estados_conservacao', 'categorias', 'formas', 'situacoes', 'usos_terreno',
            'protecoes_calcada', 'pedologias', 'topografias', 'numeros_pavimento_outros',
            'categorias_uso_outros', 'abastecimentos_agua_outros', 'servicos_esgoto_outros',
            'servicos_rede_eletrica_outros', 'melhorias_municipio_outros', 'revestimentos_externo_outros',
            'revestimentos_interno_outros', 'pinturas_externa_outros', 'pinturas_interna_outros',
            'pisos_interno_outros', 'pisos_externo_outros', 'forros_outros', 'esquadrias_porta_outros',
            'esquadrias_janela_outros', 'pinturas_esquadria_outros', 'instalacoes_eletrica_outros',
            'instalacoes_sanitaria_outros', 'estruturas_outros', 'estruturas_telhado_outros',
            'coberturas_outros', 'elevadores_outros', 'situacoes_construcao_outros',
            'localizacoes_vertical_outros', 'acabamentos_outros', 'casas_alinhada_outros',
            'casas_recuada_outros', 'escritorios_outros', 'comercios_outros', 'estados_conservacao_outros',
            'categorias_outros', 'formas_outros', 'situacoes_outros', 'usos_terreno_outros',
            'protecoes_calcada_outros', 'pedologias_outros', 'topografias_outros'
        ));
    }
}
