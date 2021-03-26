@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div>
        <ul class="breadcrumb">
            {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
            <li><a href="{{ route('indexSecretaria') }}">Secretarías</a></li>
            <li class="active">{{ $title }}</li>
        </ul>
    </div>
    @if(isset($errors) && count($errors) > 0)
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>{{$error}}</p>
            @endforeach
        </div>
    @endif
    <div>
        @if(isset($secretaria))
            <form class="container" method="post" action="{{ route('updateSecretaria', $secretaria->id) }}">
            {!! method_field('PUT') !!}
        @else
            <form class="container" method="post" action="{{ route('storeSecretaria') }}">
                @endif
                {!! csrf_field() !!}
                <div>
                    Nome
                </div>
                <div>
                    <input name="nome" value="{{$secretaria->nome or old('nome')}}">
                </div>
                <div>
                    Horário Programado
                </div>
                <div>
                    <select name="horario_programado_id">
                        <option value="">Selecione o Horário Programado para esta Secretaria</option>
                        @foreach($horariosProgramados as $horario)
                            <option value="{{$horario->id}}">
                                {{$horario->inicio}} - {{$horario->fim}}
                            </option>
                        @endforeach
                    </select>
                    <a href="{{ route('createHorarioProgramado') }}" target="_blank" class="btn btn-success" title="Criar Novo"><i class="glyphicon glyphicon-plus"></i></a>
                </div>
                {{-- <div>
                    Secretaria Pai
                </div>
                <div>
                    <select name="parent_id" id="parent_id">
                        <option value="0"></option>
                        @foreach ($secretariasPai as $secretariaPai)
                            <option value="{{$secretariaPai->id}}" {{(isset($secretaria->parent_id) && $secretaria->parent_id == $secretariaPai->id) ? "selected" : ""}}>
                                {{$secretariaPai->nome}}
                            </option>
                        @endforeach
                    </select>
                </div> --}}
                <button class="btn btn-success">Enviar</button>

            </form>
    </div>

    {{-- <script>
        $(document).ready(function () {
            $('#parent_id').select2();
        });
    </script> --}}
@endsection