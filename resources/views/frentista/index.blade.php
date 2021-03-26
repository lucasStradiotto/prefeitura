@extends('layouts.app')

@section('content')
    <title>{{$title}}</title>
    <div class="container">
        <ul class="breadcrumb">
            <li class="active">{{ $title }}</li>
        </ul>
        @if(session('msg')) <div class="alert alert-success"> {{session('msg')}} </div> @endif
        <div class="row">
            <div class ="col-12 col-md-8">
                <a href="{{ route('createFrentista') }}" class="btn btn-success"> Novo</a>
            </div>
            <div class="col-6 col-md-4">
               <form method="GET" action="{{ route('searchFrentista') }}">
                <div class="row">
                  <div class="col-md-8">
                    <input type="text" name="search" class="form-control" placeholder="Pesquisar" value="{{ old('search') }}">
                  </div>
                  <div class="col-md-4">
                    <button class="btn btn-success">Pesquisar</button>
                  </div>
                </div>
              </form>
            </div>
        </div>
        <br>
        <div>
            <table class="table">
                <tr>
                    <th>Nome</th>
                    <th>Posto</th>
                    <th>Ação</th>
                    <th>Resetar Senha</th>
                </tr>
                @foreach ($frentistas as $frentista)
                    <tr>
                        <td>{{$frentista->nome}}</td>
                        @foreach($postos as $posto)
                            @if($frentista->posto_id == $posto->id)
                                <td>{{$posto->nome}}</td>
                            @endif
                        @endforeach
                        <td><a href="{{ route('editFrentista', $frentista->id) }}" class="btn btn-warning"
                               title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
                        <td><a href="{{ route('resetSenhaFrentista', $frentista->id) }}" class="btn btn-info"
                               title="Resetar Senha"><i class="glyphicon glyphicon-retweet"></i></a></td>
                    </tr>
                @endforeach
            </table>
        </div>
        {!! $frentistas->render() !!}
    </div>
@endsection