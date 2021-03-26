<?php

namespace App\Http\Controllers;

use App\Http\Requests\abastecimentoFormRequest;
use App\Models\alocacaoTipoCombustivel;
use App\Models\fornecedorTipoCombustivel;
use App\Models\log_abastecimento_manual;
use App\Models\log_cartao_mestre_abastecimento;
use App\Models\log_edit_abastecimento;
use App\Models\Frentista;
use App\Models\motorista;
use App\Models\postosDeGasolina;
use App\Models\veiculos_cota;
use App\Models\abastecimento;
use App\Models\secretaria;
use App\Models\tipoCombustivel;
use App\Models\veiculo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use App\Models\cartaoMestre;
use Illuminate\Support\Facades\Response;
use Image;

class AbastecimentoController extends Controller
{
    public function __construct(
        veiculo $veiculo,
        secretaria $secretaria,
        abastecimento $abastecimento,
        veiculos_cota $cota,
        motorista $motorista,
        Frentista $frentista,
        tipoCombustivel $tipo_combustivel,
        alocacaoTipoCombustivel $alocacaotipocombustivel,
        fornecedorTipoCombustivel $fornecedorTipoCombustivel,
        log_edit_abastecimento $log_edit_abastecimento,
        cartaoMestre $cartaoMestre,
        log_cartao_mestre_abastecimento $log_cartao_mestre_abastecimento
    ) {
        $this->middleware('auth');
        Session::put('url.intended', URL::current());
        $this->veiculo = $veiculo;
        $this->secretaria = $secretaria;
        $this->abastecimento = $abastecimento;
        $this->cota = $cota;
        $this->motorista = $motorista;
        $this->frentista = $frentista;
        $this->tipo_combustivel = $tipo_combustivel;
        $this->alocacaotipocombustivel = $alocacaotipocombustivel;
        $this->fornecedorTipoCombustivel = $fornecedorTipoCombustivel;
        $this->log_edit_abastecimento = $log_edit_abastecimento;
        $this->cartaoMestre = $cartaoMestre;
        $this->log_cartao_mestre_abastecimento = $log_cartao_mestre_abastecimento;
    }

    function index()
    {
        $title = "Abastecimento Veiculo";
        $postoid = Auth::user()->posto_id;
        $prefeitura = DB::select(
            DB::raw(
                "SELECT *
                        FROM prefeituras
                        LIMIT 1
                        "
            ),
            array()
        );

        if ($postoid == !null) {

            $postoarray = DB::select(
                DB::raw(
                    "SELECT *
                        FROM postos_de_gasolinas
                        WHERE id = ?
                        LIMIT 1
                        "
                ),
                array(
                    $postoid
                )
            );
            $posto = $postoarray[0];

            $tiposCombustivel = fornecedorTipoCombustivel::join('tipo_combustivels', 'tipo_combustivels.id', '=', 'fornecedor_tipo_combustivels.tipo_combustivel_id')
                ->where('fornecedor_tipo_combustivels.posto_id', '=', DB::raw($postoid))->orderBy('descricao')->select('descricao')->get();

            return view('abastecimento.index', compact('title', 'prefeitura', 'posto', 'tiposCombustivel'));
        }

        return view('abastecimento.index', compact('title', 'prefeitura'));
    }

