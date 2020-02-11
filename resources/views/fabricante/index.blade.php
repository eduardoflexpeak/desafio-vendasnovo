@extends('adminlte::page')

@section('title', 'Lista de Fabricantes')

@section('content_header')
    <h1>Lista de Fabricantes</h1>
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
