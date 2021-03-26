@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard Entulho</div>

                    <div class="panel-body">
                        <p>
                            <a class="btn btn-success" href="{{route('indexEmpresa')}}">Cadastrar Empresa</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('indexTipoVeiculo')}}">Cadastrar Grupo de Veículos</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('indexVeiculo')}}">Cadastrar Veículo</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('indexJornadaTrabalho')}}">Cadastrar Jornada de Trabalho</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('indexMotorista')}}">Cadastrar Motorista</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('indexRelatorioMotorista')}}">Gerar Relatório de Motorista</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('indexCacamba')}}">Cadastrar Caçamba</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('indexPrazo')}}">Atribuir Prazo</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('indexTipoEntulho')}}">Cadastrar Tipo de Entulho</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('indexOrdemColeta')}}">Cadastrar Ordem de Coleta</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('vencimentoCnh')}}">Verificar Cnh Vencida</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('indexHorasTrabalhadas')}}">Horas Trabalhadas</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('indexQuilometrosRodados')}}">Quilometros Rodados</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('indexRelatorioTrafego')}}">Relatorio Trafegos</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection