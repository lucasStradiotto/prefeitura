@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard Manutenção</div>

                    <div class="panel-body">
                        <p>
                            <a class="btn btn-success" href="{{route('indexTipoPadroes')}}">Cadastrar Tipo de Padrões</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('indexTipoExame')}}">Cadastrar Grupo de Exames</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('indexPadrao')}}">Cadastrar Padrão</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('indexExame')}}">Cadastrar Exame</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('indexSecretaria')}}">Cadastrar Secretaría</a>
                        </p>
                        <hr>
                        <p>
                            <a class="btn btn-success" href="{{route('indexTipoPreventiva')}}">Cadastrar Tipo de Preventiva</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('indexUnidadeIntervalo')}}">Cadastrar Unidade de Intervalo</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('indexPreventiva')}}">Cadastrar Preventiva</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('indexCronogramaManutencao')}}">Cronograma de Manutenção</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('indexPreventivaPendente')}}">Preventivas Pendentes</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('indexVeiculosExames')}}">Exames Relacionados aos Veículos</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('indexCorretiva')}}">Manutenção Corretivas</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('indexRelatorioManutencao')}}">Gerar Relatório de Manutenções</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection