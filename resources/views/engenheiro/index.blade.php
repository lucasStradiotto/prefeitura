@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
            <li class="active">{{ $title }}</li>
        </ul>
        <a href="{{ route('createEngenheiro') }}" class="btn btn-success"> Novo</a>
        <div>
            <table class="table">
                <tr>
                    <th>Engenheiro</th>
                    <th>Ação</th>
                </tr>
                @foreach ($engenheiros as $engenheiro)
                    <tr>
                        <td>{{$engenheiro->nome}}</td>
                        <td><a href="{{ route('editEngenheiro', $engenheiro->id) }}" class="btn btn-warning" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
                    </tr>
                @endforeach
            </table>
        </div>
        {!! $engenheiros->links() !!}
    </div>
@endsection