    function getVeiculoAbastecimento(Request $request)
    {
        //arrumar aqui para salvar log cartao mestre se mastercard=1
        $mastercard = $request->get('mastercard');
        $postoid = Auth::user()->posto_id;
        $valorcota = 0;
        $cotadisponivel = 0;
        $title = "Abastecimento Veiculo";
        $fulldate = Carbon::now();
        $codigobarra = $request->get('codigo');

        $motoristas = $this->motorista->all();

        if ($postoid == !null) {
            $frentistas = $this->frentista->where('posto_id', '=', $postoid)->get();
            $postoarray = DB::select(
                DB::raw(
                    "SELECT *
                        FROM postos_de_gasolinas
                        WHERE id = ?
                        LIMIT 1
                        "
                ),
                array(
                    $postoid
                )
            );
            $posto = $postoarray[0];

            $tiposCombustivel = fornecedorTipoCombustivel::join('tipo_combustivels', 'tipo_combustivels.id', '=', 'fornecedor_tipo_combustivels.tipo_combustivel_id')
                ->where('fornecedor_tipo_combustivels.posto_id', '=', DB::raw($postoid))->orderBy('descricao')->select('descricao')->get();
        }
        $veiculoresult = DB::select(
            DB::raw(
                "SELECT veiculos.*, veiculos_cotas.cota_litros
                        FROM veiculos
                        LEFT JOIN veiculos_cotas
                        ON veiculos.id = veiculos_cotas.veiculo_id
                        WHERE codigo_barra = ?
                        LIMIT 1
                        "
            ),
            array(
                $codigobarra
            )
        );

        $prefeitura = DB::select(
            DB::raw(
                "SELECT *
                        FROM prefeituras
                        LIMIT 1
                        "
            ),
            array()
        );

        if ($veiculoresult) {
            $veiculo = $veiculoresult[0];
            if ($veiculo->cota_litros == null) {
                return view('abastecimento.index', compact('title', 'prefeitura', 'mastercard'))->withErrors(['Cota não estipulada para este veículo. Favor Contatar Administração.']);
            }
        } else {
            if ($postoid !== null) {
                return view('abastecimento.index', compact('title', 'prefeitura', 'posto', 'mastercard'))->withErrors(['Código de veículo inválido!']);
            } else {
                return view('abastecimento.index', compact('title', 'prefeitura', 'mastercard'))->withErrors(['Código de veículo inválido!']);
            }
        }

        $cota = DB::select(
            DB::raw(
                "SELECT veiculos.*, veiculos_cotas.cota_litros, veiculos_cotas.cota_litros, veiculos_cotas.mes as cota_mes, veiculos_cotas.ano as cota_ano
                        FROM veiculos
                        INNER JOIN veiculos_cotas
                        ON veiculos.id = veiculos_cotas.veiculo_id
                        WHERE codigo_barra = ?
                        AND veiculos_cotas.mes = ?
                        AND veiculos_cotas.ano = ?
                        "
            ),
            array(
                $codigobarra,
                $fulldate->month,
                $fulldate->year
            )
        );

        $abastecimentos = DB::select(
            DB::raw(
                "SELECT * FROM `abastecimentos`
                        WHERE DATE_FORMAT(data,'%Y') = ?
                        AND DATE_FORMAT(data,'%m') = ?
                        and veiculo_id = ?
                        "
            ),
            array(
                $fulldate->year,
                $fulldate->month,
                $veiculo->id
            )
        );

        foreach ($abastecimentos as $abastecimento) {
            $valorcota = $abastecimento->litros + $valorcota;
        }

        if ($cota == []) {
            if ($postoid !== null) {
                return view('abastecimento.index', compact('veiculo', 'title', 'cotadisponivel', 'cota', 'prefeitura', 'posto', 'mastercard'))->withErrors(['Veiculo sem cota estipulada para este mês!']);
            } else {
                return view('abastecimento.index', compact('veiculo', 'title', 'cotadisponivel', 'cota', 'prefeitura', 'mastercard'))->withErrors(['Veiculo sem cota estipulada para este mês!']);
            }
        }

        $cotadisponivel = $cota[0]->cota_litros - $valorcota;

        // Combustiveis por veiculo
        $alocacaoTipoCombustivel = alocacaoTipoCombustivel::join('tipo_combustivels', 'tipo_combustivels.id', 'alocacaotipocombustivel.tipoCombustivelId')
            ->where('veiculoId', $veiculo->id)->orderBy('descricao')->select('descricao')->get();

        if (count($alocacaoTipoCombustivel) > 0) {
            $tiposCombustivel = $alocacaoTipoCombustivel;
        }

        if ($postoid == !null) {
            return view('abastecimento.index', compact('veiculo', 'title', 'cotadisponivel', 'cota', 'prefeitura', 'posto', 'motoristas', 'tiposCombustivel', 'frentistas', 'mastercard'));
        } else {
            return view('abastecimento.index', compact('veiculo', 'title', 'cotadisponivel', 'cota', 'prefeitura', 'motoristas', 'mastercard'));

        }
    }

    public function getIdVeiculoAbastecimento(Request $request)
    {
        $codigobarra = $request->get('codigoveiculo');
        $veiculoresult = DB::select(
            DB::raw(
                "SELECT veiculos.id
                        FROM veiculos
                        INNER JOIN veiculos_cotas
                        ON veiculos.id = veiculos_cotas.veiculo_id
                        WHERE codigo_barra = ?
                        LIMIT 1
                        "
            ),
            array(
                $codigobarra
            )
        );
        return ($veiculoresult[0]->id);
    }

