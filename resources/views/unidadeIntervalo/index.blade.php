@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
            <li class="active">{{ $title }}</li>
        </ul>
        <a href="{{ route('createUnidadeIntervalo') }}" class="btn btn-success"> Novo</a>
        <div>
            <table class="table">
                <tr>
                    <th>Unidades de Intervalo</th>
                    <th>Ação</th>
                </tr>
                @foreach ($unidadesIntervalo as $unidadeIntervalo)
                    <tr>
                        <td>{{$unidadeIntervalo->nome}}</td>
                        <td><a href="{{ route('editUnidadeIntervalo', $unidadeIntervalo->id) }}" class="btn btn-warning" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
                    </tr>
                @endforeach
            </table>
        </div>
        {!! $unidadesIntervalo->links() !!}
    </div>
@endsection