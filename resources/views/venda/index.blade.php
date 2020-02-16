@extends('adminlte::page')

@section('title', 'Lista de Vendas')

@section('content_header')
    <h1>Lista de Vendas</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-body">
            {!! $dataTable->table() !!}
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
    {!! $dataTable->scripts() !!}
@stop
