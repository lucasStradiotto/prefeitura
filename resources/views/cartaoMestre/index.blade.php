@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            {{--<li><a href="{{ route('home_entulho') }}">Parâmetros</a></li>--}}
            <li class="active">{{ $title }}</li>
        </ul>
        <a href="{{ route('createCartaoMestre') }}" class="btn btn-success"> Novo</a>
        <div>
            <table class="table">
                <tr>
                    <th>Número</th>
                    <th>Ação</th>
                </tr>
                @foreach ($cartaoMestres as $cartaoMestre)
                    <tr>
                        <td>{{$cartaoMestre->numero}}</td>
                        <td><a href="{{ route('editCartaoMestre', $cartaoMestre->id) }}" class="btn btn-warning" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection