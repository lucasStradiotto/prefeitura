<?php

namespace App\Http\Controllers;

use App\Models\abastecimento;
use App\Models\log_delete_abastecimento;
use App\Models\motorista;
use App\Models\postosDeGasolina;
use App\Models\veiculo;
use App\Models\tipoCombustivel;
use App\Models\veiculos_cota;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class VeiculosCotaController extends Controller
{
    private $veiculo;
    private $query;
    private $veiculoscota;

    public function __construct(veiculo $veiculo, veiculos_cota $veiculoscota, abastecimento $abastecimento, log_delete_abastecimento $log_delete_abastecimento)
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
        $this->veiculo = $veiculo;
        $genericquery = "SELECT `veiculos`.`placa` AS `placa`,`veiculos`.`id` AS `id`,veiculos_cotas.cota_litros,veiculos_cotas.ano,veiculos_cotas.mes
                        FROM `veiculos` 
                        LEFT JOIN veiculos_cotas
                        ON veiculos.id = veiculos_cotas.veiculo_id";
        $this->query = $genericquery;
        $this->veiculoscota = $veiculoscota;
        $this->abastecimento = $abastecimento;
        $this->log_delete_abastecimento = $log_delete_abastecimento;
    }

    public function index()
    {

        $title = 'Cotas Veiculos';
        //return("foi");
        return view('veiculosCota.index', compact('title'));
    }

    public function relatorioCotas()
    {
        $title = 'Abastecimento Por Mês';
        $prefeitura = DB::table('prefeituras')->first();

        return view('veiculosCota.relatorio', compact('title', 'prefeitura'));
    }

    public function getRelatorioCotas()
    {
        $query = DB::table('veiculos_cotas')
            ->join('veiculos', 'veiculos_cotas.veiculo_id', '=', 'veiculos.id')
            ->leftJoin('abastecimentos', 'abastecimentos.veiculo_id', '=', 'veiculos.id')
            ->where([['veiculos_cotas.ano', '=', (int)request()->get('ano')], ['veiculos_cotas.mes', '=', (int)request()->get('mes')]]);

        if (count(request()->get('secretaria_id')) > 0) {
            $query = $query->whereIn('veiculos.secretaria_id', request()->get('secretaria_id'));
        }

        $query = $query->select('veiculos.id', 'veiculos.codigo_barra', 'veiculos.modelo', 'veiculos_cotas.cota_litros', DB::raw('SUM(litros) as total_abastecido'))
            ->groupBy('veiculos.id', 'veiculos.codigo_barra', 'veiculos.modelo', 'veiculos_cotas.cota_litros');

        return json_encode($query->get());
    }

    public function relatorioCotasPeriodo()
    {
        $title = 'Abastecimento Por Período';
        $prefeitura = DB::table('prefeituras')->first();

        return view('veiculosCota.relatorioPeriodo', compact('title', 'prefeitura'));
    }

    public function getRelatorioCotasPeriodo()
    {
        $query = DB::table('abastecimentos')
            ->join('veiculos', 'veiculos.id', '=', 'abastecimentos.veiculo_id')
            ->join('tipo_veiculos', 'veiculos.id_tipo_veiculo', '=', 'tipo_veiculos.id')
            ->join('tipo_combustivels', function ($join) {
                $join->on('abastecimentos.tipo_combustivel', '=', 'tipo_combustivels.id');
                $join->orOn('abastecimentos.tipo_combustivel', '=', 'tipo_combustivels.descricao');
            })
            ->join('postos_de_gasolinas', 'postos_de_gasolinas.id', '=', 'abastecimentos.posto_id');

        if (request()->get('setor_id') !== null && count(request()->get('setor_id')) > 0) {
            $query = $query->join('despesa_sub_setores', 'despesa_sub_setores.id', 'veiculos.despesa_sub_setor_id')
                ->whereIn('despesa_sub_setores.despesa_setor_id', request()->get('setor_id'));
        }
        else
        {
            if (request()->get('secretaria_id') !== null && count(request()->get('secretaria_id')) > 0) {
                $query = $query->join('despesa_sub_setores', 'despesa_sub_setores.id', 'veiculos.despesa_sub_setor_id')
                    ->join('despesa_setores', 'despesa_setores.id', 'despesa_sub_setores.despesa_setor_id')
                    ->whereIn('despesa_setores.secretaria_id', request()->get('secretaria_id'));
            }
        }

        $query = $query->whereRaw('DATE_FORMAT(data, "%Y-%m-%d") >= ?', [request()->get('inicio')])
            ->whereRaw('DATE_FORMAT(data, "%Y-%m-%d") <= ?', [request()->get('fim')]);

        if (request()->get('sub_setor_id') !== null && count(request()->get('sub_setor_id')) > 0) {
            $query = $query->whereIn('veiculos.despesa_sub_setor_id', request()->get('sub_setor_id'));
        }

        if (request()->get('veiculo_id') !== '0') {
            $query = $query->where('veiculos.id', '=', (int)request()->get('veiculo_id'));
        }

        if (request()->get('servidor') !== '0') {
            $query = $query->where('abastecimentos.motorista', '=', request()->get('servidor'));
        }

        if (request()->get('tipo_combustivel') !== '0') {
            $query = $query->where('abastecimentos.tipo_combustivel', '=', request()->get('tipo_combustivel'));
        }

        if (request()->get('posto_id') !== '0') {
            $query = $query->where('abastecimentos.posto_id', '=', request()->get('posto_id'));
        }

        $query = $query->select(DB::raw('(select kilometragem FROM abastecimentos ab WHERE ab.data < abastecimentos.data AND ab.veiculo_id = abastecimentos.veiculo_id ORDER BY ab.data DESC LIMIT 1) as km_anterior, abastecimentos.id as id,abastecimentos.frentista_nome as frentista_nome, veiculos.id as veiculo_id, tipo_veiculos.nome as tipoveiculo, postos_de_gasolinas.nome_fantasia as posto ,abastecimentos.posto_id,abastecimentos.kilometragem, tipo_combustivels.descricao as descricao, motorista, veiculos.codigo_barra, veiculos.modelo, veiculos.placa, DATE_FORMAT(data, "%d/%m/%Y") as full_date, DATE_FORMAT(data, "%H:%i") as hora, SUM(litros) as total_abastecido, tipo_veiculos.instrumento_medida as instrumento_medida'))
            ->groupBy('tipo_veiculos.nome', 'veiculos.id', 'abastecimentos.id', 'abastecimentos.posto_id', 'abastecimentos.kilometragem', 'motorista', 'full_date', 'codigo_barra', 'modelo', 'placa', 'km_anterior', 'tipo_combustivels.descricao', DB::raw('DATE_FORMAT(data, "%Y-%m-%d")'), DB::raw('DATE_FORMAT(data, "%H:%i")'))
            ->orderByRaw('DATE_FORMAT(data, "%Y-%m-%d") DESC, DATE_FORMAT(data, "%H:%i") DESC')
            ->get();

        return json_encode($query);
    }

    public function getVeiculosToRelatorioPeriodo()
    {
        $ids = request()->get('secretarias') ?
               request()->get('secretarias') : [];
        $veiculos = veiculo::select('id', 'placa');

        if (count($ids) > 0) {
            $veiculos = $veiculos->whereIn('secretaria_id', $ids);
        }
        
        $veiculos = $veiculos->orderBy('placa', 'asc')
            ->get();
        return $veiculos;
    }
    public function getTipoCombustivel()
    {
        $tipo_combustivels = tipoCombustivel::select('id', 'descricao')->get();
        return $tipo_combustivels;
    }

    public function getPostos()
    {
        $postos = postosDeGasolina::select('id', 'nome')->get();
        return $postos;
    }

    public function getServidoresToRelatorioPeriodo()
    {
        $ids = request()->get('secretarias') ?
               request()->get('secretarias') : [];
        $motoristas = motorista::select('nome')
            ->whereIn('secretaria_id', $ids)
            ->get();
        return json_encode($motoristas);
    }

    public function getAllVeiculosCotas()
    {

        return json_encode($veiculos = DB::select(
            DB::raw(
                $this->query
            ),
            array()
        ));
    }

    public function getVeiculosCotasPorSecretaria()
    {
        $querycompleta = $this->query . " WHERE veiculos.secretaria_id = ? ORDER BY `veiculos`.`placa`  ASC";

        if (request()->get('id') == 0) {
            $result = json_encode(DB::select(
                DB::raw(
                    $this->query . " ORDER BY `veiculos`.`placa`  ASC"
                ),
                array()
            ));
            return $result;
        } else {
            $result = json_encode(
                DB::select(
                    DB::raw(
                        $querycompleta
                    ),
                    array(
                        request()->get('id')
                    )
                )
            );
            return $result;
        }
    }

    public function getVeiculosCotasPorMes()
    {
        $querysedomes = $this->query . " WHERE veiculos_cotas.mes = ? ORDER BY `veiculos`.`placa`  ASC";


        if (intval(request()->get('id')) == 0 && intval(request()->get('secretaria_id')) != 0) {
            dd('2');
            $result = json_encode(
                DB::select(
                    DB::raw(
                        "SELECT `veiculos`.`placa` AS `placa`,`veiculos`.`id` AS `id`,veiculos_cotas.cota_litros,veiculos_cotas.ano,veiculos_cotas.mes, secretarias.nome
                        FROM `veiculos` 
                        LEFT JOIN veiculos_cotas
                        ON veiculos.id = veiculos_cotas.veiculo_id
                        INNEr join secretarias
                        on veiculos.secretaria_id = secretarias.id
                        where secretarias.id = ?
                        and veiculos_cotas.mes = ?"
                    ),
                    array(
                        request()->get('secretaria_id'),
                        intval(request()->get('mes'))
                    )
                )
            );
            return $result;
        } else if (intval(request()->get('id')) !== 0) {
            $result = json_encode(DB::select(
                DB::raw(
                    $this->query . " WHERE veiculos_cotas.mes = ? and veiculos.id = ? ORDER BY `veiculos`.`placa`  ASC"
                ),
                array(
                    request()->get('mes'),
                    request()->get('id')
                )
            ));
             // dd($result);
            return $result;
        } else {
            dd("caiu aqui");
            $result = json_encode(DB::select(
                DB::raw(
                    $querysedomes
                ),
                array(
                    request()->get('mes')
                )
            ));
             // dd($result);
            return $result;

        }
    }

    public function getVeiculosCotasFiltros()
    {
        $query = "SELECT veiculos.placa, 
                          veiculos.id AS id,
                          veiculos_cotas.cota_litros,
                          veiculos_cotas.ano,
                          veiculos_cotas.mes
                FROM `veiculos` 
                LEFT JOIN veiculos_cotas
                ON veiculos.id = veiculos_cotas.veiculo_id";

        $array = [];
        $secretaria = (int)request()->get('secretaria');
        $veiculo = (int)request()->get('veiculo');

        $recorrente = request()->get('recorrente');
        if ($recorrente == "false")
        {
            $mes = request()->get('mes');
            $ano = request()->get('ano');
            $query .= " AND veiculos_cotas.mes = ? AND veiculos_cotas.ano = ?";
            array_push($array, $mes);
            array_push($array, $ano);
        }
        else
        {
            $mes_inicial = request()->get('mes_inicial');
            $mes_final = request()->get('mes_final');
            $ano_inicial = request()->get('ano_inicial');
            $ano_final = request()->get('ano_final');
            $query .= " AND veiculos_cotas.mes BETWEEN ? AND ? ";
            $query .= " AND veiculos_cotas.ano BETWEEN ? AND ?";
            array_push($array, $mes_inicial);
            array_push($array, $mes_final);
            array_push($array, $ano_inicial);
            array_push($array, $ano_final);
        }

        if ($secretaria != 0) {
            $query .= " WHERE veiculos.secretaria_id = ?";
            array_push($array, $secretaria);
        }
        if ($veiculo != 0) {
            $condicao = $secretaria != 0 ? " AND" : " WHERE";
            $query .= $condicao . " veiculos.id = ?";
            array_push($array, $veiculo);
        }

        return json_encode(
            DB::select(
                DB::raw(
                    $query
                ),
                $array
            )
        );
    }

    public function getVeiculosCotasPorVeiculos()
    {
        $querycompleta = $this->query . " WHERE veiculos.id = ?";
        $querysecret = $this->query . " WHERE veiculos.secretaria_id = ?";
        if (request()->get('id') == 0) {

            if (request()->get('idsecretaria') == 0) {
                return json_encode(DB::select(
                    DB::raw(
                        $this->query
                    ),
                    array()
                ));
            } else {
                return json_encode(DB::select(
                    DB::raw(
                        $querysecret
                    ),
                    array(
                        request()->get('idsecretaria')
                    )
                ));
            }

        } else {
            return json_encode(
                DB::select(
                    DB::raw(
                        $querycompleta
                    ),
                    array(
                        request()->get('id')
                    )
                )
            );
        }
    }

    public function getVeiculosSecretariaSelect()
    {
        $id = request()->get('id');
        //dd($id);
        if ($id == 0) {
            return json_encode(DB::select(
                DB::raw(
                    "SELECT
                          `veiculos`.`placa` AS `placa`,
                          `veiculos`.`id`
                        FROM
                          `veiculos`"
                ),
                array()
            ));
        } else {
            return json_encode(DB::select(
                DB::raw(
                    "SELECT
                          `veiculos`.`placa` AS `placa`,
                          `veiculos`.`id`
                          FROM
                          `veiculos`
                          inner join secretarias
                          on secretarias.id = veiculos.secretaria_id
                          where secretaria_id = ?"
                ),
                array(
                    $id
                )
            ));
        }

    }

    public function updateVeiculosCota()
    {
        $ids = request()->get('id');
        $cota = request()->get('cota');
        $recorrente = request()->get('recorrente');

        if ($recorrente == "true")
        {
            $mes_inicio = request()->get('mes_inicial');
            $mes_final = request()->get('mes_final');
            $ano_inicio = request()->get('ano_inicial');
            $ano_final = request()->get('ano_final');
            foreach ($ids as $id)
            {
                $exists = DB::select(
                    DB::raw(
                        "SELECT veiculos.id
                        FROM veiculos 
                        INNER JOIN veiculos_cotas
                        ON veiculos.id = veiculos_cotas.veiculo_id
                        WHERE veiculos_cotas.veiculo_id = ?"
                    ),
                    array(
                        $id
                    )
                );

                //SE NÃO EXISTIR COTA CADASTRADA PARA ESSE VEÍCULO
                if (count($exists) == 0)
                {
                    $inicio = $ano_inicio . $mes_inicio;
                    $fim = $ano_final . $mes_final;
                    $dataForm['veiculo_id'] = $id;
                    $dataForm['cota_litros'] = $cota;

                    //PERCORRE UMA VEZ PARA CADA MÊS/ANO
                    while ($inicio <= $fim)
                    {
                        $mes = $inicio[4].$inicio[5];
                        $ano = $inicio[0].$inicio[1].$inicio[2].$inicio[3];
                        //ADICIONA A COTA PRA ESTE VEÍCULO/MÊS/ANO
                        $dataForm['ano'] = $ano;
                        $dataForm['mes'] = $mes;
                        $this->veiculoscota->create($dataForm);

                        //INCREMENTA O CONTADOR DE MÊS
                        $mes++;
                        $mes = ($mes < 10) ? "0".$mes : $mes;
                        //SE O MÊS PASSAR DE DEZEMBRO,
                        // INCREMENTA O ANO E VOLTA O MÊS PRA JANEIRO
                        if ($mes > 12)
                        {
                            $ano = ($inicio[0].$inicio[1].$inicio[2].$inicio[3]) + 1;
                            $mes = '01';
                        }
                        $inicio = $ano . $mes;
                    }
                }
                //JÁ EXISTE COTA PARA ESTE VEÍCULO
                else
                {
                    $inicio = $ano_inicio . $mes_inicio;
                    $fim = $ano_final . $mes_final;
                    $dataForm['veiculo_id'] = $id;
                    $dataForm['cota_litros'] = $cota;

                    //PERCORRE UMA VEZ PARA CADA MÊS/ANO
                    while ($inicio <= $fim)
                    {
                        $mes = $inicio[4].$inicio[5];
                        $ano = $inicio[0].$inicio[1].$inicio[2].$inicio[3];

                        // VERIFICA SE JÁ EXISTE COTA PRA ESTE VEÍCULO/MES/ANO
                        $exists = DB::select(
                            DB::raw(
                                "SELECT veiculos_cotas.id as id_tabela , 
                                veiculos.id AS id, 
                                veiculos_cotas.cota_litros, 
                                veiculos_cotas.mes, 
                                veiculos_cotas.ano
                                FROM veiculos 
                                LEFT JOIN veiculos_cotas
                                ON veiculos.id = veiculos_cotas.veiculo_id
                                WHERE veiculos_cotas.veiculo_id = ?
                                AND veiculos_cotas.mes = ?
                                AND veiculos_cotas.ano = ?"
                            ),
                            array(
                                $id,
                                $mes,
                                $ano
                            )
                        );

                        $dataForm['mes'] = $mes;
                        $dataForm['ano'] = $ano;
                        //NAO EXISTE COTA PRA ESTE VEICULO/MES/ANO
                        if (count($exists) == 0)
                            $this->veiculoscota->create($dataForm);
                        //EXISTE COTA PARA ESTE VEICULO/MES/ANO
                        else
                        {
                            $cota_id = $exists[0]->id_tabela;
                            $veiculocota = $this->veiculoscota->find($cota_id);
                            $veiculocota->update($dataForm);
                        }

                        //INCREMENTA O CONTADOR DE MÊS
                        $mes++;
                        $mes = ($mes < 10) ? "0".$mes : $mes;
                        //SE O MÊS PASSAR DE DEZEMBRO,
                        // INCREMENTA O ANO E VOLTA O MÊS PRA JANEIRO
                        if ($mes > 12)
                        {
                            $ano = ($inicio[0].$inicio[1].$inicio[2].$inicio[3]) + 1;
                            $mes = '01';
                        }
                        $inicio = $ano . $mes;
                    }
                }
            }
        }
        else
        {
            $ano = request()->get('ano');
            $mes = request()->get('mes');
            foreach ($ids as $id)
            {
                $confirm = DB::select(
                    DB::raw(
                        "SELECT `veiculos`.`placa` AS `placa`,`veiculos`.`id` AS `id`
                        FROM `veiculos` 
                        INNER JOIN veiculos_cotas
                        ON veiculos.id = veiculos_cotas.veiculo_id
                        WHERE veiculos_cotas.veiculo_id = ?"
                    ),
                    array(
                        $id
                    )
                );

                if (count($confirm) == 0) {
                    // dd("id  do veiculo não tem dados no banco");
                    $dataForm = ['veiculo_id' => $id, 'cota_litros' => $cota, 'ano' => $ano, 'mes' => $mes];
                    $this->veiculoscota->create($dataForm);
                } else {
                    $data = DB::select(
                        DB::raw(
                            "SELECT veiculos_cotas.id as id_tabela ,`veiculos`.`placa` AS `placa`,`veiculos`.`id` AS `id`,veiculos_cotas.cota_litros,veiculos_cotas.mes,veiculos_cotas.ano
                        FROM `veiculos` 
                        LEFT JOIN veiculos_cotas
                        ON veiculos.id = veiculos_cotas.veiculo_id
                        WHERE veiculos_cotas.veiculo_id = ?
                        AND veiculos_cotas.mes = ?
                         AND veiculos_cotas.ano = ?"
                        ),
                        array(
                            $id,
                            $mes,
                            $ano
                        )
                    );

                    //dd("id do veiculo tem dado no banco");
                    // verificar se esta no dentro do periodo se ja existente e fazer um update
                    //se n tiver dentro do tempo que ja existe criar um novo

                    //dd($data);
                    if (count($data) == 0) {
                        //dd("periodo não Existe");
                        $dataForm = ['veiculo_id' => $id, 'cota_litros' => $cota, 'mes' => $mes, 'ano' => $ano];
                        $this->veiculoscota->create($dataForm);

                    } else {
                        $iddata = $data[0]->id_tabela;
                        $dataForm = ['veiculo_id' => $id, 'cota_litros' => $cota, 'mes' => $mes, 'ano' => $ano];
                        $veiculocota = $this->veiculoscota->find($iddata);
                        $veiculocota->update($dataForm);
                    }
                }
            }
        }
        return ("fim");
    }

    public function deleteAbastecimento()
    {

        $now = Carbon::now();
        $abastecimento_id = request()->get('id_abastecimento');
        $user_id = Auth::user()->id;
        $abast = $this->abastecimento->find($abastecimento_id);
        $dataform = [];
        $dataform['abastecimento_id'] = $abast->id;
        $dataform['data_exclusao'] = $now;
        $dataform['user_id'] = $user_id;
        $dataform['veiculo_id'] = $abast->veiculo_id;
        $dataform['motorista'] = $abast->motorista;
        $dataform['tipo_combustivel'] = $abast->tipo_combustivel;
        $dataform['valor_unitario'] = $abast->valor_unitario;
        $dataform['litros'] = $abast->litros;
        $dataform['kilometragem'] = $abast->kilometragem;
        $dataform['posto_id'] = $abast->posto_id;
        $dataform['frentista'] = $abast->frentista_nome;
        $dataform['data_abastecimento'] = $abast->data;
        $this->log_delete_abastecimento->create($dataform);

        DB::table('abastecimentos')->where('id', $abastecimento_id)->delete();

        return 1;

    }
}
