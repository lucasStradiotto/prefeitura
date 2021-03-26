@extends('layouts.app')

@section('content')
    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            <li class="active">{{ $title }}</li>
        </ul>
        @if(isset($errors) && count($errors) > 0)
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <p>{{$error}}</p>
                @endforeach
            </div>
        @endif
        <form action="{{route('updateGed', $ged->id)}}" method="post" enctype="multipart/form-data">
            {!! csrf_field() !!}
            {!! method_field('PUT') !!}
            <div>Nome do arquivo</div>
            <div>
                <input value="{{$ged->nome_arquivo or old('nome_arquivo')}}" name="nome_arquivo" type="text"/>
            </div>

            <div>Secretarias</div>
            <div>
                <select name="secretaria_id" id="secretaria_id">
                    <option value="">Selecione a Secretaria</option>
                    @foreach($secretarias as $sec)
                        <option value="{{$sec->secretaria->id}}"
                        @if($sec->secretaria->nome === $ged->secretaria)
                            selected
                        @endif
                        >{{$sec->secretaria->nome}}</option>
                    @endforeach
                </select>
            </div>

            <div id="obs"></div>

            <button class="btn btn-success">Enviar</button>
        </form>
    </div>

    <script>
        $(document).ready(function(){
            $("#secretaria_id").change(function(){
                $.getJSON("{{route('getObservacoes')}}", {
                    secretaria_id: $("#secretaria_id").val()
                }, function(data){
                    if (data.length === 0)
                        $("#obs").empty();
                    else
                    {
                        $.getJSON("{{route('getObservacoesPreenchidas')}}", {
                            ged_id: "{{$ged->id}}"
                        }, function(obs_preenchidas){
                            let toAppend = '';
                            $.each(data, function (index, obj){
                                let isFilled = false;
                                let valor_obs = '';
                                $.each(obs_preenchidas, function (index, obs){
                                    if (obs.nome_observacao == obj.nome_observacao)
                                    {
                                        valor_obs = obs.valor_observacao;
                                        isFilled = true;
                                    }
                                });
                                toAppend += '<div>' + obj.nome_observacao + '</div>';
                                if (isFilled)
                                    toAppend += '<input type="text" name="obs[]" value="'+valor_obs+'"/>';
                                else
                                    toAppend += '<input type="text" name="obs[]"/>';
                                toAppend += '<input type="hidden" name="nome_obs[]" value="' + obj.nome_observacao + '"/>';
                                isFilled = false;
                            });
                            $("#obs").empty().append(toAppend);
                        });
                    }
                });
            });
            $("#secretaria_id").change();
        });
    </script>
@endsection