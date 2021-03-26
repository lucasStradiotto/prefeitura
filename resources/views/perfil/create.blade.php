@extends('layouts.app')

@section('content')

    <ul class="breadcrumb">
        <li><a href="{{ route('perfil.index') }}">Perfil</a></li>
        <li class="active"> Novo Perfil</li>
    </ul>
    <div class="container">
        @if(isset($errors) && count($errors) > 0)
            <div class="danger alert-danger">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('perfil.store') }}" method="POST">
            {!! csrf_field() !!}
            <div>
                Nome
            </div>
            <div>
                <input type="text" name="name" />
            </div>
            <div>
                Nome Extenso
            </div>
            <div>
                <input type="text" name="display_name" />
            </div><div>
                Descrição
            </div>
            <div>
                <input type="text" name="description" />
            </div>
            <button class="btn btn-success">Enviar</button>
        </form>
    </div>

@endsection