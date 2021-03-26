@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            <li class="active">{{ $title }}</li>
        </ul>
        <a style="margin-bottom: 20px;" href="{{ route('pisoInterno.create') }}" class="btn btn-success"> Novo</a>
        <div>
            <table class="table">
                <tr>
                    <th>Pisos Internos</th>
                    <th>Ação</th>
                </tr>
                @foreach ($pisos as $piso)
                    <tr>
                        <td>{{$piso->tipo_piso}}</td>
                        <td>
                            <a href="{{ route('pisoInterno.edit', array($piso->tipo_piso, $piso->id)) }}" class="btn btn-warning" title="Editar"><i class="glyphicon glyphicon-edit"></i></a>
                            <a href="{{ route('pisoInterno.delete', array($piso->id)) }}" class="btn btn-danger" title="Excluir"><i class="glyphicon glyphicon-remove"></i></a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>

        @if(count($pisos) > 9)
            {{ $pisos->links() }}
        @endif
    </div>
@endsection