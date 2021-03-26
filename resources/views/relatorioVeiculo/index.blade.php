@extends('layouts.app')

@section('content')

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
    <div>
        <form action="{{route('gerarRelatorioVeiculo')}}">
            <div>
                Inicio
            </div>
            <div>
                <input value="{{old('inicio')}}" type="date" name="inicio">
                <input value="" type="time" name="hora_inicio">
            </div>
            <div>
                Fim
            </div>
            <div>
                <input value="{{old('fim')}}" type="date" name="fim">
                <input value="" type="time" name="hora_fim">
            </div>
            <div>
                Veículo
            </div>
            <div>
                <select name="veiculo_id" id="slc-veiculo" name="veiculo_id">
                    <option value="">Escolha o veículo</option>
                    @foreach($veiculos as $veiculo)
                        <option value="{{$veiculo->id}}">{{$veiculo->placa}}</option>
                    @endforeach
                </select>
            </div>
            <button class="btn btn-success">Enviar</button>
        </form>
    </div>
    <script>
        $(document).ready(function(){
            $("#slc-veiculo").select2();
        });
    </script>
@endsection