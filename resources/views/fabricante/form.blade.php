@extends('adminlte::page')

@section('title', 'Formulário de Fabricante')

@section('content_header')
    <h1>Formulário de Fabricante</h1>
@stop

@section('content')
    {!! Form::open(['url' => route('fabricante.store')]) !!}
        {!! Form::label('nome', 'Nome Fabricante') !!}
        {!! Form::text('nome') !!}
        {!! Form::label('site', 'Site Fabricante') !!}
        {!! Form::text('site') !!}

        {!! Form::submit('Salvar') !!}
    {!! Form::close() !!}
@stop

@section('css')
@stop

@section('js')
@stop
