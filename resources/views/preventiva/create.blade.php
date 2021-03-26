@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div>
        <ul class="breadcrumb">
            {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
            <li><a href="{{ route('indexPreventiva') }}">Preventivas</a></li>
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
    <div>
        @if(isset($preventiva))
            <form class="container" method="post" action="{{ route('updatePreventiva', $preventiva->id) }}">
                {!! method_field('PUT') !!}
                @else
                    <form class="container" method="post" action="{{ route('storePreventiva') }}">
                        @endif
                        {!! csrf_field() !!}
                        <div>
                            Veículo
                        </div>
                        <div>
                            <select id="slcVeiculo" name="veiculo_id">
                                <option value="">Selecione o Veículo</option>
                                @foreach ($veiculos as $veiculo)
                                    <option value="{{$veiculo->id}}"
                                            @if (isset($preventiva))
                                                @if ($veiculo->id == $preventiva->veiculo_id)
                                                    selected
                                                @endif
                                            @endif
                                    >{{$veiculo->placa}}</option>
                                @endforeach
                            </select>
                            <a href="{{ route('createVeiculo') }}" target="_blank" class="btn btn-success" title="Criar Novo"><i class="glyphicon glyphicon-plus"></i></a>
                        </div>
                        <div>
                            Modelo
                        </div>
                        <div>
                            <input disabled id="modeloVeiculo" value="">
                        </div>
                        <div>
                            Cor
                        </div>
                        <div>
                            <input disabled id="corVeiculo" value="">
                        </div>
                        <div>
                            Tipo de Preventiva
                        </div>
                        <div>
                            <select name="tipo_preventiva_id">
                                <option value="">Selecione o Tipo de Preventiva</option>
                                @foreach ($tiposPreventiva as $tipoPreventiva)
                                    <option value="{{$tipoPreventiva->id}}"
                                            @if (isset($preventiva))
                                                @if ($tipoPreventiva->id == $preventiva->tipo_preventiva_id)
                                                    selected
                                                @endif
                                            @endif
                                    >{{$tipoPreventiva->nome}}</option>
                                @endforeach
                            </select>
                            <a href="{{ route('createTipoPreventiva') }}" target="_blank" class="btn btn-success" title="Criar Novo"><i class="glyphicon glyphicon-plus"></i></a>
                        </div>
                        <div>
                            Intervalo
                        </div>
                        <div>
                            <input name="intervalo" value="{{$preventiva->intervalo or old('intervalo')}}">
                                <select name="unidade_intervalo_id">
                                    <option value="">Unidade</option>
                                    @foreach ($unidadesIntervalo as $unidadeIntervalo)
                                        <option value="{{$unidadeIntervalo->id}}"
                                                @if (isset($preventiva))
                                                    @if ($unidadeIntervalo->id == $preventiva->unidade_intervalo_id)
                                                        selected
                                                    @endif
                                                @endif
                                        >{{$unidadeIntervalo->nome}}</option>
                                    @endforeach
                                </select>
                            <a href="{{ route('createUnidadeIntervalo') }}" target="_blank" class="btn btn-success" title="Criar Novo"><i class="glyphicon glyphicon-plus"></i></a>
                        </div>
                        <div>
                            Data da Última Manutenção Realizada
                        </div>
                        <div>
                            <input type="date" name="data_ultima_manutencao" value=
                            @if (isset($preventiva))
                                "{{$preventiva->data_ultima_manutencao->format('Y-m-d')}}">
                            @else
                                "{{old('data_ultima_manutencao')}}">
                            @endif
                        </div>
                        <input type="hidden" name="visto" value="0"/>
                        <button class="btn btn-success">Enviar</button>

                    </form>
    </div>
    <script>
        $(document).ready(function() {
            $(document).on("change", "#slcVeiculo", function (e) {
                e.preventDefault();

                $.getJSON("{{ route('getVeiculoEspecifico') }}", {
                    veiculo_id: $(this).val()
                }, function (data, textStatus, jqXHR) {
                    $.each(data, function (indice, veiculo) {
                        $("#modeloVeiculo").val(veiculo.modelo);
                        $("#corVeiculo").val(veiculo.cor);
                    });
                });
            });
            $("#slcVeiculo").trigger("change");
        });
    </script>
@endsection