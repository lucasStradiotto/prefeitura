@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
            <li><a href="{{ route('indexProtocolo') }}">Protocolos</a></li>
            <li class="active">{{ $title }}</li>
        </ul>
        @if (\Illuminate\Support\Facades\Auth::user()->hasRole('protocolos-obras'))
            <a href="{{route('createAnexarDocumento', $protocoloId)}}" class="btn btn-success"> Novo</a>
        @endif
        <div>
            <table class="table">
                <tr>
                    <th>Número</th>
                    <th>Assunto</th>
                    <th>Proprietário</th>
                    <th>Status</th>
                </tr>
                <tr>
                    <td>{{$protocolo->l}}</td>
                    <td>{{$protocolo->assunto}}</td>
                    <td>{{$protocolo->proprietario}}</td>
                    <td>{{$protocolo->status}}</td>
                </tr>
            </table>
            <h1>Documentos</h1>
            @foreach ($docAnex as $anex)
                <div>
                    <p>
                        <span>{{$anex->created_at->format('d/m/Y')}}</span>
                        <a href="{{route('showAnexarDocumento', $param = [$protocolo->id, $anex->caminho])}}" target="_blank"> <i class="glyphicon glyphicon-file"></i> {{$anex->caminho}}</a>
                    </p>
                </div>
            @endforeach
        </div>
    </div>
@endsection