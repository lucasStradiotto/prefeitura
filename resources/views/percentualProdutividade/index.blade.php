@extends('layouts.app')

@section('content')
    <title>{{$title}}</title>
    <div>
        <form action="{{route('gerarRelatorioProdutividade')}}">
            <div>
                <label>Data</label>
                <input type="date" name="dia"/>
            </div>
            <div>
                <button class="btn btn-primary btn-success">Calcular</button>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function(){
            // alert("salve");
        });
    </script>
@endsection