    public function downloadImagemVeiculo(Request $request)
    {
        $id = $request->all()["veiculo_id"];
        $imagem_veiculo = Veiculo::find($id)->imagem;
        if (isset($imagem_veiculo)) {
            $imagem = Image::make($imagem_veiculo);
            $response = \Response::make($imagem->encode('data-url'));

            return $response;
        }

        return "";
    }

    public function downloadImagemVeiculoPlaca(Request $request)
    {
        $id = $request->all()["veiculo_id"];
        $imagem_placa = Veiculo::find($id)->imagem_placa;
        if (isset($imagem_placa)) {
            $imagem = Image::make($imagem_placa);
            $response = \Response::make($imagem->encode('data-url'));
            return $response;
        }

        return "";
    }

    //tratar ainda salvar o posto id

    public function store(abastecimentoFormRequest $request)
    {
        //
        $mastercard = request()->get('mastercard');
        $title = "Abastecimento Veiculo";
        $cotadisponivel = 0;
        $valorcota = 0;
        $id = $request->get('veiculo_id');
        $dataForm = $request->all();
        $veiculo = $this->veiculo->where('id', '=', $id)->first();
        $dataForm['litros'] = str_replace(',', '.', $dataForm['litros']);
        $dataForm['valor_unitario'] = str_replace(',', '.', $dataForm['valor_unitario']);
        $dataForm['data'] = Carbon::now();
        $dataForm['frentista_nome'] = $request->get('frentista');
        $fulldate = Carbon::now();

        $cota = DB::select(
            DB::raw(
                "SELECT  *
                        FROM veiculos_cotas
                        WHERE veiculo_id = ?
                        AND mes = ?
                        AND ano = ?
                        "
            ),
            array(
                $id,
                $fulldate->month,
                $fulldate->year
            )
        );

        $abastecimentos = DB::select(
            DB::raw(
                "SELECT * FROM `abastecimentos`
                        WHERE DATE_FORMAT(data,'%Y') = ?
                        AND DATE_FORMAT(data,'%m') = ?
                        AND veiculo_id = ?
                        "
            ),
            array(
                $fulldate->year,
                $fulldate->month,
                $id
            )
        );

        foreach ($abastecimentos as $abastecimento) {
            $valorcota = $abastecimento->litros + $valorcota;
        }

        $cotadisponivel = $cota[0]->cota_litros - $valorcota;

        if ($cotadisponivel >= $request->get('litros')) {
            $insert = $this->abastecimento->create($dataForm);
            if ($insert) {
                if ($mastercard) {
                    $dataformlog = [
                        'abastecimento_id' => $insert->id,
                        'cartao_mestre_id' => $mastercard
                    ];
                    $this->log_cartao_mestre_abastecimento->create($dataformlog);
                }
                return redirect()->route('abastecimento.index');
            } else {
                return redirect()->back()->withErrors();
            }
        } else {
            return redirect()->back()->withErrors(['Quantidade de litros supera a cota disponivel!']);
        }
    }

    function getMotoristaCredencial(Request $request)
    {
        $nome = $request->get('motorista');

        $motorista = DB::select(
            DB::raw(
                "SELECT * FROM `motoristas`
                        WHERE nome = ?
                        LIMIT 1"
            ),
            array(
                $nome
            )
        );
        if ($motorista) {
            if ($motorista[0]->senha) {

                return ("temsenha");
            } else {
                return ("naotemsenha");
            }
        }
    }

    function getFrentistaCredencial(Request $request)
    {
        $nome = $request->get('frentista');

        $frentista = DB::select(
            DB::raw(
                "SELECT * FROM `frentistas`
                        WHERE nome = ?
                        LIMIT 1"
            ),
            array(
                $nome
            )
        );
        if ($frentista) {
            if ($frentista[0]->senha) {

                return ("temsenha");
            } else {
                return ("naotemsenha");
            }
        }
    }

    function getMotoristaExistente(Request $request)
    {
        $nome = $request->get('motorista');

        $motorista = DB::select(
            DB::raw(
                "SELECT * FROM `motoristas`
                        WHERE nome = ?
                        LIMIT 1"
            ),
            array(
                $nome
            )
        );
        if ($motorista) {
            return 1;
        } else {
            return 0;
        }
    }

