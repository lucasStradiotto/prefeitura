@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            <li class="active">{{ $title }}</li>
        </ul>
        <a style="margin-bottom: 20px;" href="{{ route('abastecimentoAgua.create') }}" class="btn btn-success"> Novo</a>
        <div>
            <table class="table">
                <tr>
                    <th>Abastecimento</th>
                    <th>Ação</th>
                </tr>
                @foreach ($abastecimento as $ab)
                    <tr>
                        <td>{{$ab->tipo_abastecimento}}</td>
                        <td>
                            <a href="{{ route('abastecimentoAgua.edit', array($ab->tipo_abastecimento, $ab->id)) }}" class="btn btn-warning" title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
                            <a href="{{ route('abastecimentoAgua.delete', array($ab->id)) }}" class="btn btn-danger" title="Excluir"><i class="glyphicon glyphicon-remove"></i></a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>

        @if(count($abastecimento) > 9)
            {{ $abastecimento->links() }}
        @endif
    </div>
@endsection