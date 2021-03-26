@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <ul class="breadcrumb">
        {{--<li><a href="{{ url('home_entulho') }}">Parâmetros</a></li>--}}
        <li><a href="{{ route('indexPrazo') }}">Prazo</a></li>
        <li class="active">{{ $title }}</li>
    </ul>
    <form method="post" action="{{route('updatePrazo')}}">
        {!! method_field('PUT') !!}
        {!! csrf_field() !!}
        <div>
            @if(isset($errors) && count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <p>{{$error}}</p>
                    @endforeach
                </div>
            @endif
        </div>
        <div>
            <input type="hidden" value="1" name="tipo">
            <h3>Prazo para Caçamba</h3>
            <input name="prazo" value="{{$prazo->prazo or old('prazo')}}">
        </div>
        <div>
            <button class="btn btn-success">Atribuir</button>
        </div>
    </form>
    <script>
@endsection
