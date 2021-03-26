@extends('layouts.app')

@section('content')
    <style>
        .input-length{
            width: 25vw;
        }
    </style>

    <title>{{$title}}</title>
    <div>
        <ul class="breadcrumb">
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
    @if(session('success')) <div class="alert alert-success"> {{session('success')}} </div> @endif
    <form method="post" action="{{route('storeAbastecimentoManual')}}">
        {{csrf_field()}}

        <div>Veículo</div>
        <div>
            <select name="veiculo_id" id="veiculos" class="col-md-4">
                <option value="">Selecione o Veículo</option>
                @foreach($veiculos as $veiculo)
                    <option value="{{$veiculo->id}}"
                    @if($veiculo->id == old('veiculo_id'))
                        selected
                    @endif
                    >{{$veiculo->placa}}</option>
                @endforeach
            </select>
        </div>

        <div>Servidor</div>
        <div>
            <select name="motorista" id="motoristas" class="col-md-4">
                <option value="">Selecione o Servidor</option>
                @foreach($motoristas as $motorista)
                    <option value="{{$motorista->nome}}"
                    @if($motorista->nome == old('motorista'))
                        selected
                    @endif
                    >{{$motorista->nome}}</option>
                @endforeach
            </select>
        </div>

        <div>Posto</div>
        <div>
            <select name="posto_id" id="postos" class="col-md-4">
                <option value="">Selecione o Posto</option>
                @foreach($postos as $posto)
                    <option value="{{$posto->id}}"
                    @if($posto->id == old('posto_id'))
                        selected
                    @endif
                    >{{$posto->nome_fantasia}}</option>
                @endforeach
            </select>
        </div>

        <div>Frentista</div>
        <div>
            <select name="frentista_nome" id="frentistas" class="col-md-4">
                <option value="">Selecione o Frentista</option>
                @foreach($frentistas as $frentista)
                    <option value="{{$frentista->nome}}"
                    @if($frentista->nome == old('frentista_nome'))
                        selected
                    @endif
                    >{{$frentista->nome}}</option>
                @endforeach
            </select>
        </div>

        <div>Combustível</div>
        <div>
            <select name="tipo_combustivel" id="combustiveis" class="col-md-4">
                <option value="">Selecione o Combustível</option>
                @foreach($combustiveis as $combustivel)
                    <option value="{{$combustivel->descricao}}"
                    @if($combustivel->descricao == old('tipo_combustivel'))
                        selected
                    @endif
                    >{{$combustivel->descricao}}</option>
                @endforeach
            </select>
        </div>

        <div>Valor Unitário</div>
        <div>
            <input class="input-length" value="{{old('valor_unitario')}}" name="valor_unitario" id="valor_unitario" type="text"/>R$
        </div>

        <div>Litros</div>
        <div>
            <input class="input-length" value="{{old('litros')}}" name="litros" id="litros" type="text"/>
        </div>

        <div>Kilometragem</div>
        <div>
            <input class="input-length" value="{{old('kilometragem')}}" name="kilometragem" type="text"/>
        </div>

        <div>Data</div>
        <div>
            <input class="input-length" value="{{old('data')}}" name="data" type="date"/>
        </div>

        <div>Motivo da Inserção</div>
        <div>
            <input class="input-length" value="{{old('motivo')}}" name="motivo" type="text"/>
        </div>

        <br>
        <div>
            <button class="btn btn-success">Salvar</button>
        </div>
    </form>

    <script>
        $(document).ready(function(){
            $("#veiculos").select2();
            $("#motoristas").select2();
            $("#combustiveis").select2();
            $("#postos").select2();
            $("#frentistas").select2();
            $("#valor_unitario, #litros").inputmask('decimal', {
                'alias': 'numeric',
                'groupSeparator': '.',
                'autoGroup': true,
                'digits': 2,
                'radixPoint': ',',
                'digitsOptional': false,
                'allowMinus': false,
            });
        });
    </script>
@endsection