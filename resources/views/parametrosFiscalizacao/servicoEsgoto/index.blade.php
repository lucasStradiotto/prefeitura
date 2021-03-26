@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            <li class="active">{{ $title }}</li>
        </ul>
        <a style="margin-bottom: 20px;" href="{{ route('servicoEsgoto.create') }}" class="btn btn-success">Novo</a>
        <div>
            <table class="table">
                <tr>
                    <th>Esgoto</th>
                    <th>Ação</th>
                </tr>
                @foreach ($servicosEsgoto as $servico)
                    <tr>
                        <td>{{$servico->tipo_esgoto}}</td>
                        <td>
                            <a href="{{ route('servicoEsgoto.edit', array($servico->tipo_esgoto, $servico->id)) }}" class="btn btn-warning" title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
                            <a href="{{ route('servicoEsgoto.delete', array($servico->id)) }}" class="btn btn-danger" title="Excluir"><i class="glyphicon glyphicon-remove"></i></a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>

        @if(count($servicosEsgoto) > 9)
            {{ $servicosEsgoto->links() }}
        @endif
    </div>
@endsection