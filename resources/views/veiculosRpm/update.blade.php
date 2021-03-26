@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div>
        <ul class="breadcrumb">
            <li><a href="{{ route('veiculosRpm') }}">Alterar o Rpm</a></li>
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
        <form class="container" method="post" action="{{route('updatedVeiculosRpm')}}">
            <div id="container">
                <label for="placaVeiculo">Veículo (Placa)</label>
                <input type="text" name="placaVeiculo" disabled value="{{$veiculo[0]->placa}}">
                <br>
                <label for="novoRpm">Novo Rpm</label>
                <input type="text" name="novoRpm">
                <br>
                <input type="hidden" name="idVeiculo" value="{{$idVeiculo}}">
                <button class="btn btn-success">Enviar</button>
            </div>
        </form>
    </div>
@endsection