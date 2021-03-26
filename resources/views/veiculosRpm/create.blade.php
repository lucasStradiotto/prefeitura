@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div>
        <ul class="breadcrumb">
            <li><a href="{{ route('veiculosRpm') }}">Veículos Rpm</a></li>
            <li class="active">{{ $title }}</li>
        </ul>
    </div>
    {{--@if(isset($errors) && count($errors) > 0)--}}
        {{--<div class="alert alert-danger">--}}
            {{--@foreach($errors->all() as $error)--}}
                {{--<p>{{$error}}</p>--}}
            {{--@endforeach--}}
        {{--</div>--}}
    {{--@endif--}}
    <div>
        <form class="container" method="post" action="{{route('storeVeiculosRpm')}}">
            <div id="container">
                <label for="rpm">Rpm Padrão</label>
                <input type="number" name="rpm" placeholder="somente números">
                <br>
                <label for="veiculo_id">Veículo</label>
                <select name="veiculo_id">
                    <option>Selecione um veículo</option>
                    @foreach($veiculos as $veiculo)
                        <option value="{{$veiculo->id}}">{{$veiculo->placa}}</option>
                    @endforeach
                </select>
                <br>
                <button class="btn btn-success">Enviar</button>
            </div>
        </form>
    </div>
@endsection