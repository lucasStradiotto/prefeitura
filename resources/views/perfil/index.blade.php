@extends('layouts.app')

@section('content')

    <div class="container">
        <ul class="breadcrumb">
            <li class="active">Perfil</li>
        </ul>
        <a href="{{ route('perfil.create') }}" class="btn btn-success"> Novo</a>
        <div>
            <table class="table">
                <tr>
                    <th>Nome</th>
                    <th>Nome Extenso</th>
                    <th>Descrição</th>
                    <th></th>
                </tr>
                @foreach($perfis as $perfil)
                    <tr>
                        <td>{{ $perfil->name }}</td>
                        <td>{{ $perfil->display_name }}</td>
                        <td>{{ $perfil->description }}</td>
                        <td>
                            <a href="{{ route('perfil.edit', $perfil->id) }}" class="btn btn-warning" title="Editar">
                                <i class="glyphicon glyphicon-edit"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

@endsection