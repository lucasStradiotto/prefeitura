@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
            <li class="active">{{ $title }}</li>
        </ul>
        <a href="{{ route('createTipoAssunto') }}" class="btn btn-success"> Novo</a>
        <div>
            <table class="table">
                <tr>
                    <th>Grupo de Assuntos</th>
                    <th>Ação</th>
                </tr>
                @foreach ($tipoAssuntos as $tipoAssunto)
                <tr>
                    <td>{{$tipoAssunto->grupo}}</td>
                    <td><a href="{{ route('editTipoAssunto', $tipoAssunto->id) }}" class="btn btn-warning" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
                </tr>
                @endforeach
            </table>
        </div>
        {!! $tipoAssuntos->links() !!}
    </div>
@endsection