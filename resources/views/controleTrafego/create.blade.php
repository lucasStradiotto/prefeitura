@extends('layouts.app')

@section('content')
<h2>Novo</h2>
<br>
<form action="">
    <div class="row">
        <div class="col-sm-1"><label>Frota</label></div>
        <div class="col-sm-3"><input type="text"></div>
        <div class="col-sm-1"><label>Placa</label></div>
        <div class="col-sm-3"><input type="text"></div>
        <div class="col-sm-1"><label>Secretária</label></div>
        <div class="col-sm-3"><input type="text"></div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-1"><label>Motorista</label></div>
        <div class="col-sm-3"><input type="text"></div>
        <div class="col-sm-1"><label>Destino</label></div>
        <div class="col-sm-6"><input style="width: 590px" type="text"/></div>
    </div>
    <br>
    <h3>Saída</h3>
    <div class="row">
        <div class="col-sm-1"><label>Data</label></div>
        <div class="col-sm-3"><input type="text"></div>
        <div class="col-sm-1"><label>Hora</label></div>
        <div class="col-sm-3"><input type="text"></div>
        <div class="col-sm-1"><label>Km</label></div>
        <div class="col-sm-3"><input type="text"></div>
    </div>
    <br>
    <h3>Retorno</h3>
    <div class="row">
        <div class="col-sm-1"><label>Data</label></div>
        <div class="col-sm-3"><input type="text"></div>
        <div class="col-sm-1"><label>Hora</label></div>
        <div class="col-sm-3"><input type="text"></div>
        <div class="col-sm-1"><label>Km</label></div>
        <div class="col-sm-3"><input type="text"></div>
    </div>
    <br>
    <button type="submit" class="btn btn-success">Salvar</button>
</form>
@endsection