@extends('layouts.app')

@section('content')
    <style>
        .container-image {
            display: inline-flex;
            flex-wrap: wrap;
            width: 100%;
        }

        .each-image {
            border: solid 1px black;
            border-radius: 10px;
            width: 30%;
            margin: 1% 1%;
        }

        .each-image img {
            max-width: 100%;
            max-height: 100%;
            border-radius: 10px;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb no-print">
            <li><a href="{{ route('indexSolicitacoesPodaRetirada') }}">Lista de solicitações de poda e supressão</a></li>
            <li class="active">{{ $title }}</li>
        </ul>
    </div>
    @if(isset($errors) && count($errors) > 0)
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>{{$error}}</p>
            @endforeach
        </div>
    @endif
    <div class="container">
        <div>
            <button id="btn-imprimir" class="no-print btn btn-primary col-md-2 col-md-offset-10">Imprimir</button>
        </div>
        <div>
            <h2 class="text-center">{{$solicitacao->tipo_solicitacao}}</h2>
            <div>
                <div>
                    <p><strong>CEP: </strong>{{$solicitacao->cep}}</p>
                    <p><strong>Endereço: </strong>{{$solicitacao->endereco}}</p>
                    <p><strong>Solicitante: </strong>{{$solicitacao->nome_solicitante}}</p>
                    <p><strong>CPF: </strong>{{$solicitacao->cpf}}</p>
                    <p><strong>Quantidade de árvores: </strong>{{$solicitacao->qtd_arvores}}</p>
                    <p><strong>Telefone para contato: </strong>{{$solicitacao->telefone_solicitante}}</p>
                </div>
                <h3 class="text-center">Fotos</h3>
                <div class="container-image">
                    @foreach($solicitacao->Imagens as $imagem)
                        <div class="each-image">
                            @if (in_array($imagem->tipo_imagem, ["Cpf", "Rg", "Iptu"]))
                                <p class="text-center">{{$imagem->tipo_imagem}}</p>
                            @endif
                            <img src="{{$imagem->caminho}}"/>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#btn-imprimir").click(function() {
                window.print();
            });
        });
    </script>
@endsection