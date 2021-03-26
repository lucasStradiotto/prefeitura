@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard Iluminação</div>

                    <div class="panel-body">
                        <p>
                            <a class="btn btn-success" href="{{route('indexAnomalia')}}">Anomalia</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('indexStatusSolicitacao')}}">Status da Solicitação</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('indexSolicitacaoRedeEletrica')}}">Solicitação de Intervenção</a>
                        </p>
                        <p>
                            <a class="btn btn-success" href="{{route('indexManutencaoEletrica')}}">Ordem de Serviço Manutenção de Rede Elétrica</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection