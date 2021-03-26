@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
            <li class="active">{{ $title }}</li>
        </ul>
        <a href="{{ route('createTipoPreventiva') }}" class="btn btn-success"> Novo</a>
        <div>
            <table class="table">
                <tr>
                    <th>Preventiva</th>
                    <th>Ação</th>
                </tr>
                @foreach ($tiposPreventiva as $tipo)
                    <tr>
                        <td>{{$tipo->nome}}</td>
                        <td><a href="{{ route('editTipoPreventiva', $tipo->id) }}" class="btn btn-warning" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
                    </tr>
                @endforeach
            </table>
        </div>
        {!! $tiposPreventiva->links() !!}
    </div>
@endsection