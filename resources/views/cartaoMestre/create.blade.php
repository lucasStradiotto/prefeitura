@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div>
        <ul class="breadcrumb">
            {{--<li><a href="{{ route('home_entulho') }}">Parâmetros</a></li>--}}
            <li><a href="{{ route('indexCartaoMestre') }}">Cartão Mestre</a></li>
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
        @if(isset($cartaoMestre))
            <form class="container" method="post" action="{{ route('updateCartaoMestre', $cartaoMestre->id) }}">
                {!! method_field('PUT') !!}
                @else
                    <form class="container" method="post" action="{{ route('storeCartaoMestre') }}">
                        @endif
                        {!! csrf_field() !!}
                        <div>
                            Número
                        </div>
                        <div>
                            <input name="numero" value="{{$cartaoMestre->numero or old('numero')}}">
                        </div>
                        <button class="btn btn-success" id="btnEnviar">Enviar</button>

                    </form>
    </div>
@endsection