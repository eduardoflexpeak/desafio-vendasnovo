@extends('adminlte::page')

@section('title', 'Lista de Fabricantes')

@section('content_header')
    <h1>Lista de Fabricantes</h1>
@stop

@section('content')
    {!! $dataTable->table() !!}
@stop

@section('css')
@stop

@section('js')
<script src="/vendor/datatables/buttons.server-side.js"></script>
    {!! $dataTable->scripts() !!}
@stop
