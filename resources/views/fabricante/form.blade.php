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
        <div class="form-group">
            {!! Form::label('nome', 'Nome Fabricante') !!}
            {!! Form::text('nome', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('site', 'Site Fabricante') !!}
            {!! Form::text('site', null, ['class' => 'form-control']) !!}
        </div>

        {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
@stop

@section('css')
@stop

@section('js')
@stop
