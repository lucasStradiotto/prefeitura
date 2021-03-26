<?php

namespace App\Http\Controllers;

use App\Models\veiculo;
use App\Models\secretaria;
use App\Models\motorista;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;


class RelatorioTrafegoController extends Controller
{

    public function __construct()
    {
        Session::put('url.intended', URL::current());
        $this->middleware('auth');
    }

    public function index()
    {

        return view('relatoriotrafego.index');
    }


    public function getSecretaria()
    {

        $secretaria = secretaria::select('id', 'nome', 'parent_id')->get();
        //dd($secretaria);
        return $secretaria;
    }

    public function getVeiculos()
    {

        $secretaria = \request()->get('secretaria_id');


        $veiculo = veiculo::where("secretaria_id", "=", $secretaria)->get();

        return $veiculo;
    }

    public function getMotoristas()
    {

        $secretaria = \request()->get('secretaria_id');

        $motorista = motorista::where("secretaria_id", "=", $secretaria)->get();

        return $motorista;
    }

    public function getVeiculosMotoristas()
    {
        $secretaria_id = \request()->get('secretaria_id');
        $veiculo_id = \request()->get('veiculo_id');
        $motorista = DB::select(
            DB::raw(
                'select motoristas.nome as motoristanome, motoristas.id as motoristaid
                            from veiculos_motoristas 
                            inner join motoristas
                            on motoristas.id = veiculos_motoristas.motorista_id
                            inner join veiculos
                            on veiculos.id = veiculos_motoristas.veiculo_id
                            inner join secretarias
                            on secretarias.id = motoristas.secretaria_id
                            where secretarias.id = ?
                            and veiculos.id = ?
                            '
            ),
            array($veiculo_id, $secretaria_id)
        );
        return $motorista;

    }

    public function getLista()
    {
        $lista = DB::select(
            DB::raw(
                'select motoristas.nome as motoristanome, secretarias.nome as secretarianome, 
                          DATE_FORMAT( veiculos_motoristas.data_utilizacao,\'%d/%m/%Y\') as data_utilizacao , 
                          DATE_FORMAT( veiculos_motoristas.data_utilizacao,\'%H:%i\') as hora_utilizacao
                            from veiculos_motoristas 
                            inner join motoristas
                            on motoristas.id = veiculos_motoristas.motorista_id
                            inner join veiculos
                            on veiculos.id = veiculos_motoristas.veiculo_id
                            inner join secretarias
                            on secretarias.id = motoristas.secretaria_id
                            '
            ),
            array()
        );
        return $lista;
    }

    public function getPesquisa()
    {
        $motorista_id = \request()->get('motorista_id');
        $secretaria_id = \request()->get('secretaria_id');
        $datainicio = \request()->get('datainicio');
        $datafim = \request()->get('datafim');
        $veiculo_id = \request()->get('veiculo_id');

        $query = 'select motoristas.nome as motoristanome ';

        if ($secretaria_id != '0') {
            if ($query == 'select ') {
                $query .= 'secretarias.nome as secretarianome ';
            } else {
                $query .= ',secretarias.nome as secretarianome ';
            }
        }
        if ($datainicio != '') {
            if ($query == 'select ') {
                $query .= 'DATE_FORMAT( veiculos_motoristas.data_utilizacao,\'%d/%m/%Y\') as data_utilizacao ';
                $query .= 'DATE_FORMAT( veiculos_motoristas.data_utilizacao,\'%H:%i\') as hora_utilizacao ';
            } else {
                $query .= ',DATE_FORMAT( veiculos_motoristas.data_utilizacao,\'%d/%m/%Y\') as data_utilizacao ';
                $query .= ',DATE_FORMAT( veiculos_motoristas.data_utilizacao,\'%H:%i\') as hora_utilizacao ';
            }
        }
        $query .= 'from veiculos_motoristas 
                            inner join motoristas
                            on motoristas.id = veiculos_motoristas.motorista_id
                            inner join veiculos
                            on veiculos.id = veiculos_motoristas.veiculo_id
                            inner join secretarias
                            on secretarias.id = motoristas.secretaria_id';
        if ($secretaria_id != '0') {
            $query .= ' where secretarias.id = ';
            $query .= $secretaria_id;
        }
        if ($motorista_id != '0') {
            $query .= ' and motoristas.id =';
            $query .= $motorista_id;
        }
        if ($veiculo_id != '0') {
            $query .= ' and veiculos.id =';
            $query .= $veiculo_id;
        }
        //if() fazer o filtro para a data

        $filtro = array();
        $foi = DB::select(
            DB::raw($query), $filtro
        );

        /* $query = 'select motoristas.nome as motoristanome, secretarias.nome as secretarianome,
                            DATE_FORMAT( veiculos_motoristas.data_utilizacao,\'%d/%m/%Y\') as data_utilizacao ,
                            DATE_FORMAT( veiculos_motoristas.data_utilizacao,\'%H:%i\') as hora_utilizacao
                              from veiculos_motoristas
                              inner join motoristas
                              on motoristas.id = veiculos_motoristas.motorista_id
                              inner join veiculos
                              on veiculos.id = veiculos_motoristas.veiculo_id
                              inner join secretarias
                              on veiculos.secretaria_id = secretarias.id
                              where 1=1
                             ';

         $filtro = array();

         if($secretaria != "") {
             $query .= ' and secretarias.id = ? ';
             $filtro[] = $secretaria;
         }

          $foi = DB::select(
              DB::raw( $query ), $filtro
          );*/

        return $foi;

    }

}
