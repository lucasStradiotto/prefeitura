@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
            <li class="active">{{ $title }}</li>
        </ul>
        <a href="{{ route('createTipoExame') }}" class="btn btn-success"> Novo</a>
        <div>
            <table class="table">
                <tr>
                    <th>Grupo de Exame</th>
                    <th>Ação</th>
                </tr>
                @foreach ($tiposExame as $tipo)
                    <tr>
                        <td>{{$tipo->nome}}</td>
                        <td><a href="{{ route('editTipoExame', $tipo->id) }}" class="btn btn-warning" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
                    </tr>
                @endforeach
            </table>
        </div>
        {!! $tiposExame->links() !!}
    </div>
@endsection