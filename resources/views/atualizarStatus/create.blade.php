@extends('layouts.app')

@section('content')
    <style>
        /*.hidden-div{*/
            /*display: none;*/
        /*}*/
        .shown-div{
            display: block;
        }
    </style>

    <title>{{$title}}</title>

    <div>
        <ul class="breadcrumb">
            {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
            <li><a href="{{ route('indexAtualizarStatus') }}">Atualizar Status</a></li>
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
        <form class="container" method="post" action="{{route('updateAtualizarStatus', $protocolo->id)}}">
            {!! method_field('PUT') !!}
            {!! csrf_field() !!}
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
                <h2>Novo Status</h2>
                <select name="status" class="col-md-2 col-sm-2" id="slc-status">
                    @foreach ($status as $stat)
                        <option value="{{$stat->nome}}">{{$stat->nome}}</option>
                    @endforeach
                </select>
            </div>
            &nbsp;
            <button class="btn btn-success" title="Atualizar"><i class="glyphicon glyphicon-refresh"></i></button>
            <div id="div-obs" class="shown-div">
                <div>
                    Obs:
                </div>
                <div>
                    {{--<input name="observacaoStatus" value="{{$protocolo->observacaoStatus or old('observacaoStatus')}}">--}}
                    <textarea name="observacaoStatus">{{$protocolo->observacaoStatus or old('observacaoStatus')}}</textarea>
                </div>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function(){
            $("select").select2();

            // $("#slc-status").change(function(){
                // let $div = $("#div-obs");
                // if (($(this).val().match(/Pendencia/))||
                //     ($(this).val().match(/Reprovado/))||
                //     ($(this).val().match(/Pendência/))||
                //     ($(this).val().match(/Comunique/)))
                // {
                //     $div.removeClass("hidden-div");
                //     $div.addClass("shown-div");
                // }
                // else
                // {
                //     $div.addClass("hidden-div");
                //     $div.removeClass("shown-div");
                // }
            // });
        });
    </script>
@endsection