    function motoristaSenhaStore(Request $request)
    {
        $senha = $request->get('senha');
        $motoristanome = $request->get('motorista');
        $motorista = $this->motorista->where('nome', '=', $motoristanome)->first();
        $motorista['senha'] = $senha;
        $verify = $motorista->save();

        if ($verify) {
            return "Senha cadastrada com sucesso! Volume autorizado!";
        } else {
            return "Erro ao salvar a senha";
        }
    }

    function frentistaSenhaStore(Request $request)
    {
        $senha = $request->get('senha');
        $frentistanome = $request->get('frentista');
        $frentista = $this->frentista->where('nome', '=', $frentistanome)->first();
        $frentista['senha'] = $senha;
        $verify = $frentista->save();

        if ($verify) {
            return "Senha cadastrada com sucesso! Volume autorizado!";
        } else {
            return "Erro ao salvar a senha";
        }
    }

    function motoristaSenhaCheck(Request $request)
    {
        $senha = $request->get('senha');
        $motoristanome = $request->get('motorista');
        $motorista = $this->motorista->where([['nome', '=', $motoristanome], ['senha', '=', $senha]])->first();

        if ($motorista) {
            return "Senha Valida";
        } else {
            return "Senha Invalida";
        }
    }

    function frentistaSenhaCheck(Request $request)
    {
        $senha = $request->get('senha');
        $frentistanome = $request->get('frentista');
        $frentista = $this->frentista->where([['nome', '=', $frentistanome], ['senha', '=', $senha]])->first();

        if ($frentista) {
            return "Senha Valida";
        } else {
            return "Senha Invalida";
        }
    }
    function consultaCartaoMestre()
    {
        $cartaomestre = $this->cartaoMestre->where('numero', '=', request()->get('cartaomestre'))->first();

        if ($cartaomestre) {
            return $cartaomestre;
        } else {
            return "Cartão Invalido";
        }
    }

    function getKilometragem(Request $request)
    {
        $codigo = $request->get('veiculo_codigo');
        $abastecimento = DB::select(
            DB::raw(
                "SELECT abastecimentos.kilometragem
                FROM `abastecimentos`
                INNER JOIN veiculos
                ON veiculos.id = abastecimentos.veiculo_id
                WHERE veiculos.codigo_barra = ?
                ORDER BY abastecimentos.data DESC
                LIMIT 1"
            ),
            array(
                $codigo
            )
        );
        return (json_encode($abastecimento));
    }

    public function getUltimoAbastecimento()
    {
//        $ultAbast = DB::table('abastecimentos')
//            ->join('veiculos', 'veiculos.id', '=', 'abastecimentos.veiculo_id')
//            ->whereRaw('veiculos.id = ?', [request()->get('veiculo_id')])
//            ->orderByRaw('abastecimentos.data DESC LIMIT 1')
//            ->select('abastecimentos.kilometragem', 'veiculos.id as veiculo_id', 'abastecimentos.data', 'abastecimentos.tipo_combustivel', 'abastecimentos.posto_id')
//            ->get();
        $ultAbast = $this->abastecimento->where('id', request()->get('abastecimento_id'))->get();
        $veiculos = DB::table('veiculos')->select('veiculos.id as veiculo_id', 'veiculos.placa as veiculo_placa', 'tipo_veiculos.nome as veiculo_modelo')
            ->join('tipo_veiculos', 'veiculos.id_tipo_veiculo', '=', 'tipo_veiculos.id')->get();
        $tipocombustivel = $this->tipo_combustivel->all();
        $tipocombustpossivel = $this->alocacaotipocombustivel->where('veiculoId', '=', [request()->get('veiculo_id')])->get();


        if (count($tipocombustpossivel) > 0) {
            $query['tipocombustivel'] = $tipocombustpossivel;
        } else {
            $query['tipocombustivel'] = $this->fornecedorTipoCombustivel->join('tipo_combustivels', 'tipo_combustivels.id', '=', 'fornecedor_tipo_combustivels.tipo_combustivel_id')
                ->where('posto_id', '=', $ultAbast[0]->posto_id)->get();
        }
        $query['abastecimento'] = $ultAbast;
        $query['veiculos'] = $veiculos;
        $query['tipocombustivel'] = $tipocombustivel;

        return $query;
    }

