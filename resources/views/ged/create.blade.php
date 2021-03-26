@extends('layouts.app')

@section('content')

    <style>
        .add-obs{
            background-color: transparent;
            color: #1f648b;
            transition: background-color 2s, color 1s;
            margin-left: 8px;
            position: relative;
        }

        .add-obs:hover{
            background-color: green;
            color: white;
            transition: background-color 2s, color 1s;
        }

        .add-obs p {
            border-radius: 9px;
            display: none;
            position: absolute;
            bottom: 24px;
            background: rgba(255, 255, 255, 0.5);
            width: 270px;
            padding: 15px;
            text-align: justify;
        }

        .add-obs:hover p {
            display: block;
            color: #777;
        }
    </style>

    <title>{{$title}}</title>

    <div class="container">
        <ul class="breadcrumb">
            <li class="active">{{ $title }}</li>
        </ul>
        @if(isset($errors) && count($errors) > 0)
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <p>{{$error}}</p>
                @endforeach
            </div>
        @endif
        <form action="{{route('storeGed')}}" method="post" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div>Selecione o arquivo</div>
            <div>
                <input name="arquivo" type="file" accept=".pdf, .PDF, .png, .PNG, .jpg, .JPG, .doc, .DOC, .docx, .DOCX, .jpeg, .JPEG"/>
            </div>

            <div>Nome do arquivo</div>
            <div>
                <input name="nome_arquivo" type="text"/>
            </div>

            <div>Secretarias</div>
            <div>
                <select name="secretaria_id" id="secretaria_id">
                    <option value="">Selecione a Secretaria</option>
                    @foreach($secretarias as $sec)
                        <option value="{{$sec->secretaria->id}}">{{$sec->secretaria->nome}}</option>
                    @endforeach
                </select>
            </div>
            <div id="obs"></div>
            <button class="btn btn-success">Enviar</button>
        </form>
    </div>

    <script>
        $(document).ready(function(){
            $("#secretaria_id").change(function(){
                $.getJSON("{{route('getObservacoes')}}", {
                    secretaria_id: $("#secretaria_id").val()
                }, function(data){
                    if (data.length === 0)
                        $("#obs").empty();
                    else
                    {
                        let toAppend = '';
                        $.each(data, function (index, obj){
                            toAppend += '<div>' + obj.nome_observacao + '</div>';
                            toAppend += '<input type="text" name="obs[]"/>';
                            toAppend += '<input type="hidden" name="nome_obs[]" value="' + obj.nome_observacao + '"/>';
                        });
                        $("#obs").empty().append(toAppend);
                    }
                });
            });
        });
    </script>
@endsection