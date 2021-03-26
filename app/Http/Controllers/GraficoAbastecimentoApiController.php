<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GraficoAbastecimentoApiController extends Controller
{
    public function getVolumeTotalMes()
    {
        $ano = request()->get('ano');
        return json_encode(
            DB::select(
                DB::raw(
                    "SELECT SUM(abastecimentos.litros) as total_litros,  date_format(abastecimentos.data, '%m') as mes
                            FROM `abastecimentos`
                            WHERE date_format(abastecimentos.data, '%Y') = ?
                            group by  date_format(abastecimentos.data, '%m')"
                ),
                array($ano)
            )
        );
    }

    public function getVolumeTotalSecretaria(Request $request)
    {
        $mes = request()->get('mes');
        $ano = request()->get('ano');
        return json_encode(
            DB::select(
                DB::raw(
                    "SELECT SUM(abastecimentos.litros) as total_litros,despesa_setores.nome as secretarias, despesa_setores.id as secretaria_id
                        FROM `abastecimentos`
                        inner join veiculos
                        on veiculos.id = abastecimentos.veiculo_id
                        inner join despesa_sub_setores
                        on despesa_sub_setores.id = veiculos.despesa_sub_setor_id
                        inner join despesa_setores
                        on despesa_setores.id = despesa_sub_setores.despesa_setor_id
                        where date_format(abastecimentos.data, '%m') = ?
                        and date_format(abastecimentos.data, '%Y') = ?
                        GROUP BY despesa_setores.nome, despesa_setores.id
                        ORDER BY total_litros DESC"
                ),
                array(
                    intval( $mes ),
                    $ano
                )
            )
        );
    }

    public function getVolumeTotalSecretFornecedor(Request $request)
    {
        $secretaria_id = request()->get('secretaria');
        $mes = request()->get('mes');
        $ano = request()->get('ano');
        return json_encode(
            DB::select(
                DB::raw(
                    "SELECT SUM(abastecimentos.litros) as total_litros,despesa_setores.nome as secretarias, despesa_setores.id as secretaria_id, despesa_sub_setores.id as posto_id, despesa_sub_setores.nome as postos_de_gasolinas
                        FROM `abastecimentos`
                        inner join veiculos
                        on veiculos.id = abastecimentos.veiculo_id
                        inner join despesa_sub_setores
                        on despesa_sub_setores.id = veiculos.despesa_sub_setor_id
                        inner join despesa_setores
                        on despesa_setores.id = despesa_sub_setores.despesa_setor_id
                        where date_format(abastecimentos.data, '%m') = ?
                        and date_format(abastecimentos.data, '%Y') = ?
                        and despesa_setores.id = ?
                        GROUP BY despesa_setores.nome, despesa_setores.id, despesa_sub_setores.id,despesa_sub_setores.nome
                        ORDER BY total_litros DESC"
                ),
                array(
                    intval( $mes ),
                    $ano,
                    intval( $secretaria_id ),
                )
            )
        );
    }

    public function getVolumeTotalSubSetorVeiculo(Request $request)
    {
        $sub_setor_id = request()->get('sub_setor_id');
        $mes = request()->get('mes');
        $ano = request()->get('ano');
        return json_encode(
            DB::select(
                DB::raw(
                    "SELECT SUM(abastecimentos.litros) as total_litros, veiculos.id as veiculo_id, veiculos.placa
                        FROM `abastecimentos`
                        inner join veiculos
                        on veiculos.id = abastecimentos.veiculo_id
                        where date_format(abastecimentos.data, '%m') = ?
                        and date_format(abastecimentos.data, '%Y') = ?
                        and veiculos.despesa_sub_setor_id = ?
                        GROUP BY veiculos.id, veiculos.placa
                        ORDER BY total_litros DESC"
                ),
                array(
                    intval( $mes ),
                    $ano,
                    intval( $sub_setor_id )
                )
            )
        );
    }

    public function getVolumeTotalVeiculoDia(Request $request)
    {
        $veiculo_id = request()->get('veiculo_id');
        $mes = request()->get('mes');
        $ano = request()->get('ano');
        return json_encode(
            DB::select(
                DB::raw(
                    "SELECT SUM(abastecimentos.litros) as total_litros, DATE_FORMAT(abastecimentos.data, '%d') as dia
                        FROM `abastecimentos`
                        where date_format(abastecimentos.data, '%m') = ?
                        and date_format(abastecimentos.data, '%Y') = ?
                        and abastecimentos.veiculo_id = ?
                        GROUP BY DATE_FORMAT(abastecimentos.data, '%d')
                        ORDER BY dia ASC"
                ),
                array(
                    intval( $mes ),
                    $ano,
                    intval( $veiculo_id )
                )
            )
        );
    }

    public function getKmLitroMes()
    {
        $ano = request()->get('ano');
        return json_encode(
            DB::select(
                DB::raw(
                    "   SELECT SUM(km_atual - km_anterior) / SUM(litros) AS km_litro,
                                mes
                        FROM
                        (SELECT
                            (SELECT kilometragem
                            FROM abastecimentos ab
                            WHERE ab.data < abastecimentos.data
                                AND ab.veiculo_id = abastecimentos.veiculo_id
                            ORDER BY ab.data DESC
                            LIMIT 1) AS km_anterior,
                                kilometragem AS km_atual,
                                litros,
                                DATE_FORMAT(DATA, '%m') AS mes
                            FROM abastecimentos
                            WHERE DATE_FORMAT(DATA, '%Y') = ? ) AS t
                        WHERE km_anterior IS NOT NULL
                        AND km_anterior < km_atual
                        GROUP BY mes"
                ),
                [$ano]
            )
        );
    }

    public function getKmLitroSetor(Request $request)
    {
        $ano = request()->get('ano');
        return json_encode(
            DB::select(
                DB::raw(
                    "   SELECT SUM(km_atual - km_anterior) / SUM(litros) AS km_litro,
                                id,
                                nome
                        FROM
                        (SELECT
                            (SELECT kilometragem
                            FROM abastecimentos ab
                            WHERE ab.data < abastecimentos.data
                                AND ab.veiculo_id = abastecimentos.veiculo_id
                            ORDER BY ab.data DESC
                            LIMIT 1) AS km_anterior,
                                kilometragem AS km_atual,
                                litros,
                                despesa_setores.id,
                                despesa_setores.nome
                            FROM abastecimentos
                            INNER JOIN veiculos ON veiculos.id = abastecimentos.veiculo_id
                            INNER JOIN despesa_sub_setores ON despesa_sub_setores.id = veiculos.despesa_sub_setor_id
                            INNER JOIN despesa_setores ON despesa_setores.id = despesa_sub_setores.despesa_setor_id
                            WHERE DATE_FORMAT(DATA, '%Y') = ?
                            AND DATE_FORMAT(DATA, '%m') = ? ) AS t
                        WHERE km_anterior IS NOT NULL
                        AND km_anterior < km_atual
                        GROUP BY id,
                                nome
                        ORDER BY 1 DESC"
                ),
                [
                    $ano,
                    intval($request->get('mes'))
                ]
            )
        );
    }

    public function getKmLitroSubSetor(Request $request)
    {
        $ano = request()->get('ano');
        return json_encode(
            DB::select(
                DB::raw(
                    "SELECT SUM(km_atual - km_anterior) / SUM(litros) AS km_litro,
                                id,
                                nome
                        FROM
                        (SELECT
                            (SELECT kilometragem
                            FROM abastecimentos ab
                            WHERE ab.data < abastecimentos.data
                                AND ab.veiculo_id = abastecimentos.veiculo_id
                            ORDER BY ab.data DESC
                            LIMIT 1) AS km_anterior,
                                kilometragem AS km_atual,
                                litros,
                                despesa_sub_setores.id,
                                despesa_sub_setores.nome
                            FROM abastecimentos
                            INNER JOIN veiculos ON veiculos.id = abastecimentos.veiculo_id
                            INNER JOIN despesa_sub_setores ON despesa_sub_setores.id = veiculos.despesa_sub_setor_id
                            WHERE DATE_FORMAT(DATA, '%Y') = ?
                            AND DATE_FORMAT(DATA, '%m') = ?
                            AND despesa_sub_setores.despesa_setor_id = ? ) AS t
                        WHERE km_anterior IS NOT NULL
                        AND km_anterior < km_atual
                        GROUP BY id,
                                nome
                        ORDER BY 1 DESC"
                ),
                [
                    $ano,
                    intval($request->get('mes')),
                    intval($request->get('setor_id'))
                ]
            )
        );
    }

    public function getKmLitroVeiculo(Request $request)
    {
        $ano = request()->get('ano');
        return json_encode(
            DB::select(
                DB::raw(
                    "   SELECT SUM(km_atual - km_anterior) / SUM(litros) AS km_litro,
                                id,
                                placa
                        FROM
                        (SELECT
                            (SELECT kilometragem
                            FROM abastecimentos ab
                            WHERE ab.data < abastecimentos.data
                                AND ab.veiculo_id = abastecimentos.veiculo_id
                            ORDER BY ab.data DESC
                            LIMIT 1) AS km_anterior,
                                kilometragem AS km_atual,
                                litros,
                                veiculos.id,
                                veiculos.placa
                            FROM abastecimentos
                            INNER JOIN veiculos ON veiculos.id = abastecimentos.veiculo_id
                            WHERE DATE_FORMAT(DATA, '%Y') = ?
                            AND DATE_FORMAT(DATA, '%m') = ?
                            AND veiculos.despesa_sub_setor_id = ? ) AS t
                        WHERE km_anterior IS NOT NULL
                        AND km_anterior < km_atual
                        GROUP BY id,
                                placa
                        ORDER BY 1 DESC"
                ),
                [
                    $ano,
                    intval($request->get('mes')),
                    intval($request->get('sub_setor_id'))
                ]
            )
        );
    }

    public function getKmLitroDia(Request $request)
    {
        $ano = request()->get('ano');
        return json_encode(
            DB::select(
                DB::raw(
                    "   SELECT SUM(km_atual - km_anterior) / SUM(litros) AS km_litro,
                                dia
                        FROM
                        (SELECT
                            (SELECT kilometragem
                            FROM abastecimentos ab
                            WHERE ab.data < abastecimentos.data
                                AND ab.veiculo_id = abastecimentos.veiculo_id
                            ORDER BY ab.data DESC
                            LIMIT 1) AS km_anterior,
                                kilometragem AS km_atual,
                                litros,
                                DATE_FORMAT(DATA, '%d') AS dia
                            FROM abastecimentos
                            WHERE DATE_FORMAT(DATA, '%Y') = ?
                            AND DATE_FORMAT(DATA, '%m') = ?
                            AND abastecimentos.veiculo_id = ? ) AS t
                        WHERE km_anterior IS NOT NULL
                        AND km_anterior < km_atual
                        GROUP BY dia
                        ORDER BY 2"
                ),
                [
                    $ano,
                    intval($request->get('mes')),
                    intval($request->get('veiculo_id'))
                ]
            )
        );
    }
}
