@extends('adminlte::page')

@section('title', 'Lista de Pessoas')

@section('content_header')
    <h1>Lista de Pessoas</h1>
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
