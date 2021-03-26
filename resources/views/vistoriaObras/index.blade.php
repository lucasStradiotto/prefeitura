@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div class="container">
        <div>
            <table class="table">
                <tr>
                    <th>Proprietário</th>
                    <th>Rua</th>
                    <th>SQL</th>
                    <th>Ação</th>
                </tr>
                @foreach ($vistorias as $vistoria)
                    <tr>
                        <td>{{$vistoria->proprietario}}</td>
                        <td>{{$vistoria->rua}}</td>
                        <td>{{$vistoria->setor}} - {{$vistoria->quadra}} - {{$vistoria->lote}}</td>
                        <td><a href="{{ route('detailsVistoriaObras', $vistoria->id) }}" class="btn btn-primary" title="Detalhes"><i class="glyphicon glyphicon-search"></i></a></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection