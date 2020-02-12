@extends('adminlte::page')

@section('title', 'Formulário de Fabricante')

@section('content_header')
    <h1>Formulário de Fabricante</h1>
@stop

@section('content')
    @if (isset($fabricante))
        {!! Form::model($fabricante, ['url' => route('fabricante.update', $fabricante), 'method' => 'put']) !!}
    @else
        {!! Form::open(['url' => route('fabricante.store')]) !!}
    @endif
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
