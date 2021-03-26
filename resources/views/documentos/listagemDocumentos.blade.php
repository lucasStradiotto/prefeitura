@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            <li class="active">{{ $title }}</li>
        </ul>
        <div>
            <table class="table">
                <tr>
                    <th>Número</th>
                    <th>Tipo do Documento</th>
                    <th>Gerar Segunda via</th>
                </tr>
                @foreach ($documentos as $documento)
                    <tr>
                        <td>
                            {{$documento->numero_documento}}
                        </td>
                        <td>
                            {{$documento->tipo_documento}}
                        </td>
                        <td>
                            <a href="{{ route('emitirSegundaVia', $documento->id) }}" class="btn btn-primary" title="Editar"><i class="glyphicon glyphicon-duplicate"></i></a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        {!! $documentos->links() !!}
    </div>
@endsection