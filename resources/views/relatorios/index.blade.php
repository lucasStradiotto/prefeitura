@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <ul class="breadcrumb">
        {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
        <li class="active">{{ $title }}</li>
    </ul>
    <div>
        <form id="form-relatorio" action="{{route('todosServicos')}}" target="_blank">
            <div>
                <h2>Selecione o período</h2>
                <select name="mes">
                    <option value="Janeiro">Janeiro</option>
                    <option value="Fevereiro">Fevereiro</option>
                    <option value="Março">Março</option>
                    <option value="Abril">Abril</option>
                    <option value="Maio">Maio</option>
                    <option value="Junho">Junho</option>
                    <option value="Julho">Julho</option>
                    <option value="Agosto">Agosto</option>
                    <option value="Setembro">Setembro</option>
                    <option value="Outubro">Outubro</option>
                    <option value="Novembro">Novembro</option>
                    <option value="Dezembro">Dezembro</option>
                </select>
                de
                <input name="ano" value="" placeholder="{{date('Y')}}">
            </div>
            <div>
                <h2>Escolha o Relatório</h2>
                Relatório Mensal de Serviços Executados - DIPRO 2017 <button id="btn-servicos-executados" class="btn btn-primary btn-success">Gerar</button>
                <br>
                Relatório Mensal de Todos os Serviços <button id="btn-todos-servicos" class="btn btn-primary btn-success">Gerar</button>
            </div>
        </form>
    </div>



    <script>
        $(document).ready(function (e) {
            var $form = $("#form-relatorio");
            $("#btn-todos-servicos").click(function(e){
                e.preventDefault();
                $form.prop('action', "{{route('todosServicos')}}");
                $form.submit();
            });

            $("#btn-servicos-executados").click(function(e){
                e.preventDefault();
                $form.prop('action', "{{route('servicosExecutados')}}");
                $form.submit();
            });
        });
    </script>

@endsection
