@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
            <li class="active">{{ $title }}</li>
        </ul>
        <a href="{{ route('createVerticeCerca') }}" class="btn btn-success"> Novo</a>
        <div>
            <table class="table">
                <tr>
                    <th>Cerca</th>
                    {{--<th>Ação</th>--}}
                </tr>
                @foreach ($cercas as $cerca)
                    <tr>
                        <td>{{$cerca->nome}}</td>
                        {{--<td><a href="{{ route('editVerticeCerca', $cerca->id) }}" class="btn btn-warning" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>--}}
                    </tr>
                @endforeach
            </table>
        </div>
        {!! $cercas->links() !!}
    </div>
@endsection