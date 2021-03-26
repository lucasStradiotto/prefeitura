@extends('layouts.app')

@section('content')

    <ul class="breadcrumb">
        <li><a href="{{ route('permissao.index') }}">Permissão</a></li>
        <li class="active"> Editar Permissão</li>
    </ul>
    <div class="container">
        @if(isset($errors) && count($errors) > 0)
            <div class="danger alert-danger">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('permissao.update', $permissao->id) }}" method="POST">
            {!! method_field('PUT') !!}
            {!! csrf_field() !!}
            <div>
                Nome
            </div>
            <div>
                <input type="text" name="name" value="{{ old('name') != '' ? old('name') : $permissao->name }}" />
            </div>
            <div>
                Nome Extenso
            </div>
            <div>
                <input type="text" name="display_name" value="{{ old('display_name') != '' ? old('display_name') : $permissao->display_name }}" />
            </div><div>
                Descrição
            </div>
            <div>
                <input type="text" name="description" value="{{ old('description') != '' ? old('description') : $permissao->description }}" />
            </div>
            <button class="btn btn-success">Enviar</button>
        </form>
    </div>

@endsection