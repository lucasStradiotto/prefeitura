<?php

namespace App\Http\Controllers;

use App\Models\veiculo;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use App\Models\prefeitura;
use Illuminate\Support\Facades\Auth;

class DiarioDeBordoController extends Controller
{
    public function __construct()
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
    }

    function replace_accents($string)
    {
        return str_replace(
            array(
                'à',
                'á',
                'â',
                'ã',
                'ä',
                'ç',
                'è',
                'é',
                'ê',
                'ë',
                'ì',
                'í',
                'î',
                'ï',
                'ñ',
                'ò',
                'ó',
                'ô',
                'õ',
                'ö',
                'ù',
                'ú',
                'û',
                'ü',
                'ý',
                'ÿ',
                'À',
                'Á',
                'Â',
                'Ã',
                'Ä',
                'Ç',
                'È',
                'É',
                'Ê',
                'Ë',
                'Ì',
                'Í',
                'Î',
                'Ï',
                'Ñ',
                'Ò',
                'Ó',
                'Ô',
                'Õ',
                'Ö',
                'Ù',
                'Ú',
                'Û',
                'Ü',
                'Ý'
            ),
            array(
                'a',
                'a',
                'a',
                'a',
                'a',
                'c',
                'e',
                'e',
                'e',
                'e',
                'i',
                'i',
                'i',
                'i',
                'n',
                'o',
                'o',
                'o',
                'o',
                'o',
                'u',
                'u',
                'u',
                'u',
                'y',
                'y',
                'A',
                'A',
                'A',
                'A',
                'A',
                'C',
                'E',
                'E',
                'E',
                'E',
                'I',
                'I',
                'I',
                'I',
                'N',
                'O',
                'O',
                'O',
                'O',
                'O',
                'U',
                'U',
                'U',
                'U',
                'Y'
            ),
            $string
        );
    }

    function dataInicial($datainicio)
    {
        $horainicio = "00:00:00";
        $datahorainicial = $datainicio . ' ' . $horainicio;
        return Carbon::createFromFormat('Y-m-d H:i:s', $datahorainicial);

    }

    function dataFinal($datafim)
    {
        $horafim = "23:59:59";
        $datahorafinal = $datafim . ' ' . $horafim;
        return Carbon::createFromFormat('Y-m-d H:i:s', $datahorafinal);

    }

    function diarioDeBordo($veiculo, $datainicial, $datafinal, $eventos)
    {
        $eventparado = "
                  SELECT 'parado' AS evento, DATE_FORMAT(data_hora,'%d/%m/%Y') AS data, 
		          DATE_FORMAT(data_hora,'%H:%i:%s') AS hora, '' AS velocidade, rpm
                  FROM(
   	                    SELECT rastreador_id,
                                ligou,
                                (
                                SELECT MIN(desligou)
                                FROM (
                                      SELECT rastreador_id,
                                      CASE WHEN tipo_alerta = 6 THEN data_hora
                                      END AS ligou,
                                      CASE WHEN tipo_alerta = 3 THEN data_hora
                                      END AS desligou
                                      FROM (
                                            SELECT DISTINCT rastreador_id, data_hora, tipo_alerta
                                            FROM `rastreador_alertas`
                                            INNER JOIN veiculos
                                            ON veiculos.n_serie_rastreador = rastreador_alertas.rastreador_id
                                            WHERE tipo_alerta IN(3, 6)
                                            AND veiculos.id = ?
                                            ) AS t
                                      ) AS ttt
                                      WHERE rastreador_id = tt.rastreador_id 
                                      AND desligou > tt.ligou
                                ) AS desligou
                                FROM (
                                      SELECT rastreador_id,
                                      CASE WHEN tipo_alerta = 6 THEN data_hora
                                      END AS ligou,
                                      CASE WHEN tipo_alerta = 3 THEN data_hora
                                      END AS desligou
                                      FROM(
                                            SELECT DISTINCT rastreador_id, data_hora, tipo_alerta
                                            FROM `rastreador_alertas`
                                            INNER JOIN veiculos
                                            ON veiculos.n_serie_rastreador = rastreador_alertas.rastreador_id
                                            WHERE tipo_alerta IN(3, 6)
                                            AND veiculos.id = ? 
                                           ) AS t
                                      ) AS tt
                      ) AS b
                  INNER JOIN rastreamentos
                  ON rastreamentos.rastreador_id = b.rastreador_id
                  WHERE b.desligou IS NOT NULL
                  AND data_hora < b.desligou
                  AND data_hora > b.ligou
                  AND velocidade = 0
                  AND data_hora >= ?
                  AND data_hora <= ?
                  ORDER BY data_hora";

        $eventtodos = "
                  SELECT DATE_FORMAT(data_hora,'%d/%m/%Y') AS data,
                         DATE_FORMAT(data_hora,'%H:%i:%s') AS hora,
                         tipos_alertas.tipo AS evento,
                         '' AS velocidade,
                         '' AS rpm
                  FROM rastreador_alertas
                  INNER JOIN veiculos
                  ON veiculos.n_serie_rastreador = rastreador_id
                  INNER JOIN tipos_alertas
                  ON tipo_alerta = tipos_alertas.id
                  WHERE veiculos.id = ?
                  AND data_hora >= ?
                  AND data_hora <= ?
                  ";

        $todosregistros = "
                  SELECT DATE_FORMAT(data_hora,'%d/%m/%Y') AS data,
                         DATE_FORMAT(data_hora,'%H:%i:%s') AS hora,
                         tipos_alertas.tipo AS evento,
                         '' AS velocidade,
                         '' AS rpm,
                         data_hora
                  FROM rastreador_alertas
                  INNER JOIN veiculos
                  ON veiculos.n_serie_rastreador = rastreador_id
                  INNER JOIN tipos_alertas
                  ON tipo_alerta = tipos_alertas.id
                  WHERE veiculos.id = ?
                  AND data_hora >= ?
                  AND data_hora <= ?
                  UNION ALL
                  SELECT DATE_FORMAT(data_hora,'%d/%m/%Y') AS data,
                         DATE_FORMAT(data_hora,'%H:%i:%s') AS hora,
                         CASE WHEN velocidade > 0 THEN 'Em movimento' ELSE 'Veículo parado' END AS evento,
                         velocidade,
                         rpm,
                         rastreamentos.data_hora
                  FROM rastreamentos
                  INNER JOIN veiculos
                  ON veiculos.n_serie_rastreador = rastreador_id
                  WHERE veiculos.id = ?
                  AND data_hora >= ?
                  AND data_hora <= ?
                  ORDER BY data_hora";

        if ($eventos <= 13 && $eventos != 0) {

            switch ($eventos) {
                //bateria externa removida
                CASE 1:
                    $eventtodos = $eventtodos . " and tipos_alertas.id = 1 ORDER BY data_hora;";
                    BREAK;
                //entrada cerca eletronica
                CASE 2:
                    $eventtodos = $eventtodos . " and tipos_alertas.id = 2 ORDER BY data_hora;";
                    BREAK;
                //ignição desligada
                CASE 3:
                    $eventtodos = $eventtodos . " and tipos_alertas.id = 3 ORDER BY data_hora;";
                    BREAK;
                //bateria interna removida
                CASE 4:
                    $eventtodos = $eventtodos . " and tipos_alertas.id = 4 ORDER BY data_hora;";
                    BREAK;
                //Saída cerca eletrônica
                CASE 5:
                    $eventtodos = $eventtodos . " and tipos_alertas.id = 5 ORDER BY data_hora;";
                    BREAK;
                //Ignição ligada
                CASE 6:
                    $eventtodos = $eventtodos . " and tipos_alertas.id = 6 ORDER BY data_hora;";
                    BREAK;
                //Jammer detectado
                CASE 7:
                    $eventtodos = $eventtodos . " and tipos_alertas.id = 7 ORDER BY data_hora;";
                    BREAK;
                //Bateria externa conectada
                CASE 8:
                    $eventtodos = $eventtodos . " and tipos_alertas.id = 8 ORDER BY data_hora;";
                    BREAK;
                //Movimentação não autorizada
                CASE 9:
                    $eventtodos = $eventtodos . " and tipos_alertas.id = 9 ORDER BY data_hora;";
                    BREAK;
                //Bateria interna conectada
                CASE 10:
                    $eventtodos = $eventtodos . " and tipos_alertas.id = 10 ORDER BY data_hora;";
                    BREAK;
                //Início do modo super sleep
                CASE 11:
                    $eventtodos = $eventtodos . " and tipos_alertas.id = 11 ORDER BY data_hora;";
                    BREAK;
                //ID de motorista
                CASE 12:
                    $eventtodos = $eventtodos . " and tipos_alertas.id = 12 ORDER BY data_hora;";
                    BREAK;
                //Motor ocioso
                CASE 13:
                    $eventtodos = $eventtodos . " and tipos_alertas.id = 13 ORDER BY data_hora;";
                    BREAK;
            }
            $query = DB::select(
                DB::raw(
                    $eventtodos
                ),
                array(
                    $veiculo,
                    $datainicial,
                    $datafinal,
                )
            );
            return ($query);

        } else {

            Switch ($eventos) {
                //Todos os eventos
                CASE 0:
                    $query = DB::select(
                        DB::raw(
                            $todosregistros
                        ),
                        array(
                            $veiculo,
                            $datainicial,
                            $datafinal,
                            $veiculo,
                            $datainicial,
                            $datafinal,
                        )
                    );
                    return ($query);
                    BREAK;

                CASE 666:
                    $query = DB::select(
                        DB::raw(
                            $eventparado
                        ),
                        array(
                            $veiculo,
                            $veiculo,
                            $datainicial,
                            $datafinal,
                        )
                    );
                    return ($query);
                    BREAK;
            }
        }
    }


    function resumo($datahorainicial, $datainicial, $datahorafinal, $datafinal, $veiculo)
    {
        $rastreadorId = veiculo::find($veiculo)->n_serie_rastreador;
        
        $queryresumo = DB::select(
            DB::raw("
                SELECT MAX(distancia) - MIN(distancia) AS distanciatotal, MAX(rpm) AS rpm, MAX(velocidade) AS velocidade
                FROM `rastreamentos` 
                WHERE rastreador_id = ?
                AND data_hora >= ?
                AND data_hora <= ?
            "
            ),
            array(
                $rastreadorId,
                $datahorainicial,
                $datahorafinal
            )
        );

        $qryBase = "SELECT `r`.`rastreador_id` AS `rastreador_id`, 
                            `r`.`velocidade`    AS `velocidade`, 
                            `r`.`distancia`     AS `distancia`, 
                            `r`.`tempo`         AS `tempo`, 
                            `r`.`data_hora`     AS `data_hora` 
                    FROM ( ((SELECT `tt`.`rastreador_id`                           AS 
                                    `rastreador_id`, 
                                    `tt`.`ligou`                                   AS `ligou`, 
                                    (SELECT MIN(`ttt`.`desligou`) 
                                        FROM (SELECT `t`.`rastreador_id` AS `rastreador_id`, 
                                                    ( CASE 
                                                        WHEN( `t`.`tipo_alerta` = 6 ) THEN 
                                                        `t`.`data_hora` 
                                                    end )             AS `ligou`, 
                                                    ( CASE 
                                                        WHEN( `t`.`tipo_alerta` = 3 ) THEN 
                                                        `t`.`data_hora` 
                                                    end )             AS `desligou` 
                                                FROM (SELECT DISTINCT 
                                                    `postura`.`rastreador_alertas`.`rastreador_id` 
                                                    AS 
                                                            `rastreador_id`, 
                                                    `postura`.`rastreador_alertas`.`data_hora` 
                                                    AS 
                                                    `data_hora`, 
                                                    `postura`.`rastreador_alertas`.`tipo_alerta` 
                                                    AS 
                                                    `tipo_alerta` 
                                                        FROM `postura`.`rastreador_alertas` 
                                                    WHERE ( 
                                                    `postura`.`rastreador_alertas`.`tipo_alerta` 
                                                    IN( 3, 6 
                                                    ) 
                                                    AND rastreador_id = ? 
                                                    AND data_hora >= ? 
                                                    AND data_hora <= ? )) `t` 
                                            ) `ttt` 
                                    WHERE ( ( `ttt`.`rastreador_id` = `tt`.`rastreador_id` ) 
                                        AND ( `ttt`.`desligou` < ( `tt`.`ligou` + INTERVAL 1 day ) 
                                            ) 
                                        AND ( `ttt`.`desligou` > `tt`.`ligou` )  )) AS `desligou` 
                                FROM (SELECT `t`.`rastreador_id` AS `rastreador_id`, 
                                            ( CASE 
                                                WHEN( `t`.`tipo_alerta` = 6 ) THEN `t`.`data_hora` 
                                            end )             AS `ligou`, 
                                            ( CASE 
                                                WHEN( `t`.`tipo_alerta` = 3 ) THEN `t`.`data_hora` 
                                            end )             AS `desligou` 
                                        FROM (SELECT DISTINCT 
                                            `postura`.`rastreador_alertas`.`rastreador_id` 
                                            AS 
                                                    `rastreador_id`, 
                                            `postura`.`rastreador_alertas`.`data_hora` 
                                            AS 
                                            `data_hora`, 
                                            `postura`.`rastreador_alertas`.`tipo_alerta` 
                                            AS 
                                            `tipo_alerta` 
                                                FROM `postura`.`rastreador_alertas` 
                                            WHERE ( `postura`.`rastreador_alertas`.`tipo_alerta` 
                                                    IN( 3, 6 
                                                    )  
                                            AND rastreador_id = ? 
                                            AND data_hora >= ? 
                                            AND data_hora <= ?)) `t` 
                                    ) `tt` 
                            WHERE ( `tt`.`ligou` IS NOT NULL ))) `b` 
                            JOIN `postura`.`rastreamentos` `r` 
                                ON (( ( `r`.`rastreador_id` = `b`.`rastreador_id` ) 
                                    AND ( `r`.`data_hora` >= `b`.`ligou` ) 
                                    AND ( `r`.`data_hora` <= `b`.`desligou` ) ))) 
                    WHERE r.rastreador_id = ? 
                        AND data_hora >= ? 
                        AND data_hora <= ?";

        $qryHorasLigado = DB::select(
            DB::raw(
                "SELECT ROUND(SUM(tempo) / 60 / 60, 2) horas
                FROM ( "
                . $qryBase .
                " ) t"
            ),
            array(
                $rastreadorId,
                $datahorainicial,
                $datahorafinal,
                $rastreadorId,
                $datahorainicial,
                $datahorafinal,
                $rastreadorId,
                $datahorainicial,
                $datahorafinal
            )
        );

        $qryHorasLigadoMovimento = DB::select(
            DB::raw(
                "SELECT ROUND(SUM(tempo) / 60 / 60, 2) horas
                FROM ( "
                . $qryBase .
                " AND velocidade > 0
                 ) t"
            ),
            array(
                $rastreadorId,
                $datahorainicial,
                $datahorafinal,
                $rastreadorId,
                $datahorainicial,
                $datahorafinal,
                $rastreadorId,
                $datahorainicial,
                $datahorafinal
            )
        );

        $horasDisponivel = ($datainicial->diffInDays($datafinal) + 1) * 24;
        $horasligadoSemFormatacao = $qryHorasLigado[0]->horas;
        $horasLigado = number_format($horasligadoSemFormatacao, 2, '.', '');
        $utilizacao = number_format(($horasligadoSemFormatacao / $horasDisponivel) * 100, 2, '.', '');

        $horasLigadoMovimento = number_format($qryHorasLigadoMovimento[0]->horas, 2, '.', '');
        $horasLigadoParado = number_format($horasligadoSemFormatacao - $horasLigadoMovimento, 2, '.', '');
        $ociosidade = number_format($horasligadoSemFormatacao > 0 ? ($horasLigadoParado / $horasligadoSemFormatacao) * 100 : 0,
            2, '.', '');

        $horasDesligado = number_format($horasDisponivel - $horasligadoSemFormatacao, 2, '.', '');

        $array = [
            'objeto' => $queryresumo,
            'utilizacao' => $utilizacao,
            'horasDisponivel' => $horasDisponivel,
            'horasLigado' => $horasLigado,
            'horasLigadoMovimento' => $horasLigadoMovimento,
            'horasLigadoParado' => $horasLigadoParado,
            'ociosidade' => $ociosidade,
            'horasDesligado' => $horasDesligado
        ];

        return ($array);
    }


    public function getAllVeiculos()
    {
        $empresaId = Auth::user()->empresa_id;

        $veiculo = veiculo::where('empresa_id', '=', $empresaId)->select(['id', 'prefixo', 'placa'])->get();

        return $veiculo;
    }

    public function index()
    {
        $prefeitura = prefeitura::find(1);
        return view('diarioDeBordoVeiculos.index', compact('prefeitura'));
    }

    public function getEventosVeiculo()
    {
        $veiculo = \request()->get('selectveiculo');

        $eventos = DB::select(
            DB::raw(
                'SELECT DISTINCT tipos_alertas.id, tipos_alertas.tipo
                        FROM `rastreador_alertas`
                        INNER JOIN tipos_alertas
                        ON rastreador_alertas.tipo_alerta = tipos_alertas.id
                        INNER JOIN veiculos
                        ON  veiculos.n_serie_rastreador = rastreador_alertas.rastreador_id
                        WHERE veiculos.id = ?'
            ),
            array($veiculo)
        );
        return $eventos;

    }

    public function getResumo()
    {
        $veiculo = \request()->get('selectveiculo');

        $datainicio = request()->get('datainicio');
        $horainicio = "00:00:00";
        $datahorainicial = $datainicio . ' ' . $horainicio;
        $datainicial = Carbon::createFromFormat('Y-m-d H:i:s', $datahorainicial);

        $datafim = request()->get('datafim');
        $horafim = "23:59:59";
        $datahorafinal = $datafim . ' ' . $horafim;
        $datafinal = Carbon::createFromFormat('Y-m-d H:i:s', $datahorafinal);


        $query = $this->resumo($datahorainicial, $datainicial, $datahorafinal, $datafinal, $veiculo);

        return ($query);

    }

    function getLogo()
    {
        $prefeitura = prefeitura::find(1);
        return ($prefeitura);
    }


    function getBuscaDiarioBordo()
    {
        $veiculo = \request()->get('selectveiculo');

        $datainicio = request()->get('datainicio');
        $horainicio = "00:00:00";
        $datahorainicial = $datainicio . ' ' . $horainicio;
        $datainicial = Carbon::createFromFormat('Y-m-d H:i:s', $datahorainicial);

        $datafim = request()->get('datafim');
        $horafim = "23:59:59";
        $datahorafinal = $datafim . ' ' . $horafim;
        $datafinal = Carbon::createFromFormat('Y-m-d H:i:s', $datahorafinal);

        $eventos = request()->get('eventos');

        $resp = $this->diarioDeBordo($veiculo, $datainicial, $datafinal, $eventos);

        return $resp;
    }

    function getDownload()
    {

        $veiculo = \request()->get('selectveiculo');

        $datainicio = request()->get('datainicio');
        $horainicio = "00:00:00";
        $datahorainicial = $datainicio . ' ' . $horainicio;
        $datainicial = Carbon::createFromFormat('Y-m-d H:i:s', $datahorainicial);

        $datafim = request()->get('datafim');
        $horafim = "23:59:59";
        $datahorafinal = $datafim . ' ' . $horafim;
        $datafinal = Carbon::createFromFormat('Y-m-d H:i:s', $datahorafinal);

        $eventos = request()->get('eventos');

        $diariodebordo = $this->diarioDeBordo($veiculo, $datainicial, $datafinal, $eventos);
        $resumo = $this->resumo($datahorainicial, $datainicial, $datahorafinal, $datafinal, $veiculo);

        $html = '';

        $html .= '<table border="1">';
        $html .= '<tr>';
        $html .= '<td colspan="3"> Resumo do Veículo</td>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<td><b>Veículo disponível</b></td>';
        $html .= '<td><b>' . $resumo['horasDisponivel'] . '</b></td>';
        $html .= '<td><b>h</b></td>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<td><b>Veículo ligado</b></td>';
        $html .= '<td><b>' . $resumo['horasLigado'] . '</b></td>';
        $html .= '<td><b>h</b></td>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<td><b>Veículo desligado</b></td>';
        $html .= '<td><b>' . $resumo['horasDesligado'] . '</b></td>';
        $html .= '<td><b>h</b></td>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<td><b>Utilização:</b></td>';
        $html .= '<td><b>' . $resumo['utilizacao'] . '</b></td>';
        $html .= '<td><b>%</b></td>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<td><b>Veículo ligado e em movimento</b></td>';
        $html .= '<td><b>' . $resumo['horasLigadoMovimento'] . '</b></td>';
        $html .= '<td><b>h</b></td>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<td><b>Veículo ligado e parado:</b></td>';
        $html .= '<td><b>' . $resumo['horasLigadoParado'] . '</b></td>';
        $html .= '<td><b>h</b></td>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<td><b>Ociosidade:</b></td>';
        $html .= '<td><b>' . $resumo['ociosidade'] . '</b></td>';
        $html .= '<td><b>%</b></td>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<td><b>Distancia percorrida:</b></td>';
        $html .= '<td><b>' . $resumo['objeto'][0]->distanciatotal . '</b></td>';
        $html .= '<td><b>Km</b></td>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<td><b>Velocidade Máxima:</b></td>';
        $html .= '<td><b>' . $resumo['objeto'][0]->velocidade . '</b></td>';
        $html .= '<td><b>Km/h</b></td>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<td><b>RPM Máxima:</b></td>';
        $html .= '<td><b>' . $resumo['objeto'][0]->rpm . '</b></td>';
        $html .= '<td><b>RPM</b></td>';
        $html .= '</tr>';


        $html .= '<table>';
        $html .= '<tr>';
        $html .= '<td colspan="5"></td>';
        $html .= '</tr>';
        $html .= '</table>';


        $html .= '<table border="1">';
        $html .= '<tr>';
        $html .= '<td colspan="5">Diario de Bordo</td>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<td><b>Data</b></td>';
        $html .= '<td><b>Hora</b></td>';
        $html .= '<td><b>Eventos</b></td>';
        $html .= '<td><b>Velocidade</b></td>';
        $html .= '<td><b>RPM</b></td>';
        $html .= '</tr>';

        foreach ($diariodebordo as $data) {
            $html .= '<tr>';
            $html .= '<td><b>' . $data->data . '</b></td>';
            $html .= '<td><b>' . $data->hora . '</b></td>';
            $html .= '<td><b>' . $data->evento . '</b></td>';
            $html .= '<td><b>' . $data->velocidade . '</b></td>';
            $html .= '<td><b>' . $data->rpm . '</b></td>';
            $html .= '</tr>';
        }


        $retorno = base64_encode($this->replace_accents($html));

        $resposta = [
            'download' => [
                'mimetype' => 'application/vnd.ms-excel',
                'filename' => 'diariodebordo.xls',
                'data' => $retorno
            ]
        ];

        return ($resposta);

    }

}