    public function updateKilometro()
    {
        $kilometragem = request()->get('kilometragem');
        $abastecimento = DB::table('abastecimentos')
            ->join('veiculos', 'veiculos.id', '=', 'abastecimentos.veiculo_id')
            ->whereRaw('veiculos.id = ?', [request()->get('veiculo_id')])
            ->orderByRaw('abastecimentos.data DESC LIMIT 1')->select('abastecimentos.*')->get();

        $abast_update = $this->abastecimento->find($abastecimento[0]->id);

        $dataForm = ['kilometragem' => $kilometragem];
        $abast_update->update($dataForm);

        return ("foi");
    }

    public function getVeiculoEquipamento()
    {
        $veiculoespecial = DB::table('veiculos')
            ->select('veiculos.modelo')
            ->whereRaw('veiculos.codigo_barra = ?', [request()->get('veiculo_codigo')])
            ->get();
        //dd($veiculoespecial);
        return $veiculoespecial;
    }

    public function updateUltimoAbastecimento()
    {
        //dd(request()->get('veiculo_id_consulta'),request()->get('kilometragem'),
        //request()->get('combustivel'),request()->get('veiculo_id'));
        $userid = Auth::user()->id;
        $datanow = Carbon::now();
        $kilometragem = request()->get('kilometragem');
        $litragem = request()->get('litragem');
        $veiculo = request()->get('veiculo_id');
        $tipo_combustivel = request()->get('combustivel');
//        $abastecimento = DB::table('abastecimentos')
//            ->join('veiculos', 'veiculos.id', '=', 'abastecimentos.veiculo_id')
//            ->whereRaw('veiculos.id = ?', [request()->get('veiculo_id_consulta')])
//            ->orderByRaw('abastecimentos.data DESC LIMIT 1')->select('abastecimentos.*')->get();
        $abastecimento = $this->abastecimento->where('id', request()->get('abastecimento_id'))->get();

        $abast_update = $this->abastecimento->find($abastecimento[0]->id);

        $dataform_log = [
            'data_alteracao' => $datanow,
            'abastecimento_id' => $abast_update->id,
            'user_id' => $userid,
            'veiculo_id' => $abast_update->veiculo_id,
            'motorista' => $abast_update->motorista,
            'tipo_combustivel' => $abast_update->tipo_combustivel,
            'valor_unitario' => $abast_update->valor_unitario,
            'litros' => $litragem,
            'kilometragem' => $abast_update->kilometragem,
            'posto_id' => $abast_update->posto_id,
            'frentista_nome' => $abast_update->frentista_nome,
            'data_abastecimento' => $abast_update->data
        ];

        $this->log_edit_abastecimento->create($dataform_log);

        $dataForm = [
            'veiculo_id' => $veiculo,
            'kilometragem' => $kilometragem,
            'tipo_combustivel' => $tipo_combustivel,
            'litros' => $litragem
        ];

        $abast_update->update($dataForm);

        return ("foi");

    }

    public function manual()
    {
        $title = 'Inserir Abastecimento Manual';

        $veiculos = veiculo::orderBy('placa')->get();
        $motoristas = motorista::orderBy('nome')->get();
        $combustiveis = tipoCombustivel::orderBy('descricao')->get();
        $postos = postosDeGasolina::orderBy('nome_fantasia')->get();
        $frentistas = Frentista::orderBy('nome')->get();

        return view('abastecimento.createManual', compact('title', 'veiculos', 'motoristas', 'combustiveis', 'postos', 'frentistas'));
    }

