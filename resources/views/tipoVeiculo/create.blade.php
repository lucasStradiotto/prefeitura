@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div>
        <ul class="breadcrumb">
            {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
            <li><a href="{{ route('indexTipoVeiculo') }}">Grupos de Veículos</a></li>
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
        @if(isset($tipoVeiculo))
            <form class="container" method="post" action="{{ route('updateTipoVeiculo', $tipoVeiculo->id) }}">
                {!! method_field('PUT') !!}
                @else
                    <form class="container" method="post" action="{{ route('storeTipoVeiculo') }}">
                        @endif
                        {!! csrf_field() !!}
                        <div>
                            Nome
                        </div>
                        <div>
                            <input name="nome" value="{{$tipoVeiculo->nome or old('nome')}}">
                        </div>

                        <div>
                            Instrumento de Medida
                        </div>
                        <div>
                            <select name="instrumento_medida">
                                <option value="">Selecione o Instrumento</option>
                                <option value="Hodômetro"
                                    @if (isset($tipoVeiculo) && $tipoVeiculo->instrumento_medida == 'Hodômetro')
                                        selected
                                    @endif
                                >Hodômetro</option>
                                <option value="Horímetro"
                                    @if (isset($tipoVeiculo) && $tipoVeiculo->instrumento_medida == 'Horímetro')
                                        selected
                                    @endif
                                >Horímetro</option>
                            </select>
                        </div>

                        <div style="margin-top: 50px;">
                            Selecione o ícone
                        </div>

                        <div>
                            <svg viewBox="0 0 1000 900" style="width:100px; height: 100px; zoom: 0.5;" class="svg-white">
                                @include('tipoVeiculo.svg.ambulanciaPin')
                            </svg>
                            <svg viewBox="0 0 1000 900" style="width:100px; height: 100px; zoom: 0.5;" class="svg-white">
                                @include('tipoVeiculo.svg.motoPin')
                            </svg>
                            <svg viewBox="0 0 1000 900" style="width:100px; height: 100px; zoom: 0.5;" class="svg-white">
                                @include('tipoVeiculo.svg.onibusPin')
                            </svg>
                            <svg viewBox="0 0 1000 900" style="width:100px; height: 100px; zoom: 0.5;" class="svg-white">
                                @include('tipoVeiculo.svg.tratorPin')
                            </svg>
                            <svg viewBox="0 -700 1000 900" style="width: 100px; height: 100px; zoom: 0.5;" class="svg-black">
                                @include('tipoVeiculo.svg.caminhao')
                            </svg>
                            <svg viewBox="0 0 1000 900" style="width:100px; height: 100px; zoom: 0.5;" class="svg-white">
                                @include('tipoVeiculo.svg.carro')
                            </svg>
                        </div>

                        <div>
                            <input name="icone" value="ambulancia" style="width: 70px;" type="radio"/>
                            <input name="icone" value="moto" style="width: 130px;" type="radio"/>
                            <input name="icone" value="onibus" style="width: 70px;" type="radio"/>
                            <input name="icone" value="trator" style="width: 130px;" type="radio"/>
                            <input name="icone" value="caminhao" style="width: 70px;" type="radio"/>
                            <input name="icone" value="carro" style="width: 130px;" type="radio"/>
                        </div>
                        <button class="btn btn-success">Enviar</button>

                    </form>
    </div>
@endsection