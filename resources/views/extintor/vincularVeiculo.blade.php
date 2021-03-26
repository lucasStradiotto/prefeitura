@extends('layouts.app')

@section('content')

    <title>{{$title}}</title>

    <div>
        <ul class="breadcrumb">
            {{--<li><a href="{{ url('home') }}">Parâmetros</a></li>--}}
            <li><a href="{{ route('indexExtintor') }}">Extintores</a></li>
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
        
<script>
    $(document).ready(function(){
        if($("#message").length>0){
            setTimeout(function(){ $("#message").remove() }, 6000);
        }
    })
</script>
@endsection