    public function storeAbastecimentoManual(Request $request)
    {
        $this->validate($request, [
            'veiculo_id' => 'required',
            'motorista' => 'required',
            'posto_id' => 'required',
            'tipo_combustivel' => 'required',
            'valor_unitario' => 'required',
            'litros' => 'required',
            'kilometragem' => 'required',
            'motivo' => 'required',
            'data' => 'required'
        ], [
            'veiculo_id.required' => 'Selecione um Veículo!',
            'motorista.required' => 'Selecione um Motorista!',
            'posto_id.required' => 'Selecione um Posto!',
            'tipo_combustivel.required' => 'Selecione um Tipo de Combustível!',
            'valor_unitario.required' => 'Preencha o Valor Unitário!',
            'litros.required' => 'Preencha a Quantidade de Litros!',
            'kilometragem.required' => 'Preencha a Kilometragem!',
            'motivo.required' => 'Preencha o Motivo da Inserção!',
            'data.required' => 'Preencha a Data!'
        ]);
        $data = $request->all();
        $data['valor_unitario'] = str_replace(',', '.', $data['valor_unitario']);
        $data['litros'] = str_replace(',', '.', $data['litros']);
        $insert = abastecimento::create($data);
        if ($insert) {
            $data['abastecimento_id'] = $insert['id'];
            $data['user_id'] = Auth::user()->id;
            $data['data_insercao'] = $data['data'];
            $data['frentista'] = $data['frentista_nome'];

            $log = log_abastecimento_manual::create($data);
            if ($log)
                return redirect()->route('createAbastecimentoManual')->with('success', 'Abastecimento Inserido com Sucesso');
            else
                return redirect()->back()->withErrors();
        } else
            return redirect()->back()->withErrors();
    }

    public function setCompAbastecimento(Request $request)
    {
        $fornecedor = $request->get("fornecedor");
        $placa = $request->get("placa");
        $modelo = $request->get("modelo");
        $cor = $request->get("cor");
        $secretaria = $request->get("secretaria");
        $ano = $request->get("ano");
        $fabricante = $request->get("fabricante");
        $saldo_litros = $request->get("saldo_litros");

        $frentista = $request->get("frentista");

        $servidor = $request->get("servidor");

        $kilometragem = $request->get("kilometragem");
        $qtd_litros = $request->get("qtd_litros");
        $valor_unitario = $request->get("valor_unitario");
        $tipo_combustivel = $request->get("tipo_combustivel");
        $valor_total = $request->get("valor_total");

        $setor = "setor_null";
        $periodo = "periodo_null";

        $today = date("d-m-Y H:i:s");
        
        $today = str_replace("-", "/", $today);
        $today = str_replace(" ", "", $today);
        $today = str_split($today, 10);

        $hora = substr($today[1], 0, 2);

        if ($hora >= 00 && $hora < 06) {
            $periodo = "Madrugada";
        } else if ($hora >= 06 && $hora < 12) {
            $periodo = "Manhã";
        } else if ($hora >= 12 && $hora < 19) {
            $periodo = "Tarde";
        } else if ($hora >= 19 && $hora <= 23) {
            $periodo = "Noite";
        }

        $retorno = "
        <style>
        .tbl_comp_abastecimento
        {
            width:450px;
            border: 1px solid #000;
        }
        </style>
        <table class='tbl_comp_abastecimento'>
            <tr>
                <td colspan='2' width='100%'>&nbsp;Dados do Abastecimento</td>
            </tr>
            <tr>
                <td colspan='2' width='100%'><hr /></td>
            </tr>
            <tr>
                <td colspan='2' width='100%'>Secretaria: $secretaria</td>
            </tr>
            <tr>
                <td colspan='2' width='100%'>Posto: $fornecedor</td>
            </tr>
            <tr>
                <td width='70%'>Data:  $today[0]</td> 
                <td width='30%'>Hora:  $today[1]</td>
            </tr>
            <tr>
                <td colspan='2' width='100%'>Motorista:  $servidor</td>
            </tr>
            <tr>
                <td colspan='2' width='100%'>Frentista:  $frentista</td>
            </tr>
            <tr>
                <td width='70%'>Combustivel:  $tipo_combustivel</td>
                <td width='30%'>Periodo: $periodo</td>
            </tr>
            <tr>
                <td colspan='2' width='100%'><hr /></td>
            </tr>
            <tr>
                <td colspan='2' width='100%'>&nbsp;Dados do Veiculo</td>
            </tr>
            <tr>
                <td colspan='2' width='100%'><hr /></td>
            </tr>
            <tr>
                <td width='70%'>Veiculo:  $modelo</td>
                <td width='30%'>Fabricante:  $fabricante</td>
            </tr>
            <tr>
                <td width='70%'>Placa:  $placa</td>
                <td width='30%'>Ano:  $ano</td>
            </tr>
            <tr>
            <td width='70%'>Kilometragem:  $kilometragem</td>
            <td width='30%'>Cor:  $cor</td>
        </tr>
        </table>
        ";

        return($retorno);
    }


}
