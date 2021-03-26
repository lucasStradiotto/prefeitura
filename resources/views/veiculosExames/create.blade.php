@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div>
        <ul class="breadcrumb">
            {{--<li><a href="{{ route('home_entulho') }}">Parâmetros</a></li>--}}
            <li><a href="{{ route('indexVeiculosExames') }}">Veículos</a></li>
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
        @if(isset($veiculo))
            <form class="container" method="post" action="{{ route('updateVeiculo', $veiculo->id) }}">
                {!! method_field('PUT') !!}
                @else
                    <form class="container" method="post" action="{{ route('storeVeiculosExames') }}">
                        @endif
                        {!! csrf_field() !!}
                        <div>
                            Veículo
                        </div>
                        <div>
                            <select name="veiculo_id">
                                <option value="">Selecione o Veículo</option>
                                @foreach($veiculos as $veiculo)
                                    <option value="{{$veiculo->id}}"
                                            @if (isset($veiculoExame) && $veiculo->id == $veiculoExame->veiculo_id)
                                            selected
                                            @endif
                                    >{{$veiculo->placa}}</option>
                                @endforeach
                            </select>
                            <a href="{{ route('createVeiculo') }}" target="_blank" class="btn btn-success" title="Criar Novo"><i class="glyphicon glyphicon-plus"></i></a>
                        </div>
                        <div>
                            <table class="table">
                                <tr>
                                    <th>Exames</th>
                                    <th>Adicionar</th>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td><input type="checkbox" id="checkPai"/> Selecionar Todos</td>
                                </tr>
                                @foreach($exames as $exame)
                                    <tr>
                                        <td>{{$exame->nome}}</td>
                                        <td><input type="checkbox" name="exame_id_{{$exame->id}}" id="exame_id_{{$exame->id}}" value="{{$exame->id}}"/> </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        <button class="btn btn-success" id="btnEnviar" disabled="true">Adicionar</button>
                    </form>
    </div>

    <script>
        $(document).ready(function(){
            $("#checkPai").click(function(){
                $('input:checkbox').not(this).prop('checked', this.checked);
                $("input:checkbox").change();
            });
            $('input:checkbox').click(function(){
                if ($('input:checkbox:checked').not($("#checkPai")).length > 0)
                    $("#btnEnviar").removeAttr('disabled');
                else
                    $("#btnEnviar").attr('disabled', true);
            })
        })
    </script>
@endsection