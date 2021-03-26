@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            {{--<li><a href="{{ route('home_entulho') }}">Parâmetros</a></li>--}}
            <li class="active">{{ $title }}</li>
        </ul>
        <a href="{{ route('createEmpresa') }}" class="btn btn-success"> Novo</a>
        <div>
            <table class="table">
                <tr>
                    <th>Nome Fantasia</th>
                    <th>Razão Social</th>
                    <th>Responsável</th>
                    <th>Ação</th>
                </tr>
                @foreach ($empresas as $empresa)
                    <tr>
                        <td>{{$empresa->nome_fantasia}}</td>
                        <td>{{$empresa->razao_social}}</td>
                        <td>{{$empresa->responsavel}}</td>
                        <td><a href="{{ route('editEmpresa', $empresa->id) }}" class="btn btn-warning" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
                    </tr>
                @endforeach
            </table>
        </div>
        {!! $empresas->links() !!}
    </div>
@endsection