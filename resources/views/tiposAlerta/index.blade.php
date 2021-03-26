@extends('layouts.app')

@section('content')

    <title>Listagem de Tipos de Alerta</title>

    <div class="container">
        <ul class="breadcrumb">
            <li class="active">Listagem de Tipos de Alerta</li>
        </ul>
        <a href="{{ route('tiposAlerta.create') }}" class="btn btn-success"> Novo</a>
        <div>
            <table class="table">
                <tr>
                    <th>Tipo de Alerta</th>
                    <th>Enviar notificação push?</th>
                </tr>
                @foreach ($tiposAlerta as $tipoAlerta)
                    <tr>
                        <td>{{$tipoAlerta->tipo}}</td>
                        <td>{{$tipoAlerta->push ? "Sim" : "Não"}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
        {!! $tiposAlerta->links() !!}
    </div>
@endsection